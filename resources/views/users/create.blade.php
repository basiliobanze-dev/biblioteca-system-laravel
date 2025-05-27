@extends('layouts.app')

@section('content')
    <form method="POST" action="{{ route('users.store') }}">
        @csrf
        @include('users.form')
    </form>
@endsection