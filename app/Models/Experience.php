<?php

namespace App\Models;

use App\Models\Main\Vacancy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'experiences';

    public function vacancies() {
        return $this->hasMany(Vacancy::class);
    }
}
