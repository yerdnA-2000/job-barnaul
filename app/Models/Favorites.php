<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorites extends Model
{
    use HasFactory;

    protected $table = 'user_vacancy_favorites';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'vacancy_id',
    ];
}
