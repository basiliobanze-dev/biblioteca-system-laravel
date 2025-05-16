<div class="mb-3">
    <label for="title" class="form-label">Título</label>
    <input type="text" class="form-control" name="title" value="{{ old('title', $book->title ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="author" class="form-label">Autor</label>
    <input type="text" class="form-control" name="author" value="{{ old('author', $book->author ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="publisher" class="form-label">Editora</label>
    <input type="text" class="form-control" name="publisher" value="{{ old('publisher', $book->publisher ?? '') }}">
</div>

<div class="mb-3">
    <label for="description" class="form-label">Descrição</label>
    <input type="text" class="form-control" name="description" value="{{ old('description', $book->description ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="year" class="form-label">Ano</label>
    <input type="number" class="form-control" name="year" value="{{ old('year', $book->year ?? '') }}">
</div>

<div class="mb-3">
    <label for="isbn" class="form-label">ISBN</label>
    <input type="text" class="form-control" name="isbn" value="{{ old('isbn', $book->isbn ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="quantity_total" class="form-label">Quantidade</label>
    <input type="number" class="form-control" name="quantity_total" value="{{ old('quantity_total', $book->quantity_total ?? '') }}" required>
</div>

<button type="submit" class="btn btn-success">Salvar</button>
<a href="{{ route('books.index') }}" class="btn btn-secondary">Voltar</a>