<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use App\Models\Main\Vacancy;
use App\Models\Schedule;
use App\Models\Tag;
use Drandin\DeclensionNouns\Facades\DeclensionNoun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    public function index(Request $request) {
        $request->validate([
            'search' => 'string|nullable',
            'salary' => 'integer|nullable',
            'schedule' => 'integer|nullable',
            'experience' => 'integer|nullable',
        ]);
        $countFilter = 0;
        $text = $request->search;
        $salary = $request->salary;
        $schedule_id = $request->schedule;
        $experience_id = $request->experience;
        $queryVac = Vacancy::query();
        /*$queryVac->select('id', 'title');*/
        $queryVac->with('tags', 'experience', 'schedule');
        if ($text != null) {
            $queryVac->where('title', "LIKE", "%{$text}%");
            $queryVac2 = Vacancy::query();
            $queryVac2->with('tags', 'experience', 'schedule');
            $queryVac2->join('tag_vacancy', 'tag_vacancy.vacancy_id', '=', 'vacancies.id')->
                join('tags', 'tags.id', '=', 'tag_vacancy.tag_id')->
                where('tags.title', "LIKE", "%{$text}%");
            $queryVac2->select('vacancies.*');

            /*-----Расшифрока SQL
              SELECT м.*
                FROM vacancies as v
                     JOIN tag_vacancy as tv ON tv.vacancy_id = v.id
                     JOIN tags as t ON t.id = tv.tag_id
            WHERE t.title = 'главный бухгалтер'*/
        }
        if ($salary != null) {
            $queryVac->where('min_salary', '>=', $salary);
            if ($text != null) {
                $queryVac2->where('min_salary', '>=', $salary);
            }
            $countFilter++;
        }
        if ($schedule_id != null) {
            $queryVac->where('schedule_id', $schedule_id);
            if ($text != null) {
                $queryVac2->where('schedule_id', $schedule_id);
            }
            $countFilter++;
        }
        if ($experience_id != null) {
            $queryVac->where('experience_id', $experience_id);
            if ($text != null) {
                $queryVac2->where('experience_id', $experience_id);
            }
            $countFilter++;
        }
        if ($text != null) {
            $vacs = $queryVac->union($queryVac2)->orderByDesc('created_at')->paginate(10);
        } else {
            $vacs = $queryVac->orderByDesc('created_at')->paginate(10);
        }

        $schedules = Schedule::pluck('title', 'id')->all();
        $experiences = Experience::pluck('title', 'id')->all();
        $user = Auth::user();
        $rowCountVacs = DeclensionNoun::make(count($vacs), "вакансия");
        
        $meta_description = '';
        
        return view('index',
            compact('vacs', 'user', 'schedules', 'experiences', 'countFilter', 
                'rowCountVacs', 'meta_description'));
    }


    public function getPrompt(Request $request) {

        if ($request->ajax()) {
            $output="";
            $tags = Tag::where('title', 'LIKE', "%{$request->search}%")->limit(10)->get();
            if($tags) {
                foreach ($tags as $key => $tag) {
                    $output .= '<tr class="tr-prompt">' .
                        '<td class="td-prompt">' . $tag->title . '</td>' .
                        '</tr>';
                }
            }
        }
        return Response($output);
    }
}
