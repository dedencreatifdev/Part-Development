<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Estimasi extends Model
{
    use HasFactory, Notifiable, SoftDeletes, HasUuids;
    protected $table = 'estimasi';
    protected $guarded = [];

    /**
     * Get the user that owns the Estimasi
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function relEstimasiKendaraan(): HasMany
    {
        return $this->HasMany(EstimasiKendaraan::class, 'estimasi_id', 'id');
    }
}
