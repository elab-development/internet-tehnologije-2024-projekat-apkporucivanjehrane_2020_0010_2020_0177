<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategorija extends Model
{
    use HasFactory;

    protected $fillable = [
        'naziv',
        'opis',
        'slika',
    ];

    /**
     * Jedan kategorija ima mnogo restorana
     */
    public function restorani()
    {
        return $this->hasMany(Restoran::class);
    }
}
