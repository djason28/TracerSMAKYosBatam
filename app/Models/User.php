<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
    'name',
    'email',
    'password',
    'role',
    'nis',
    'birth_date',
    'insta',
    'university_name',
    'job_title',
    'work_place',
    'graduation_year',
    'major',
    'phone',
    'angkatan',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
?>
