<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class WeatherController extends Controller
{
    /**
     * Prikaz vremenske prognoze za Beograd
     * Koristi Open-Meteo API (besplatan, bez API ključa)
     */
    public function getBelgradeWeather(): JsonResponse
    {
        try {
            // Cache rezultate za 30 minuta da ne preopterećujemo API
            $weather = Cache::remember('belgrade_weather', 1800, function () {
                // Open-Meteo API - besplatan weather API
                // Koordinate Beograda: 44.8176° N, 20.4633° E
                $response = Http::timeout(10)->get('https://api.open-meteo.com/v1/forecast', [
                    'latitude' => 44.8176,
                    'longitude' => 20.4633,
                    'current' => 'temperature_2m,relative_humidity_2m,precipitation,weather_code,wind_speed_10m',
                    'hourly' => 'temperature_2m,precipitation_probability',
                    'daily' => 'temperature_2m_max,temperature_2m_min,precipitation_sum',
                    'timezone' => 'Europe/Belgrade',
                    'forecast_days' => 3
                ]);

                if ($response->failed()) {
                    return null;
                }

                return $response->json();
            });

            if (!$weather) {
                return response()->json([
                    'success' => false,
                    'message' => 'Greška pri preuzimanju podataka o vremenu'
                ], 500);
            }

            // Formatiranje odgovora
            $current = $weather['current'] ?? [];
            $daily = $weather['daily'] ?? [];

            // Mapiranje weather_code u opis
            $weatherDescription = $this->getWeatherDescription($current['weather_code'] ?? 0);

            return response()->json([
                'success' => true,
                'location' => [
                    'city' => 'Beograd',
                    'country' => 'Srbija',
                    'latitude' => 44.8176,
                    'longitude' => 20.4633,
                ],
                'current' => [
                    'temperature' => $current['temperature_2m'] ?? null,
                    'humidity' => $current['relative_humidity_2m'] ?? null,
                    'wind_speed' => $current['wind_speed_10m'] ?? null,
                    'precipitation' => $current['precipitation'] ?? 0,
                    'description' => $weatherDescription,
                    'time' => $current['time'] ?? null,
                ],
                'forecast' => [
                    'max_temperature' => $daily['temperature_2m_max'][0] ?? null,
                    'min_temperature' => $daily['temperature_2m_min'][0] ?? null,
                    'precipitation' => $daily['precipitation_sum'][0] ?? 0,
                ],
                'next_days' => $this->formatDailyForecast($daily),
                'message' => 'Preporuka: ' . $this->getDeliveryRecommendation($current['weather_code'] ?? 0, $current['precipitation'] ?? 0),
                'cached_at' => Cache::get('belgrade_weather_time', now()->toDateTimeString())
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Greška pri dobijanju vremenske prognoze',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Mapiranje WMO weather code u opis na srpskom
     */
    private function getWeatherDescription(int $code): string
    {
        $weatherCodes = [
            0 => 'Vedro nebo',
            1 => 'Pretežno vedro',
            2 => 'Delimično oblačno',
            3 => 'Oblačno',
            45 => 'Maglovito',
            48 => 'Magla sa mrazom',
            51 => 'Slaba kiša',
            53 => 'Umerena kiša',
            55 => 'Jaka kiša',
            61 => 'Slaba kišica',
            63 => 'Umerena kišica',
            65 => 'Jaka kišica',
            71 => 'Slab sneg',
            73 => 'Umeren sneg',
            75 => 'Jak sneg',
            80 => 'Pljuskovi',
            95 => 'Oluja',
        ];

        return $weatherCodes[$code] ?? 'Nepoznato';
    }

    /**
     * Preporuka za dostavu na osnovu vremenskih uslova
     */
    private function getDeliveryRecommendation(int $weatherCode, float $precipitation): string
    {
        if ($weatherCode >= 80 || $precipitation > 5) {
            return 'Loši vremenski uslovi - dostava može kasniti';
        } elseif ($weatherCode >= 60 || $precipitation > 1) {
            return 'Kiša - savetujemo poručivanje iz obližnjih restorana';
        } elseif ($weatherCode >= 70) {
            return 'Sneg - vreme dostave može biti produženo';
        } else {
            return 'Dobri vremenski uslovi - normalno vreme dostave';
        }
    }

    /**
     * Formatiranje dnevne prognoze za naredna 3 dana
     */
    private function formatDailyForecast(array $daily): array
    {
        $forecast = [];
        $days = ['Danas', 'Sutra', 'Prekosutra'];

        for ($i = 0; $i < 3 && $i < count($daily['temperature_2m_max'] ?? []); $i++) {
            $forecast[] = [
                'day' => $days[$i] ?? "Dan " . ($i + 1),
                'max_temp' => $daily['temperature_2m_max'][$i] ?? null,
                'min_temp' => $daily['temperature_2m_min'][$i] ?? null,
                'precipitation' => $daily['precipitation_sum'][$i] ?? 0,
            ];
        }

        return $forecast;
    }
}
