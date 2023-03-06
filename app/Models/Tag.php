<?php

namespace App\Models;

use App\Models\Main\Vacancy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'tags';

    public function vacancies() {
        return $this->belongsToMany(Vacancy::class);
    }

    protected $appends = ['created_at_formatted'];

    public function getCreatedAtFormattedAttribute()
    {
        return $this->created_at->toAtomString();
    }

    public function subscribers() {
        return $this->hasMany(Subscriber::class);
    }
}
