<?php

namespace App\Http\Controllers;

use App\Models\Main\Vacancy;
use App\Models\Tag;
use Illuminate\Http\Request;

class SitemapController extends Controller
{
    public function index()
    {
        $vac = Vacancy::orderBy('created_at', 'desc')->first();
        $tag = Tag::orderBy('created_at', 'desc')->first();

        return response()->view('sitemap.index', [
            'vac' => $vac,
            'tag' => $tag,
        ])->header('Content-Type', 'text/xml');
    }

    public function vacancies()
    {
        $vacs = Vacancy::orderBy('created_at', 'desc')->get();
        return response()->view('sitemap.vacancies', [
            'vacs' => $vacs,
        ])->header('Content-Type', 'text/xml');
    }

    public function tags()
    {
        $tags = Tag::orderBy('created_at', 'desc')->get();
        return response()->view('sitemap.tags', [
            'tags' => $tags,
        ])->header('Content-Type', 'text/xml');
    }
}
