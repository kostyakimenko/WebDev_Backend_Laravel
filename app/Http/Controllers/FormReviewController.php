<?php

namespace App\Http\Controllers;

use App\Http\Middleware\CheckUser;
use Illuminate\Http\Request;
use Auth;
use App\Review;
use App\Film;

class FormReviewController extends Controller
{
    public function index()
    {
        $this->middleware(CheckUser::class);

        return view('form-review', ['films' => $this->getFilmLists()]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'review' => 'required|max:1000'
        ]);

        Review::create([
            'user_id' => Auth::user()->id,
            'film' => $request['film'],
            'rating' => $request['rating'],
            'review' => $request['review']
        ]);

        return view('form-review', ['films' => $this->getFilmLists()]);
    }

    private function getFilmLists()
    {
        $films = Film::all()->pluck('name')->toArray();

        return array_combine($films, $films);
    }
}
