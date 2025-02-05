<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class EstimasiKendaraan extends Model
{
    use HasFactory, Notifiable, SoftDeletes;
    protected $table = 'estimasi_kendaraan';
    protected $guarded = [];

    /**
     * Get the user that owns the Estimasi
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function relKendaraan(): BelongsTo
    {
        return $this->BelongsTo(Kendaraan::class,'kode_jenis','kendaraan');
    }
}
