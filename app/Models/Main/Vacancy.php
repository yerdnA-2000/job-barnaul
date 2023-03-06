<?php

namespace App\Models\Main;

use App\Models\Company;
use App\Models\Experience;
use App\Models\Schedule;
use App\Models\Tag;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacancy extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'vacancies';


    protected $fillable = [
        'id',
        'user_id',
        'title',
        'min_salary',
        'max_salary',
        'employer',
        'address',
        'description',
        'experience_id',
        'schedule_id',
        'contacts',
        'created_at'
    ];

    public function tags() {
        return $this->belongsToMany(Tag::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function favorites() {
        return $this->belongsToMany(User::class, 'user_vacancy_favorites', 'vacancy_id', 'user_id');
    }

    public function experience() {
        return $this->belongsTo(Experience::class);
    }

    public function schedule() {
        return $this->belongsTo(Schedule::class);
    }

    public function getHumanDate() {;
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->timezone('Etc/UTC')->diffForHumans();
        /*return Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->format('j F, H:i');*/
    }

    /*public function company() {
        return $this->belongsTo(Company::class);
    }*/

}
