<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Pustakawan extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'pustakawan';
    protected $primaryKey = 'id_pustakawan';
    protected $fillable = ['username', 'password', 'remember_token'];
    public $timestamps = false;
}
