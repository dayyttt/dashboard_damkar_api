<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Detail Sektor - Absensi Damkar Merangin Jakarta</title>
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
        <div class="max-w-5xl mx-auto">
            <!-- Page Header -->
            <div class="mb-6">
                <a href="{{ route('sectors.index') }}" class="inline-flex items-center gap-2 text-sm text-slate-600 hover:text-primary mb-4">
                    <span class="material-icons text-sm">arrow_back</span>
                    Kembali ke Daftar Sektor
                </a>
                <div class="flex justify-between items-start">
                    <div>
                        <h1 class="text-2xl font-bold text-slate-900">{{ $sector->name }}</h1>
                        <p class="text-sm text-slate-500 mt-1">Detail informasi sektor dan daftar anggota</p>
                    </div>
                    <div class="flex gap-2">
                        <a href="{{ route('sectors.edit', $sector) }}" class="flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm font-medium transition-colors">
                            <span class="material-icons text-sm">edit</span>
                            Edit Sektor
                        </a>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Informasi Sektor -->
                <div class="lg:col-span-1">
                    <div class="bg-white border border-slate-200 rounded-xl p-6">
                        <div class="flex items-center gap-4 mb-6">
                            <div class="w-16 h-16 bg-primary/10 rounded-xl flex items-center justify-center">
                                <span class="material-icons text-primary text-3xl">{{ $sector->icon }}</span>
                            </div>
                            <div>
                                <h2 class="font-bold text-lg">{{ $sector->name }}</h2>
                                <p class="text-sm text-slate-500">{{ $sector->code }}</p>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <div>
                                <p class="text-xs font-medium text-slate-500 mb-1">Lokasi</p>
                                <div class="flex items-center gap-2 text-sm">
                                    <span class="material-icons text-sm text-slate-400">location_on</span>
                                    <span>{{ $sector->location }}</span>
                                </div>
                            </div>

                            @if($sector->address)
                            <div>
                                <p class="text-xs font-medium text-slate-500 mb-1">Alamat Lengkap</p>
                                <p class="text-sm text-slate-700">{{ $sector->address }}</p>
                            </div>
                            @endif

                            @if($sector->phone)
                            <div>
                                <p class="text-xs font-medium text-slate-500 mb-1">Telepon</p>
                                <div class="flex items-center gap-2 text-sm">
                                    <span class="material-icons text-sm text-slate-400">phone</span>
                                    <span>{{ $sector->phone }}</span>
                                </div>
                            </div>
                            @endif

                            <div>
                                <p class="text-xs font-medium text-slate-500 mb-1">Status</p>
                                @if($sector->is_active)
                                    <span class="inline-flex items-center gap-1 px-3 py-1 bg-green-100 text-green-700 text-sm font-medium rounded-lg">
                                        <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                                        Aktif
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-3 py-1 bg-slate-100 text-slate-600 text-sm font-medium rounded-lg">
                                        <span class="w-2 h-2 bg-slate-400 rounded-full"></span>
                                        Nonaktif
                                    </span>
                                @endif
                            </div>

                            <div class="pt-4 border-t border-slate-200">
                                <p class="text-xs font-medium text-slate-500 mb-2">Statistik</p>
                                <div class="space-y-2">
                                    <div class="flex justify-between items-center">
                                        <span class="text-sm text-slate-600">Total Anggota</span>
                                        <span class="text-sm font-bold">{{ $sector->members->count() }}</span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span class="text-sm text-slate-600">Regu A</span>
                                        <span class="text-sm font-bold">{{ $sector->members->where('regu', 'A')->count() }}</span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span class="text-sm text-slate-600">Regu B</span>
                                        <span class="text-sm font-bold">{{ $sector->members->where('regu', 'B')->count() }}</span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span class="text-sm text-slate-600">Regu C</span>
                                        <span class="text-sm font-bold">{{ $sector->members->where('regu', 'C')->count() }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Daftar Anggota -->
                <div class="lg:col-span-2">
                    <div class="bg-white border border-slate-200 rounded-xl overflow-hidden">
                        <div class="p-6 border-b border-slate-200">
                            <h3 class="font-bold text-lg">Daftar Anggota</h3>
                            <p class="text-sm text-slate-500 mt-1">{{ $sector->members->count() }} anggota terdaftar</p>
                        </div>

                        @if($sector->members->isEmpty())
                        <div class="p-12 text-center">
                            <span class="material-icons text-6xl text-slate-300 mb-4">person_off</span>
                            <h3 class="text-lg font-semibold text-slate-900 mb-2">Belum Ada Anggota</h3>
                            <p class="text-sm text-slate-500">Sektor ini belum memiliki anggota terdaftar</p>
                        </div>
                        @else
                        <div class="overflow-x-auto">
                            <table class="w-full text-left text-sm">
                                <thead class="bg-slate-50 text-slate-500 uppercase text-xs font-bold">
                                    <tr>
                                        <th class="px-6 py-3">NIP</th>
                                        <th class="px-6 py-3">Nama</th>
                                        <th class="px-6 py-3">Regu</th>
                                        <th class="px-6 py-3">Jabatan</th>
                                        <th class="px-6 py-3">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-200">
                                    @foreach($sector->members as $member)
                                    <tr class="hover:bg-slate-50 transition-colors">
                                        <td class="px-6 py-4 font-mono text-xs">{{ $member->nip }}</td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-2">
                                                <div class="w-8 h-8 rounded-full bg-primary/10 text-primary flex items-center justify-center font-bold text-xs">
                                                    {{ substr($member->name, 0, 2) }}
                                                </div>
                                                <span class="font-medium">{{ $member->name }}</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="px-2 py-1 bg-slate-100 text-slate-700 text-xs font-bold rounded">
                                                Regu {{ $member->regu }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-sm">{{ $member->jabatan }}</td>
                                        <td class="px-6 py-4">
                                            @if($member->is_active)
                                                <span class="inline-flex items-center gap-1 text-xs text-green-600">
                                                    <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                                                    Aktif
                                                </span>
                                            @else
                                                <span class="inline-flex items-center gap-1 text-xs text-slate-500">
                                                    <span class="w-2 h-2 bg-slate-400 rounded-full"></span>
                                                    Nonaktif
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

</body>
</html>
