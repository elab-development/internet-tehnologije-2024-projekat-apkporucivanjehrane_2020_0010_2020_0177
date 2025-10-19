<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Porudzbina extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'restoran_id',
        'ime_kupca',
        'email_kupca',
        'telefon_kupca',
        'adresa_dostave',
        'ukupna_cena',
        'status',
        'napomena',
    ];

    protected $casts = [
        'ukupna_cena' => 'decimal:2',
    ];

    /**
     * Porudžbina pripada jednom korisniku
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Porudžbina pripada jednom restoranu
     */
    public function restoran()
    {
        return $this->belongsTo(Restoran::class);
    }

    /**
     * Porudžbina ima više jela (many-to-many)
     */
    public function jela()
    {
        return $this->belongsToMany(Jelo::class, 'jelo_porudzbina')
                    ->withPivot('kolicina', 'cena_stavke')
                    ->withTimestamps();
    }
}
