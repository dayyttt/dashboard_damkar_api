<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Kelola Anggota - Absensi Damkar Merangin Jakarta</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"/>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        "primary": "#DC2626",
                        "background-light": "#f6f7f8",
                    },
                    fontFamily: {
                        "display": ["Inter"]
                    },
                },
            },
        }
    </script>
</head>
<body class="bg-background-light font-display text-slate-900 antialiased h-screen flex overflow-hidden">

@include('layouts.sidebar')

<main class="flex-1 flex flex-col overflow-hidden">
    @include('layouts.header')

    <div class="flex-1 overflow-y-auto p-8 bg-background-light">
        <!-- Page Header -->
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-slate-900">Kelola Anggota</h1>
                <p class="text-sm text-slate-500 mt-1">Manajemen data personel Damkar Merangin Jakarta</p>
            </div>
            <a href="{{ route('members.create') }}" class="flex items-center gap-2 px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary/90 transition-colors">
                <span class="material-icons text-sm">add</span>
                Tambah Anggota
            </a>
        </div>

        @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-800 rounded-lg flex items-center gap-3">
            <span class="material-icons">check_circle</span>
            <span>{{ session('success') }}</span>
        </div>
        @endif

        <!-- Filters -->
        <div class="bg-white border border-slate-200 rounded-xl p-6 mb-6">
            <form method="GET" action="{{ route('members.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Cari</label>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Nama, NIP, NRP..." class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Sektor</label>
                    <select name="sector_id" class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                        <option value="">Semua Sektor</option>
                        @foreach($sectors as $sector)
                        <option value="{{ $sector->id }}" {{ request('sector_id') == $sector->id ? 'selected' : '' }}>{{ $sector->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Regu</label>
                    <select name="regu" class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                        <option value="">Semua Regu</option>
                        <option value="A" {{ request('regu') == 'A' ? 'selected' : '' }}>Regu A</option>
                        <option value="B" {{ request('regu') == 'B' ? 'selected' : '' }}>Regu B</option>
                        <option value="C" {{ request('regu') == 'C' ? 'selected' : '' }}>Regu C</option>
                    </select>
                </div>
                <div class="flex items-end gap-2">
                    <button type="submit" class="flex-1 px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary/90 transition-colors">
                        Filter
                    </button>
                    <a href="{{ route('members.index') }}" class="px-4 py-2 border border-slate-300 text-slate-700 rounded-lg hover:bg-slate-50 transition-colors">
                        Reset
                    </a>
                </div>
            </form>
        </div>

        <!-- Members Table -->
        <div class="bg-white border border-slate-200 rounded-xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-slate-50 border-b border-slate-200">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-bold text-slate-700 uppercase tracking-wider">Nama</th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-slate-700 uppercase tracking-wider">NIP</th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-slate-700 uppercase tracking-wider">Pangkat</th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-slate-700 uppercase tracking-wider">Jabatan</th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-slate-700 uppercase tracking-wider">Sektor</th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-slate-700 uppercase tracking-wider">Regu</th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-slate-700 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-right text-xs font-bold text-slate-700 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200">
                        @forelse($members as $member)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-primary/10 text-primary flex items-center justify-center font-bold text-sm">
                                        {{ substr($member->name, 0, 2) }}
                                    </div>
                                    <div>
                                        <p class="font-medium text-slate-900">{{ $member->name }}</p>
                                        <p class="text-xs text-slate-500">{{ $member->nrp }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-600">{{ $member->nip }}</td>
                            <td class="px-6 py-4 text-sm text-slate-600">{{ $member->pangkat }}</td>
                            <td class="px-6 py-4 text-sm text-slate-600">{{ $member->jabatan }}</td>
                            <td class="px-6 py-4 text-sm text-slate-600">{{ $member->sector->name }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 bg-primary/10 text-primary text-xs font-bold rounded">
                                    Regu {{ $member->regu }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                @if($member->is_active)
                                <span class="px-2 py-1 bg-green-100 text-green-700 text-xs font-bold rounded">Aktif</span>
                                @else
                                <span class="px-2 py-1 bg-slate-100 text-slate-700 text-xs font-bold rounded">Nonaktif</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('members.show', $member) }}" class="p-2 text-slate-600 hover:text-primary hover:bg-slate-100 rounded-lg transition-colors" title="Detail">
                                        <span class="material-icons text-sm">visibility</span>
                                    </a>
                                    <a href="{{ route('members.edit', $member) }}" class="p-2 text-slate-600 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Edit">
                                        <span class="material-icons text-sm">edit</span>
                                    </a>
                                    <form method="POST" action="{{ route('members.destroy', $member) }}" onsubmit="return confirm('Yakin ingin menghapus anggota ini?')" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 text-slate-600 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Hapus">
                                            <span class="material-icons text-sm">delete</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="px-6 py-12 text-center">
                                <span class="material-icons text-6xl text-slate-300 mb-4">person_off</span>
                                <p class="text-slate-500">Tidak ada data anggota</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if($members->hasPages())
            <div class="px-6 py-4 border-t border-slate-200">
                {{ $members->links() }}
            </div>
            @endif
        </div>
    </div>
</main>

</body>
</html>
