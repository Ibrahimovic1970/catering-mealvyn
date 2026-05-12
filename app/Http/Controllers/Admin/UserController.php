<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('level', '!=', 'ceo') // CEO tidak bisa dihapus/diedit oleh admin
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'level' => 'required|in:admin,pelanggan',
            'telepon' => 'nullable|string|max:15',
            'alamat' => 'nullable|string',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'level' => $validated['level'],
            'telepon' => $validated['telepon'] ?? null,
            'alamat' => $validated['alamat'] ?? null,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User berhasil ditambahkan.');
    }

    public function edit(User $user)
    {
        if ($user->level === 'ceo') {
            return redirect()->route('admin.users.index')->with('error', 'Tidak bisa edit CEO.');
        }

        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        if ($user->level === 'ceo') {
            return redirect()->route('admin.users.index')->with('error', 'Tidak bisa edit CEO.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8',
            'level' => 'required|in:admin,pelanggan',
            'telepon' => 'nullable|string|max:15',
            'alamat' => 'nullable|string',
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->level = $validated['level'];
        $user->telepon = $validated['telepon'] ?? null;
        $user->alamat = $validated['alamat'] ?? null;

        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'User berhasil diupdate.');
    }

    public function destroy(User $user)
    {
        if ($user->level === 'ceo') {
            return redirect()->route('admin.users.index')->with('error', 'Tidak bisa hapus CEO.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus.');
    }
}
