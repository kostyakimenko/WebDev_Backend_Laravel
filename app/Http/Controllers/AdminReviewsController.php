<?php

namespace App\Http\Controllers;

use App\Review;
use Illuminate\Http\Request;
use App\Film;

class AdminReviewsController extends Controller
{
    public function index()
    {
        $reviews = Review::all();

        $films = Film::all()->pluck('name')->toArray();

        return view('admin.reviews', ['reviews' => $reviews, 'films' => $films]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'review' => 'required|max:1000'
        ]);

        $review = Review::where('id', '=', $request['review_id'])->first();

        $review->film = $request['film'];
        $review->rating = $request['rating'];
        $review->review = $request['review'];
        $review->save();

        return redirect('/admin/reviews');
    }

    public function delete($id)
    {
        Review::where('id', '=', $id)->delete();

        return redirect('admin/reviews');
    }
}
