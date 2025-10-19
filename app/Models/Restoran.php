<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restoran extends Model
{
    use HasFactory;

    protected $fillable = [
        'kategorija_id',
        'naziv',
        'slug',
        'opis',
        'adresa',
        'telefon',
        'slika',
        'cena_dostave',
        'vreme_dostave',
        'ocena',
        'aktivan',
    ];

    protected $casts = [
        'cena_dostave' => 'decimal:2',
        'ocena' => 'decimal:2',
        'aktivan' => 'boolean',
    ];

    /**
     * Restoran pripada jednoj kategoriji
     */
    public function kategorija()
    {
        return $this->belongsTo(Kategorija::class);
    }

    /**
     * Restoran ima mnogo jela
     */
    public function jela()
    {
        return $this->hasMany(Jelo::class);
    }

    /**
     * Restoran ima mnogo porudžbina
     */
    public function porudzbine()
    {
        return $this->hasMany(Porudzbina::class);
    }
}
