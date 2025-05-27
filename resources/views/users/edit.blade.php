@extends('layouts.app')

@section('content')
    <form method="POST" action="{{ route('users.update', $user->id) }}">
        @csrf
        @method('PUT')
        @include('users.form')
    </form>
@endsection