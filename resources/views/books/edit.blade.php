{{-- edit.blade.php --}}
@extends('layouts.app')

@section('content')
<h2>Editar Livro</h2>
<form method="POST" action="{{ route('books.update', $book) }}">
    @csrf
    @method('PUT')
    @include('books.form')
</form>
@endsection