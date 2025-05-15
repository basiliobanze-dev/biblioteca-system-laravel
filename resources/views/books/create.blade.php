{{-- create.blade.php --}}
@extends('layouts.app')

@section('content')
<h2>Novo Livro</h2>
<form method="POST" action="{{ route('books.store') }}">
    @csrf
    @include('books.form')
</form>
@endsection