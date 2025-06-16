<div class="modal fade" id="userDetailsModal{{ $user->id }}" tabindex="-1" aria-labelledby="userDetailsLabel{{ $user->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div>
                <section class="profile-container">
                    <h1 class="profile-title">Usuário</h1>
                    <div class="profile-card">
                        <div class="profile-image">
                            @if ($user->account && $user->account->profile_image)
                                <img src="{{ asset('storage/profiles/' . $user->account->profile_image) }}" alt="Foto de Perfil">
                            @else
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=ccc&color=555&size=50&rounded=true"
                                    alt="Avatar Padrão"
                                    style="width: 120px; height: 120px; border-radius: 50%;">
                            @endif
                        </div>
                        
                        <div class="profile-info">
                            <h2>{{ $user->name }}</h2>
                            <p class="profile-email"><i class="fas fa-envelope"></i> {{ $user->email }}</p>
                            <p><strong><i class="fa-solid fa-circle-user"></i> Tipo de Perfil:</strong>
                                @if ($user->role === 'admin')
                                    Administrador
                                @elseif ($user->role === 'librarian')
                                    Bibliotecário
                                @else
                                    Leitor
                                @endif
                            </p>
                            <p><i class="fas fa-venus-mars"></i> <strong>Gênero:</strong> {{ $user->account && $user->account->gender ? $user->account->gender : '---' }}</p>
                            <p><i class="fas fa-birthday-cake"></i> <strong>Nascimento:</strong> {{ $user->account && $user->account->birth_date ? \Carbon\Carbon::parse($user->account->birth_date)->format('d/m/Y') : '---' }}</p>
                            <p><i class="fas fa-phone"></i> <strong>Telefone:</strong> {{ $user->account && $user->account->phone ? $user->account->phone : '---' }}</p>
                            <p><i class="fas fa-map-marker-alt"></i> <strong>Endereço:</strong> {{ $user->account && $user->account->address ? $user->account->address : '---' }}</p>
                        </div>
                    </div>

                    <div class="profile-actions">
                        <a href="#" class="btn-close top-right" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fas fa-times"></i>
                        </a>
                        <div class="action-buttons bottom-right">
                            <a href="{{ route('users.edit', $user) }}" class="btn-edit" title="Editar"><i class="fas fa-pencil-alt"></i></a>
                            <form action="{{ route('users.destroy', $user) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn-remove" title="Remover" onclick="return confirm('Tem certeza?')">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
