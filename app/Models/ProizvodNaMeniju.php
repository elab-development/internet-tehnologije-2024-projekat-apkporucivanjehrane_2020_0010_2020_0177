<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ProizvodNaMeniju extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'proizvod_na_menijus';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'restoran_id',
        'name',
        'description',
        'price',
        'image',
        'is_available',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_available' => 'boolean',
        'price' => 'decimal:2',
    ];

    /**
     * Relacija: Proizvod pripada jednom restoranu (N:1)
     */
    public function restoran(): BelongsTo
    {
        return $this->belongsTo(Restoran::class, 'restoran_id');
    }

    /**
     * Relacija: Proizvod može biti u više porudžbina (M:N)
     */
    public function porudzbine(): BelongsToMany
    {
        return $this->belongsToMany(Porudzbina::class, 'porudzbina_proizvod', 'proizvod_na_meniju_id', 'porudzbina_id')
            ->withPivot('quantity', 'price')
            ->withTimestamps();
    }
}
