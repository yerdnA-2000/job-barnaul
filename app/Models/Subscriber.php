<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'subscribers';

    protected $fillable = [
        'id',
        'tag_id',
        'email',
        'name',
        'created_at',
    ];

    public function tag() {
        return $this->belongsTo(Tag::class);
    }
}
