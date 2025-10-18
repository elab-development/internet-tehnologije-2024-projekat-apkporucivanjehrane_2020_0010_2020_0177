<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Restoran extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'address',
        'phone',
        'image',
        'delivery_price',
        'delivery_time',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_active' => 'boolean',
        'delivery_price' => 'decimal:2',
    ];

    /**
     * Relacija: Restoran pripada jednoj kategoriji (N:1)
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    /**
     * Relacija: Restoran ima više proizvoda na meniju (1:N)
     */
    public function proizvodiNaMeniju(): HasMany
    {
        return $this->hasMany(ProizvodNaMeniju::class, 'restoran_id');
    }

    /**
     * Relacija: Restoran ima više porudžbina (1:N)
     */
    public function porudzbine(): HasMany
    {
        return $this->hasMany(Porudzbina::class, 'restoran_id');
    }
}
