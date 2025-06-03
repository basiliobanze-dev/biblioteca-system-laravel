@extends('layouts.app')

@section('content')
    <form id="edit-profile-form" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('profile.form')
    </form>
@endsection