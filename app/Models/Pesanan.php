<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Pesanan extends Model
{
    //pesanan
    use HasFactory, Notifiable, SoftDeletes, HasUuids;
    protected $table = 'pesanan';
    protected $guarded = [];
}
