@extends('admin.layouts.admin')

@section('title', 'Edit Paket')
@section('page-title', 'Edit Paket Catering')

@section('content')
<div class="card" style="max-width: 900px;">
    <div class="card-header">
        <h3 style="margin: 0;">Edit Paket: {{ $paket->nama_paket }}</h3>
    </div>
    <div class="card-body">
        @if($errors->any())
        <div style="background: #fee2e2; color: #991b1b; padding: 16px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #fecaca;">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('admin.paket.update', $paket->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 500; color: #333;">Nama Paket *</label>
                    <input type="text" name="nama_paket" value="{{ old('nama_paket', $paket->nama_paket) }}" required style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; font-size: 1rem;">
                </div>
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 500; color: #333;">Kategori *</label>
                    <select name="kategori" required style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; font-size: 1rem;">
                        <option value="Pernikahan" {{ old('kategori', $paket->kategori) == 'Pernikahan' ? 'selected' : '' }}>Pernikahan</option>
                        <option value="Selamatan" {{ old('kategori', $paket->kategori) == 'Selamatan' ? 'selected' : '' }}>Selamatan</option>
                        <option value="Ulang Tahun" {{ old('kategori', $paket->kategori) == 'Ulang Tahun' ? 'selected' : '' }}>Ulang Tahun</option>
                        <option value="Studi Tour" {{ old('kategori', $paket->kategori) == 'Studi Tour' ? 'selected' : '' }}>Studi Tour</option>
                        <option value="Rapat" {{ old('kategori', $paket->kategori) == 'Rapat' ? 'selected' : '' }}>Rapat</option>
                    </select>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 500; color: #333;">Jenis *</label>
                    <select name="jenis" required style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; font-size: 1rem;">
                        <option value="Box" {{ old('jenis', $paket->jenis) == 'Box' ? 'selected' : '' }}>Box</option>
                        <option value="Prasmanan" {{ old('jenis', $paket->jenis) == 'Prasmanan' ? 'selected' : '' }}>Prasmanan</option>
                    </select>
                </div>
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 500; color: #333;">Jumlah Pax *</label>
                    <input type="number" name="jumlah_pax" value="{{ old('jumlah_pax', $paket->jumlah_pax) }}" required min="1" style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; font-size: 1rem;">
                </div>
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 500; color: #333;">Harga Per Pax (Rp) *</label>
                    <input type="number" name="harga_paket" value="{{ old('harga_paket', $paket->harga_paket) }}" required min="0" style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; font-size: 1rem;">
                </div>
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 500; color: #333;">Deskripsi Paket *</label>
                <textarea name="deskripsi" rows="4" required style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; font-size: 1rem; resize: vertical;">{{ old('deskripsi', $paket->deskripsi) }}</textarea>
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 12px; font-weight: 500; color: #333;">Upload Foto Baru (Kosongkan jika tidak ingin mengubah)</label>
                <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px;">
                    <div>
                        @if($paket->foto1)
                        <img src="{{ asset('storage/' . $paket->foto1) }}" style="width: 100%; height: 120px; object-fit: cover; border-radius: 8px; margin-bottom: 8px; border: 1px solid #eee;">
                        @endif
                        <input type="file" name="foto1" accept="image/*" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 8px; font-size: 0.9rem;">
                        <small style="color: #666;">Foto Utama</small>
                    </div>
                    <div>
                        @if($paket->foto2)
                        <img src="{{ asset('storage/' . $paket->foto2) }}" style="width: 100%; height: 120px; object-fit: cover; border-radius: 8px; margin-bottom: 8px; border: 1px solid #eee;">
                        @endif
                        <input type="file" name="foto2" accept="image/*" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 8px; font-size: 0.9rem;">
                        <small style="color: #666;">Foto Tambahan 1</small>
                    </div>
                    <div>
                        @if($paket->foto3)
                        <img src="{{ asset('storage/' . $paket->foto3) }}" style="width: 100%; height: 120px; object-fit: cover; border-radius: 8px; margin-bottom: 8px; border: 1px solid #eee;">
                        @endif
                        <input type="file" name="foto3" accept="image/*" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 8px; font-size: 0.9rem;">
                        <small style="color: #666;">Foto Tambahan 2</small>
                    </div>
                </div>
            </div>

            <div style="margin-bottom: 24px; display: flex; align-items: center; gap: 10px; padding: 12px; background: {{ $paket->is_active ? '#f0fdf4' : '#fef2f2' }}; border-radius: 8px; border: 1px solid {{ $paket->is_active ? '#bbf7d0' : '#fecaca' }};">
                <input type="checkbox" name="is_active" id="is_active" value="1" {{ $paket->is_active ? 'checked' : '' }} style="width: 18px; height: 18px; accent-color: #1a5632;">
                <label for="is_active" style="font-weight: 500; color: {{ $paket->is_active ? '#166534' : '#991b1b' }};">Tampilkan paket ini di website</label>
            </div>

            <div style="display: flex; gap: 12px; border-top: 1px solid #eee; padding-top: 20px;">
                <button type="submit" style="padding: 12px 24px; background: #1a5632; color: white; border: none; border-radius: 8px; font-weight: 600; cursor: pointer;">Update Paket</button>
                <a href="{{ route('admin.paket.index') }}" style="padding: 12px 24px; background: #6b7280; color: white; border-radius: 8px; text-decoration: none; font-weight: 500; display: inline-flex; align-items: center;">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection