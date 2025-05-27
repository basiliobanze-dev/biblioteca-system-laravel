@extends('layouts.app')

@section('content')
    <form method="POST" action="{{ route('books.update', $book->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('books.form')
    </form>
@endsection