<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Paket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PaketController extends Controller
{
    public function index()
    {
        $pakets = Paket::latest()->paginate(15);
        return view('admin.paket.index', compact('pakets'));
    }

    public function create()
    {
        return view('admin.paket.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_paket' => 'required|string|max:255',
            'jenis' => 'required|in:Prasmanan,Box',
            'kategori' => 'required|in:Pernikahan,Selamatan,Ulang Tahun,Studi Tour,Rapat',
            'jumlah_pax' => 'required|integer|min:1',
            'harga_paket' => 'required|numeric|min:0',
            'deskripsi' => 'required|string',
            'foto1' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'foto2' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'foto3' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'is_active' => 'nullable|boolean'
        ]);

        $validated['is_active'] = $request->has('is_active');

        // Upload foto 1
        if ($request->hasFile('foto1')) {
            $validated['foto1'] = $request->file('foto1')->store('pakets', 'public');
        }

        // Upload foto 2
        if ($request->hasFile('foto2')) {
            $validated['foto2'] = $request->file('foto2')->store('pakets', 'public');
        }

        // Upload foto 3
        if ($request->hasFile('foto3')) {
            $validated['foto3'] = $request->file('foto3')->store('pakets', 'public');
        }

        Paket::create($validated);
        return redirect()->route('admin.paket.index')->with('success', 'Paket berhasil ditambahkan.');
    }

    public function show(Paket $paket)
    {
        return view('admin.paket.show', compact('paket'));
    }

    public function edit(Paket $paket)
    {
        return view('admin.paket.edit', compact('paket'));
    }

    public function update(Request $request, Paket $paket)
    {
        $validated = $request->validate([
            'nama_paket' => 'required|string|max:255',
            'jenis' => 'required|in:Prasmanan,Box',
            'kategori' => 'required|in:Pernikahan,Selamatan,Ulang Tahun,Studi Tour,Rapat',
            'jumlah_pax' => 'required|integer|min:1',
            'harga_paket' => 'required|numeric|min:0',
            'deskripsi' => 'required|string',
            'foto1' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'foto2' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'foto3' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'is_active' => 'nullable|boolean'
        ]);

        $validated['is_active'] = $request->has('is_active');

        // Update foto 1
        if ($request->hasFile('foto1')) {
            // Hapus foto lama
            if ($paket->foto1) {
                Storage::disk('public')->delete($paket->foto1);
            }
            $validated['foto1'] = $request->file('foto1')->store('pakets', 'public');
        }

        // Update foto 2
        if ($request->hasFile('foto2')) {
            if ($paket->foto2) {
                Storage::disk('public')->delete($paket->foto2);
            }
            $validated['foto2'] = $request->file('foto2')->store('pakets', 'public');
        }

        // Update foto 3
        if ($request->hasFile('foto3')) {
            if ($paket->foto3) {
                Storage::disk('public')->delete($paket->foto3);
            }
            $validated['foto3'] = $request->file('foto3')->store('pakets', 'public');
        }

        $paket->update($validated);
        return redirect()->route('admin.paket.index')->with('success', 'Paket berhasil diperbarui.');
    }

    public function destroy(Paket $paket)
    {
        // Hapus semua foto
        if ($paket->foto1) {
            Storage::disk('public')->delete($paket->foto1);
        }
        if ($paket->foto2) {
            Storage::disk('public')->delete($paket->foto2);
        }
        if ($paket->foto3) {
            Storage::disk('public')->delete($paket->foto3);
        }

        $paket->delete();
        return redirect()->route('admin.paket.index')->with('success', 'Paket berhasil dihapus.');
    }
}
