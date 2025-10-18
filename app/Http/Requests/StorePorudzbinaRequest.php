<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePorudzbinaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Autorizacija se proverava preko auth:sanctum middleware
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'restoran_id' => 'required|exists:restorani,id',
            'delivery_address' => 'required|string|max:500',
            'note' => 'nullable|string|max:1000',
            'proizvodi' => 'required|array|min:1',
            'proizvodi.*.id' => 'required|exists:proizvod_na_menijus,id',
            'proizvodi.*.quantity' => 'required|integer|min:1|max:50',
        ];
    }

    /**
     * Prilagođene poruke za validaciju
     */
    public function messages(): array
    {
        return [
            'restoran_id.required' => 'Morate izabrati restoran',
            'restoran_id.exists' => 'Izabrani restoran ne postoji',
            'delivery_address.required' => 'Adresa dostave je obavezna',
            'delivery_address.max' => 'Adresa dostave ne sme biti duža od 500 karaktera',
            'proizvodi.required' => 'Morate izabrati najmanje jedan proizvod',
            'proizvodi.min' => 'Morate izabrati najmanje jedan proizvod',
            'proizvodi.*.id.required' => 'ID proizvoda je obavezan',
            'proizvodi.*.id.exists' => 'Izabrani proizvod ne postoji',
            'proizvodi.*.quantity.required' => 'Količina je obavezna',
            'proizvodi.*.quantity.min' => 'Minimalna količina je 1',
            'proizvodi.*.quantity.max' => 'Maksimalna količina je 50',
        ];
    }
}
