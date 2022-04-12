@extends('layouts.app')
@section('content')
    <div class="row offset-2">
        <h2>Добро пожаловать, {{ Auth::user()->name }}</h2>
        <br>
        @if(Auth::user()->is_admin)
           <a href="{{ route('admin.index') }}">В админку</a>
        @endif
        @if(Auth::user()->avatar)
            <img src="{{ Auth::user()->avatar }}" style="width:250px;">
        @endif
    </div>
@endsection