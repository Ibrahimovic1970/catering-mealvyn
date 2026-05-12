@extends('admin.layouts.admin')

@section('title', 'Tambah User')
@section('page-title', 'Tambah User Baru')

@section('content')
<div class="card" style="max-width: 600px;">
    <div class="card-header">
        <h3>Form Tambah User</h3>
    </div>
    <div class="card-body">
        @if($errors->any())
        <div class="alert alert-danger">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf
            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 500;">Nama Lengkap *</label>
                <input type="text" name="name" value="{{ old('name') }}" required
                    style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 1rem;">
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 500;">Email *</label>
                <input type="email" name="email" value="{{ old('email') }}" required
                    style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 1rem;">
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 500;">Password *</label>
                <input type="password" name="password" required
                    style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 1rem;">
                <small style="color: #6b6b6b; font-size: 0.85rem;">Minimal 8 karakter</small>
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 500;">Level *</label>
                <select name="level" required
                    style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 1rem;">
                    <option value="pelanggan" {{ old('level') == 'pelanggan' ? 'selected' : '' }}>Pelanggan</option>
                    <option value="admin" {{ old('level') == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 500;">Telepon</label>
                <input type="text" name="telepon" value="{{ old('telepon') }}"
                    style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 1rem;">
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 500;">Alamat</label>
                <textarea name="alamat" rows="3"
                    style="width: 100%; padding: 12px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 1rem; resize: vertical;">{{ old('alamat') }}</textarea>
            </div>

            <div style="display: flex; gap: 12px;">
                <button type="submit" class="btn btn-primary">Simpan User</button>
                <a href="{{ route('admin.users.index') }}" class="btn" style="background: #6c757d; color: white;">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection