<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Kendaraan extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'data_kendaraans';
    protected $guarded = [];
}
