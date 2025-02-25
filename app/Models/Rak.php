<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Rak extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'rak';
    protected $guarded = [];
}
