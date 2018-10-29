@extends('layouts.app')

@section('content')
    <div class="container w-75">

        @if ($errors->any())
            <div class="alert alert-danger">
                <h6 class="text-danger">User {{ session('error_id') }} error:</h6>
                <ul>
                @foreach ($errors->all() as $error)
                    <li class="small text-danger">{{ $error }}</li>
                @endforeach
                </ul>
            </div>
        @endif

        <div class="row ml-4">
            <div class="col-1 text-center">ID</div>
            <div class="col-2 text-center">Username</div>
            <div class="col-2 text-center">Role</div>
            <div class="col-2 text-center">Access</div>
            <div class="col-2 text-center">Email</div>
        </div>

        @foreach ($users as $user)
            {!! Form::open() !!}
            <div class="row ml-4 mt-2">
                <div class="col-1 text-center">
                    {{ $user->id }} {!! Form::hidden('user_id', $user->id) !!}
                </div>
                <div class="col-2">
                    {!! Form::text('username', $user->name, ['class' => 'form-control form-control-sm']) !!}
                </div>
                <div class="col-2">
                    {!! Form::select('role', ['admin' => 'admin', 'user' => 'user'], $user->role, ['class' => 'form-control form-control-sm']) !!}
                </div>
                <div class="col-2">
                    {!! Form::select('access', ['unblocked' => 'unblocked', 'blocked' => 'blocked'], $user->access, ['class' => 'form-control form-control-sm']) !!}
                </div>
                <div class="col-2">
                    {!! Form::email('email', $user->email, ['class' => 'form-control form-control-sm']) !!}
                </div>
                <div class="col-1">{!! Form::submit('Submit changes', ['class' => 'btn btn-success btn-sm']) !!}</div>
            </div>

            {!! Form::close() !!}
        @endforeach

    </div>
@endsection