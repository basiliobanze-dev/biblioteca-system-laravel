<div>
    <div class="user-form-container">

        @if ($errors->any())
            <div class="user-form-errors">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="form-group">
            <label for="name" class="form-label">Nome</label>
            <input type="text" id="name" name="name" value="{{ old('name', $user->name ?? '') }}" class="user-form-input" required>
        </div>

        <div class="form-group">
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email', $user->email ?? '') }}" class="user-form-input" required>
        </div>

        <div class="form-group">
            <label for="role" class="form-label">Perfil</label>
                
            <select id="role" name="role" class="user-form-select" required>
                <option value="reader" {{ old('role', $user->role ?? '') === 'reader' ? 'selected' : '' }}>Leitor</option>
                <option value="librarian" {{ old('role', $user->role ?? '') === 'librarian' ? 'selected' : '' }}>Bibliotecário</option>    
                <option value="admin" {{ old('role', $user->role ?? '') === 'admin' ? 'selected' : '' }}>Administrador</option>
            </select>
        </div>
    </div>

    <div class="user-form-actions">
        <button type="submit" class="btn-save">Salvar</button>
        <a href="{{ route('users.index') }}" class="btn-back">Voltar</a>
    </div>
</div>
