<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InfoController extends Controller
{
    public function forEmployer() {
        return view('for_employer');
    }

    public function legal() {
        return view('legal');
    }

    public function contacts() {
        return view('contacts');
    }
}
