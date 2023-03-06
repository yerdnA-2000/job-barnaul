<?php

namespace App\Models;

use App\Models\Main\Vacancy;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'date_born',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function vacancies() {
        return $this->hasMany(Vacancy::class);
    }

    public function favorites() {
        return $this->belongsToMany(Vacancy::class, 'user_vacancy_favorites',
            'user_id', 'vacancy_id');
    }

    public function getCreatedAt() {;
        /*return Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->timezone('Etc/UTC')->diffForHumans();*/
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->format('d.m.Y');
    }

    public function getDateBorn() {;
        return Carbon::createFromFormat('Y-m-d', $this->date_born)->format('d.m.Y');
    }

    public function getAge() {
        return Carbon::parse($this->date_born)->age;
    }

    /*public function companies() {
        return $this->hasMany(Company::class);
    }*/
}
