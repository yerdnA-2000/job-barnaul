<?php

namespace App\Models;

use App\Models\Main\Vacancy;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    /*-----Функциональность компаний для будущих обновлений----*/

    /*use HasFactory;


    protected $table = 'companies';

    protected $fillable = [
        'title',
        'activity',
        'address',
        'contacts',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function vacancies() {
        return $this->hasMany(Vacancy::class);
    }

    public function getCreatedAt() {;
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->format('d.m.Y');
    }*/
}
