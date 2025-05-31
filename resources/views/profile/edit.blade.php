@extends('layouts.app')

@section('content')
    <section class="edit-profile-container">

        <!-- C1 -->
        <div class="profile-column">
            <label for="profile_image" class="upload-image-wrapper">
                <input type="file" name="profile_image" id="profile_image" accept="image/*" onchange="previewProfileImage(event)">
                @if ($user->account && $user->account->profile_image)
                    <img id="preview" src="{{ asset('storage/profiles/' . $user->account->profile_image) }}" alt="Foto de Perfil">
                @else
                    <img id="preview" src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=ccc&color=555&size=100&rounded=true" alt="Avatar Padrão">
                @endif
            </label>
            <p class="upload-hint">Clique para alterar</p>
        </div>

        <!-- C2 -->
        <div class="form-column">
            <form id="edit-profile-form" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="edit-profile-form">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Nome</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required>
                </div>

                <div class="form-group">
                    <label for="gender">Gênero</label>
                    <select name="gender" id="gender">
                        <option value="">--</option>
                        <option value="M" {{ old('gender', $user->account->gender ?? '') == 'M' ? 'selected' : '' }}>M</option>
                        <option value="F" {{ old('gender', $user->account->gender ?? '') == 'F' ? 'selected' : '' }}>F</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="birth_date">Data de Nascimento</label>
                    <input type="date" name="birth_date" id="birth_date" value="{{ old('birth_date', $user->account->birth_date ?? '') }}">
                </div>

                <div class="form-group">
                    <label for="phone">Telefone</label>
                    <input type="text" name="phone" id="phone" value="{{ old('phone', $user->account->phone ?? '') }}">
                </div>

                <div class="form-group">
                    <label for="address">Endereço</label>
                    <input type="text" name="address" id="address" value="{{ old('address', $user->account->address ?? '') }}">
                </div>
            </form>
        </div>
    </section>

    <div class="profile-edit-form-actions">
        <button type="submit" class="btn-save" form="edit-profile-form">Salvar</button>
        <a href="{{ route('profile.show') }}" class="btn-back">Cancelar</a>
    </div>

    <script>
        function previewProfileImage(event) {
            const input = event.target;
            const preview = document.getElementById('preview');

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
