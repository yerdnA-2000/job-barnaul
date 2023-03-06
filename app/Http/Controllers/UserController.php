<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Experience;
use App\Models\Main\Vacancy;
use App\Models\Schedule;
use App\Models\User;
use Drandin\DeclensionNouns\Facades\DeclensionNoun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class UserController extends Controller
{
    public function create() {
        return view('user.create');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|unique:users',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        session()->flash('success', 'Вы успешно зарегистрированы');
        Auth::login($user);
        return redirect()->home();
    }

    public function login (Request $request) {
        $request->validate([
            'email' =>'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
        ])) {
            /*if (Auth::user()->is_admin == 1) {
                return redirect(route('admin.index'));
            } else {
                return redirect()->home();
            }*/
            session()->flash('success', 'Вы успешно вошли на сайт!');
            return redirect()->home();
        }
        return redirect()->back()->with('error', 'Неудача');

    }

    public function logout() {
        Cache::forget('user-is-online-' . Auth::user()->id);
        Auth::logout();

        return redirect()->route('register.create');
    }

    public function showMyProfile() {
        $user = Auth::user();
        /*$company = Company::with('user')->where('user_id', $user->id)->get();*/
        $vacs = Vacancy::with('user', 'experience', 'schedule')->where('user_id', $user->id)->get();
        $experiences = Experience::all();
        $schedules = Schedule::all();
        $rowCountVacs = DeclensionNoun::make(count($vacs), "вакансия");

        $favVacs = User::find($user->id)->favorites;
        $rowCountFavVacs = DeclensionNoun::make(count($favVacs), "вакансия");

        return view('user.my_profile',
            compact('user', 'vacs', 'experiences', 'schedules', 'rowCountVacs', 'favVacs', 'rowCountFavVacs'));
    }
}
