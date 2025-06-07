<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index(Request $request)
    {
        $query = User::query();

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $users = $query->paginate(10)->appends($request->only('search'));

        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'role'  => 'required|in:admin,librarian,reader',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt('123456'),
            'role'     => $request->role,
        ]);


        // Agora $user está definido corretamente
        $this->logAudit('create', 'User', $user->id, 'Criou um novo usuário: ' . $user->name);
        return redirect()->route('users.index')->with('success', 'Usuário criado com sucesso!');
    }


    public function show(User $user)
    {
        $user->load('account'); // load data of account
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed',
            'role'  => 'required|in:admin,librarian,reader',
        ]);

        // Se was gives new password
        // if (!empty($validated['password'])) {
        //     $validated['password'] = \Hash::make($validated['password']);
        // } else {
        //     unset($validated['password']);
        // }

        $user->update($validated);

        return redirect()->route('users.index')->with('success', 'Usuário actualizado com sucesso!');
    }



    public function destroy(User $user)
    {
        $user->delete();
        // $user->status = 'inativo';
        // $user->save();

        return redirect()->route('users.index')->with('success', 'Usuário Excluído com sucesso!');
    }

}
