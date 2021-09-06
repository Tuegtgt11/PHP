<?php


namespace App\Models;


use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class Covid extends Model
{
    use HasFactory;
    protected $table='users';
    protected $fillable=[
      'id_card','name','date_year','address','phone','allergy_history'
    ];
}
