<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Cuadro extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table='cuadros';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
        'title',
        'paint',
        'year',
        'material',
        'measures',
        'country',

    ];

}
