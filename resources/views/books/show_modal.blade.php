<div class="modal fade" id="bookDetailsModal{{ $book->id }}" tabindex="-1" aria-labelledby="bookDetailsLabel{{ $book->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="book-details-container">
                <div class="book-cover">
                    @if($book->cover_image)
                        <img src="{{ asset('storage/covers/' . $book->cover_image) }}" alt="Capa do livro {{ $book->title }}" class="img-fluid">
                    @else
                        <div class="no-cover-preview">
                            <i class="fas fa-book"></i>
                            <span>Sem Capa</span>
                        </div>
                    @endif
                </div>

                <div class="book-info">
                    <h2>{{ $book->title }}</h2>

                    <div class="book-field">
                        <span class="label"><i class="fas fa-user"></i> Autor:</span>
                        <span class="value">{{ $book->author }}</span>
                    </div>

                    @if($book->publisher)
                    <div class="book-field">
                        <span class="label"><i class="fas fa-building"></i> Editora:</span>
                        <span class="value">{{ $book->publisher }}</span>
                    </div>
                    @endif

                    @if($book->description)
                    <div class="book-field">
                        <span class="label"><i class="fas fa-align-left"></i> Descrição:</span>
                        <span class="value">{{ $book->description }}</span>
                    </div>
                    @endif

                    @if($book->year)
                    <div class="book-field">
                        <span class="label"><i class="fas fa-calendar-alt"></i> Ano:</span>
                        <span class="value">{{ $book->year }}</span>
                    </div>
                    @endif

                    @if($book->isbn)
                    <div class="book-field">
                        <span class="label"><i class="fas fa-barcode"></i> ISBN:</span>
                        <span class="value">{{ $book->isbn }}</span>
                    </div>
                    @endif

                    <div class="book-field">
                        <span class="label"><i class="fas fa-check-circle"></i> Estado:</span>
                        <span class="value">{{ ucfirst($book->status) }}</span>
                    </div>

                    <div class="book-field">
                        <span class="label"><i class="fas fa-layer-group"></i> Total:</span>
                        <span class="value">{{ $book->quantity_total }}</span>
                    </div>

                    <div class="book-field">
                        <span class="label"><i class="fas fa-book-open"></i> Disponível:</span>
                        <span class="value">{{ $book->quantity_available }}</span>
                    </div>

                    <div class="book-actions">
                        <a href="#" class="btn-close top-right" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fas fa-times"></i>
                        </a>

                        @if(in_array(auth()->user()->role, ['admin', 'librarian']))
                            <div class="action-buttons bottom-right">
                                <a href="{{ route('books.edit', $book) }}" class="btn-edit" title="Editar"><i class="fas fa-pencil-alt"></i></a>
                                <form action="{{ route('books.destroy', $book) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn-remove" title="Remover" onclick="return confirm('Tem certeza?')">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>