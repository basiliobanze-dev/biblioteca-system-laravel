{{-- edit.blade.php --}}
@extends('layouts.app')

@section('content')
<form method="POST" action="{{ route('books.update', $book) }}">
    @csrf
    @method('PUT')
    @include('books.form')
</form>
@endsection