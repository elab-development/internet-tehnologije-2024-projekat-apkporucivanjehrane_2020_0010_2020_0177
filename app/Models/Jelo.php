<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jelo extends Model
{
    use HasFactory;

    protected $fillable = [
        'restoran_id',
        'naziv',
        'opis',
        'cena',
        'slika',
        'dostupno',
        'kategorija_jela',
    ];

    protected $casts = [
        'cena' => 'decimal:2',
        'dostupno' => 'boolean',
    ];

    /**
     * Jelo pripada jednom restoranu
     */
    public function restoran()
    {
        return $this->belongsTo(Restoran::class);
    }

    /**
     * Jelo može biti u više porudžbina (many-to-many)
     */
    public function porudzbine()
    {
        return $this->belongsToMany(Porudzbina::class, 'jelo_porudzbina')
                    ->withPivot('kolicina', 'cena_stavke')
                    ->withTimestamps();
    }
}
