@extends('admin.layouts.admin')

@section('title', 'Manajemen User')
@section('page-title', 'Manajemen User')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Daftar User</h3>
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">+ Tambah User</a>
    </div>
    <div class="card-body" style="padding: 0;">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Telepon</th>
                    <th>Level</th>
                    <th>Terdaftar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td><strong>{{ $user->name }}</strong></td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->telepon ?? '-' }}</td>
                    <td>
                        @php
                        $badgeClass = 'badge-primary';
                        if($user->level == 'admin') $badgeClass = 'badge-success';
                        elseif($user->level == 'ceo') $badgeClass = 'badge-danger';
                        @endphp
                        <span class="badge {{ $badgeClass }}">{{ ucfirst($user->level) }}</span>
                    </td>
                    <td>{{ $user->created_at->format('d M Y') }}</td>
                    <td>
                        <div style="display: flex; gap: 8px;">
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus user ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="text-align: center; padding: 40px; color: #999;">
                        Belum ada user
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@if($users->hasPages())
<div style="margin-top: 20px;">
    {{ $users->links() }}
</div>
@endif
@endsection