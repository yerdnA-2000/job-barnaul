<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use App\Models\Main\Vacancy;
use App\Models\Schedule;
use App\Models\Tag;
use Drandin\DeclensionNouns\Facades\DeclensionNoun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class TagController extends Controller
{
    public function show($slug_tag)
    {
        $user = Auth::user();
        /*$vacs = Vacancy::with('tags', 'experience', 'schedule')->paginate(10);*/
        $tag = Tag::where('slug', $slug_tag)->first();
        $vacs = $tag->vacancies;
        $schedules = Schedule::pluck('title', 'id')->all();
        $experiences = Experience::pluck('title', 'id')->all();
        $rowCountVacs = DeclensionNoun::make(count($vacs), "вакансия");
        $countFilter = 0;

        $meta_description = $tag->title.'. Найти работу с графиками: '.implode(", ", $schedules).
            '. Без опыта, с опытом';



        return view('tags.show',
            compact('vacs', 'user', 'schedules', 'experiences',
                'countFilter', 'rowCountVacs', 'tag', 'meta_description'));
    }

}
