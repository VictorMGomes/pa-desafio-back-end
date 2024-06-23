<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function get(Request $request)
    {
        return User::findOrFail($request->route('ID'));
    }

    public function getAll(Request $request)
    {
        return User::all();
    }

    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'string', 'unique:users'],
            'password' => ['required', 'string', 'min:6'],
        ]);

        return User::create($validatedData);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validatedData = $request->validate([
            'name' => ['nullable', 'string'],
            'email' => ['nullable', 'email', 'unique:users,email,'.$user->id],
            'password' => ['nullable', 'string', 'min:6'],
        ]);

        $user->update($validatedData);

        return $user;
    }
}
