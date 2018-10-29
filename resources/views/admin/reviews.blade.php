@extends('layouts.app')

@section('content')
    <div class="container w-50">

        @foreach ($reviews as $review)
            <button type="button" class="btn btn-outline-success btn-block mt-2" data-toggle="collapse" data-target="#form_{{ $review->id }}" aria-expanded="false" aria-controls="form_{{ $review->id }}">
                <div class="row ml-4 mr-4">
                    <div class="col">Review_ID: {{ $review->id }}</div>
                    <div class="col">User_ID: {{ $review->user_id }}</div>
                    <div class="col-4 text-truncate">Film: {{ $review->film }}</div>
                    <div class="col">Rating: {{ $review->rating }}</div>
                </div>
            </button>

            <div class="container collapse mt-3 mb-3"  id="form_{{ $review->id }}">
                {!! Form::open() !!}
                {!! Form::hidden('review_id', $review->id) !!}

                <div class="form-group">
                    {!! Form::label('film', 'Film:') !!}
                    {!! Form::select('film', $films, array_search($review->film, $films), ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('rating', 'Rating:') !!}
                    {!! Form::selectRange('rating', 1, 10, $review->rating, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('review', 'Review:') !!}
                    {!! Form::textarea('review', $review->review, ['class' => 'form-control']) !!}
                </div>

                <div class="row ml-5 mr-5">
                    <div class="col text-center">
                        {!! Form::submit('Submit changes', ['class' => 'btn btn-primary']) !!}
                        {!! Form::close() !!}
                    </div>
                    <div class="col text-center">
                        {!! Form::open(['url' => "/admin/reviews/$review->id"]) !!}
                        {{ method_field('delete') }}
                        {!! Form::submit('Delete review', ['class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>

            </div>
        @endforeach
    </div>

@endsection