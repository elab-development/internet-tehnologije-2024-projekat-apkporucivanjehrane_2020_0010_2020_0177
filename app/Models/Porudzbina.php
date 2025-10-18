<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Porudzbina extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'porudzbine';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'restoran_id',
        'order_number',
        'total_price',
        'status',
        'delivery_address',
        'note',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'total_price' => 'decimal:2',
    ];

    /**
     * Relacija: Porudžbina pripada jednom korisniku (N:1)
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relacija: Porudžbina pripada jednom restoranu (N:1)
     */
    public function restoran(): BelongsTo
    {
        return $this->belongsTo(Restoran::class, 'restoran_id');
    }

    /**
     * Relacija: Porudžbina može imati više proizvoda (M:N)
     */
    public function proizvodi(): BelongsToMany
    {
        return $this->belongsToMany(ProizvodNaMeniju::class, 'porudzbina_proizvod', 'porudzbina_id', 'proizvod_na_meniju_id')
            ->withPivot('quantity', 'price')
            ->withTimestamps();
    }
}
