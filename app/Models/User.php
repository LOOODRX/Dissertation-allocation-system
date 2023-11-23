<?php

namespace App\Models;

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
        'Allocated',
    ];

    protected $guarded = [];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    

    protected $primaryKey = 'id'; 

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            if (empty($user->id)) {
                $user->id = $user->generateStudentId();
            }
        });
    }

    public function generateStudentId()
    {
        $year = date('y');

        $month = date('m');

        $randomNumber = mt_rand(10000, 99999); 

        $studentId = $year . $month. $randomNumber;
        
        while (static::where('id', $studentId)->exists()) {
            $randomNumber = mt_rand(10000, 99999);
            $studentId = $year . $randomNumber;
        }

        return $studentId;
    }
}

