{{-- create.blade.php --}}
@extends('layouts.app')

@section('content')
<form method="POST" action="{{ route('books.store') }}" enctype="multipart/form-data">
    @csrf
    @include('books.form')
</form>
@endsection