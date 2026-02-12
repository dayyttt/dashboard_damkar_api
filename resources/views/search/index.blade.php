<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Hasil Pencarian - Absensi Damkar Merangin Jakarta</title>
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
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-slate-900">Hasil Pencarian</h1>
            <p class="text-sm text-slate-500 mt-1">Menampilkan hasil untuk: <span class="font-semibold text-slate-900">"{{ $query }}"</span></p>
        </div>

        <!-- Sectors Results -->
        @if($sectors->count() > 0)
        <div class="mb-8">
            <h2 class="text-lg font-bold text-slate-900 mb-4">Sektor ({{ $sectors->count() }})</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($sectors as $sector)
                <a href="{{ route('sectors.show', $sector) }}" class="bg-white border border-slate-200 rounded-xl p-5 hover:border-primary transition-colors">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center flex-shrink-0">
                            <span class="material-icons text-primary">{{ $sector->icon }}</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h3 class="font-bold text-slate-900 truncate">{{ $sector->name }}</h3>
                            <p class="text-sm text-slate-500 truncate">{{ $sector->location }}</p>
                            <div class="flex items-center gap-2 mt-2">
                                <span class="px-2 py-1 bg-slate-100 text-slate-700 text-xs font-bold rounded">
                                    {{ $sector->code }}
                                </span>
                                @if($sector->is_active)
                                <span class="px-2 py-1 bg-green-100 text-green-700 text-xs font-bold rounded">Aktif</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Members Results -->
        @if($members->count() > 0)
        <div class="mb-8">
            <h2 class="text-lg font-bold text-slate-900 mb-4">Anggota ({{ $members->count() }})</h2>
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
                                <th class="px-6 py-3 text-right text-xs font-bold text-slate-700 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200">
                            @foreach($members as $member)
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
                                <td class="px-6 py-4 text-right">
                                    <a href="{{ route('members.show', $member) }}" class="text-primary hover:text-primary/80 text-sm font-medium">
                                        Lihat Detail →
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endif

        <!-- No Results -->
        @if($sectors->count() == 0 && $members->count() == 0)
        <div class="bg-white border border-slate-200 rounded-xl p-12 text-center">
            <span class="material-icons text-6xl text-slate-300 mb-4">search_off</span>
            <h3 class="text-lg font-semibold text-slate-900 mb-2">Tidak Ada Hasil</h3>
            <p class="text-sm text-slate-500">Tidak ditemukan hasil untuk pencarian "{{ $query }}"</p>
            <a href="{{ route('dashboard') }}" class="inline-block mt-4 px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary/90 transition-colors">
                Kembali ke Dashboard
            </a>
        </div>
        @endif
    </div>
</main>

</body>
</html>
