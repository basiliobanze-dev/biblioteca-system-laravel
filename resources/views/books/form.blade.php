<div class="form-container">    
        <!-- c1 -->
        <div>
            <div class="form-group">
                <label for="title" class="form-label">Título</label>
                <input type="text" id="title" name="title" class="form-input" value="{{ old('title', $book->title ?? '') }}" required>
            </div>

            <div class="form-group">
                <label for="author" class="form-label">Autor</label>
                <input type="text" id="author" name="author" class="form-input" value="{{ old('author', $book->author ?? '') }}" required>
            </div>

            <div class="form-group">
                <label for="publisher" class="form-label">Editora</label>
                <input type="text" id="publisher" name="publisher" class="form-input" value="{{ old('publisher', $book->publisher ?? '') }}">
            </div>

            <div class="form-group">
                <label for="description" class="form-label">Descrição</label>
                <textarea id="description" name="description" class="form-textarea" rows="4" required>{{ old('description', $book->description ?? '') }}</textarea>
            </div>
        </div>

        <!-- c2 -->
        <div>
            <div class="form-group">
                <label for="year" class="form-label">Ano</label>
                <input type="number" id="year" name="year" class="form-input" value="{{ old('year', $book->year ?? '') }}">
            </div>

            <div class="form-group">
                <label for="isbn" class="form-label">ISBN</label>
                <input type="text" id="isbn" name="isbn" class="form-input" value="{{ old('isbn', $book->isbn ?? '') }}" required>
            </div>

            <!-- <div class="form-group">
                <label for="quantity_total" class="form-label">Quantidade</label>
                <input type="number" id="quantity_total" name="quantity_total" class="form-input" value="{{ old('quantity_total', $book->quantity_total ?? '') }}" required>
            </div> -->

            <div class="form-group-row">
                <div class="form-group">
                    <label for="quantity_total" class="form-label">Quantidade</label>
                    <input type="number" id="quantity_total" name="quantity_total" class="form-input" value="{{ old('quantity_total', $book->quantity_total ?? '') }}" required>
                
                    @error('quantity_total')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="status" class="form-label">Estado</label>

                    <select id="status" name="status" class="form-input">
                        <option value="ativo" {{ old('status', $book->status ?? '') === 'ativo' ? 'selected' : '' }}>Ativo</option>
                        <option value="inativo" {{ old('status', $book->status ?? '') === 'inativo' ? 'selected' : '' }}>Inativo</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="cover_image" class="form-label">Foto da Capa</label>

                <div class="cover-file-container">
                    @if (!empty($book->cover_image))
                        <div class="cover-preview">
                            <img src="{{ asset('storage/covers/' . $book->cover_image) }}"
                                alt="Capa do livro"
                                class="cover-image-preview-small">
                        </div>
                    @else
                        <p class="no-cover">Sem capa.</p>
                    @endif

                    <input type="file" id="cover_image" name="cover_image" class="form-input-file" accept="image/*">
                </div>
            </div>

        </div>
    </div>

    <div class="form-actions">
        <button type="submit" class="btn-save">Salvar</button>
        <a href="{{ route('books.index') }}" class="btn-back">Voltar</a>
    </div>

</div>



    
