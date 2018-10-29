@extends('layouts.app')

@section('content')
    <div class="container w-50">
        {!! Form::open() !!}
        <div class="form-group">
            {!! Form::label('film', 'Select film:') !!}
            {!! Form::select('film', $films, key($films), ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('rating', 'Select rating:') !!}
            {!! Form::selectRange('rating', 1, 10, 1, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('review', 'Review:', ['class' => 'form-control-label']) !!}
            {!! Form::textarea('review', null, ['class' => 'form-control', 'id' => 'review']) !!}

            @if ($errors->has('review'))
                <span class="text-danger">
                {{ $errors->first('review') }}
            </span>
            @endif
        </div>

        {!! Form::submit('Add review', ['class' => 'btn btn-primary btn-block']) !!}
        {!! Form::close() !!}
    </div>
@endsection