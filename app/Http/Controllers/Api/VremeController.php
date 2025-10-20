<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class VremeController extends Controller
{
    /**
     * Dobavljanje vremenske prognoze za Beograd
     * Koristi OpenWeatherMap API
     */
    public function getVremeZaBeograd()
    {
        try {
            // OpenWeatherMap API key (možete koristiti demo key ili kreirati svoj)
            $apiKey = config('services.openweather.key', 'demo');
            $city = 'Belgrade';
            $countryCode = 'RS';

            // API poziv ka OpenWeatherMap
            $response = Http::get("https://api.openweathermap.org/data/2.5/weather", [
                'q' => "{$city},{$countryCode}",
                'appid' => $apiKey,
                'units' => 'metric',
                'lang' => 'sr',
            ]);

            if ($response->successful()) {
                $data = $response->json();

                return response()->json([
                    'grad' => $data['name'] ?? 'Beograd',
                    'temperatura' => $data['main']['temp'] ?? null,
                    'opis' => $data['weather'][0]['description'] ?? null,
                    'ikona' => $data['weather'][0]['icon'] ?? null,
                    'vlaznost' => $data['main']['humidity'] ?? null,
                    'pritisak' => $data['main']['pressure'] ?? null,
                    'vetar' => $data['wind']['speed'] ?? null,
                ]);
            }

            return response()->json([
                'message' => 'Nije moguće dobiti vremensku prognozu',
            ], 500);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Greška pri dobavljanju vremenske prognoze',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Dobavljanje vremenske prognoze za proizvoljni grad
     */
    public function getVremeZaGrad(Request $request)
    {
        $request->validate([
            'grad' => 'required|string',
        ]);

        try {
            $apiKey = config('services.openweather.key', 'demo');

            $response = Http::get("https://api.openweathermap.org/data/2.5/weather", [
                'q' => $request->grad . ',RS',
                'appid' => $apiKey,
                'units' => 'metric',
                'lang' => 'sr',
            ]);

            if ($response->successful()) {
                $data = $response->json();

                return response()->json([
                    'grad' => $data['name'],
                    'temperatura' => $data['main']['temp'],
                    'opis' => $data['weather'][0]['description'],
                    'ikona' => $data['weather'][0]['icon'],
                    'vlaznost' => $data['main']['humidity'],
                    'pritisak' => $data['main']['pressure'],
                    'vetar' => $data['wind']['speed'],
                ]);
            }

            return response()->json([
                'message' => 'Grad nije pronađen',
            ], 404);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Greška pri dobavljanju vremenske prognoze',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
