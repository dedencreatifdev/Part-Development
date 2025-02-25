<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class OpnameMmksi extends Model
{
    use HasFactory, Notifiable, SoftDeletes;
    protected $table = 'opname_mmksi';
    protected $guarded = [];
}
