<?php

namespace App\Http\Controllers;

use App\Mail\TagSubscribed;
use App\Models\Experience;
use App\Models\Favorites;
use App\Models\Main\Vacancy;
use App\Models\Schedule;
use App\Models\Subscriber;
use App\Models\Tag;
use App\Models\User;
use Drandin\DeclensionNouns\Facades\DeclensionNoun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class VacanciesController extends Controller
{
    public function sitemap() {
        $vacs = Vacancy::get();
        return view('sitemap')->with(compact('vacs'));
    }

    public function index()
    {
        /*dd(Str::slug(''));*/
        $user = Auth::user();
        $vacs = Vacancy::with('tags', 'experience', 'schedule')
            ->orderByDesc('created_at')
            ->where('is_active', 1)
            ->paginate(10);
        $schedules = Schedule::pluck('title', 'id')->all();
        $experiences = Experience::pluck('title', 'id')->all();
        $rowCountVacs = DeclensionNoun::make($vacs->total(), "вакансия");
        $countFilter = 0;
        $countVacs = $vacs->total();

        $meta_description = ' с графиками: '.implode(", ", $schedules).
            '. Без опыта, с опытом';

        return view('index',
            compact('vacs', 'user', 'schedules', 'experiences', 'rowCountVacs',
                'countFilter', 'meta_description', 'countVacs'));
    }

    public function create() {
        $user = Auth::user();
        $schedules = Schedule::pluck('title', 'id')->all();
        $experiences = Experience::pluck('title', 'id')->all();
        $tags = Tag::orderBy('title');
        return view('vacancies.create', compact( 'user', 'schedules', 'experiences', 'tags'));
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'required',
            'min_salary' => 'required',
            'max_salary' => 'nullable',
            'schedule' => 'required',
            'experience' => 'required',
            'description' => 'nullable',
            'employer' => 'required',
            'address' => 'required',
            'contacts' => 'required',
            'tags' => 'nullable',
        ]);
        $user_id = Auth::user()->id;
        try {
            $vac = Vacancy::create([
                'user_id' => $user_id,
                'title' => $request->title,
                'min_salary' => $request->min_salary,
                'max_salary' => $request->max_salary,
                'schedule_id' => $request->schedule,
                'experience_id' => $request->experience,
                'description' => $request->description,
                'employer' => $request->employer,
                'address' => $request->address,
                'contacts' => $request->contacts,
            ]);
            $vacCopy = $vac;
            $vac->tags()->sync($request->tags);

            $subs = Subscriber::with('tag')->whereIn('tag_id', $request->tags)->get();

            foreach ($subs as $sub) {
                Mail::to($sub->email)->send(new TagSubscribed($sub, $vacCopy));
            }
            session()->flash('success', 'Вакансия успешно размещена!');
            return redirect()->route('myProfile');
        }

        catch (\Throwable $e) {
            session()->flash('error', 'Ошибка');
            //return response()->json(['error'=>$e]);
            return redirect()->back();
        }

    }

    public function deactivate() {

    }

    public function show($id) {
        $vac = Vacancy::with('schedule', 'experience')->find($id);
        $user = Auth::user();
        $isFavorite = false;
        /*dd(User::find($user->id)->favorites);*/
        if ($user != null) {
            foreach (User::find($user->id)->favorites as $fav) {
                if ($fav->id == $id) {
                    $isFavorite = true;
                }
            }
        }

        $meta_description = $vac->tags->implode('title', ", ").
            '. С опытом - '.$vac->experience->title.'- с графиком - '.$vac->schedule->title;

        return view('vacancies.show', compact('vac', 'user', 'isFavorite',
            'meta_description'));
    }

    public function addFavorites(Request $request) {
        try {
            Auth::user()->favorites()->attach($request->vacancy_id);
            /*Favorites::create(['vacancy_id' => $request->vacancy_id, 'user_id' => Auth::user()->id]);*/
            return response()->json(['success'=>$request->vacancy_id]);
        }
        catch (\Throwable $e) {
            return response()->json(['error'=>$e]);
        }
    }

    public function deleteFavorites(Request $request) {
        try {
            Auth::user()->favorites()->detach($request->vacancy_id);
            return response()->json(['success'=>$request->vacancy_id]);
        }
        catch (\Throwable $e) {
            return response()->json(['error'=>$e]);
        }
    }
}
