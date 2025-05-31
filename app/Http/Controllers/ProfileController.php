<?php

namespace App\Http\Controllers;

use App\Account;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();

        // Create empty account if doesn't exist
        if (!$user->account) {
            $user->account()->create();
            $user->refresh(); // reload of DB includ
        }

        return view('profile.show', ['user' => $user->load('account')]);
    }


    public function edit()
    {
        $user = Auth::user()->load('account');
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $account = $user->account ?? new Account(['user_id' => $user->id]);

        $request->validate([
            'name' => 'required|string|max:255',
            'gender' => 'nullable|in:M,F',
            'birth_date' => 'nullable|date',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Atualiza o nome do usuário
        $user->update(['name' => $request->name]);

        // Foto de perfil
        if ($request->hasFile('profile_image')) {
            $path = $request->file('profile_image')->store('public/profiles');
            $account->profile_image = basename($path);
        }

        // Atualiza os outros dados do perfil
        $account->fill($request->only(['gender', 'birth_date', 'phone', 'address']));
        $account->user_id = $user->id;
        $account->save();

        return redirect()->route('profile.show')->with('success', 'Perfil actualizado com sucesso!');
    }
}
