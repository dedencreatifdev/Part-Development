<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;

class Produk extends Model
{

    //price_list
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;
    protected $table = 'price_list';

    /**
     * Get the user that owns the Produk
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function relLokasiRak(): BelongsTo
    {
        return $this->belongsTo(LokasiRak::class, 'KDBR', 'kdbr');
    }

    /**
     * Get all of the comments for the Produk
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function relProduk(): BelongsTo
    {
        return $this->BelongsTo(Produk::class, 'KETERANGAN','KDBR');
    }
}
