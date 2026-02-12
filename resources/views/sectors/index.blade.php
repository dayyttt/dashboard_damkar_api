<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Kelola Sektor - Absensi Damkar Merangin Jakarta</title>
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

<!-- Main Content Area -->
<main class="flex-1 flex flex-col overflow-hidden">
    @include('layouts.header')

    <!-- Content -->
    <div class="flex-1 overflow-y-auto p-8 bg-background-light">
        <!-- Page Header -->
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-2xl font-bold text-slate-900">Kelola Sektor</h1>
                <p class="text-sm text-slate-500 mt-1">Manajemen data sektor Damkar Merangin Jakarta</p>
            </div>
            <a href="{{ route('sectors.create') }}" class="flex items-center gap-2 px-4 py-2 bg-primary hover:bg-primary/90 text-white rounded-lg text-sm font-medium transition-colors">
                <span class="material-icons text-sm">add</span>
                Tambah Sektor
            </a>
        </div>

        <!-- Success Message -->
        @if(session('success'))
        <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg flex items-center gap-2">
            <span class="material-icons text-green-600">check_circle</span>
            <span>{{ session('success') }}</span>
        </div>
        @endif

        <!-- Sectors Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($sectors as $sector)
            <div class="bg-white border border-slate-200 rounded-xl p-6 hover:border-primary/50 transition-colors">
                <div class="flex justify-between items-start mb-4">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center">
                            <span class="material-icons text-primary text-xl">{{ $sector->icon }}</span>
                        </div>
                        <div>
                            <h3 class="font-bold text-slate-900">{{ $sector->name }}</h3>
                            <p class="text-xs text-slate-500">{{ $sector->code }}</p>
                        </div>
                    </div>
                    @if($sector->is_active)
                        <span class="px-2 py-1 bg-green-100 text-green-700 text-xs font-bold rounded">Aktif</span>
                    @else
                        <span class="px-2 py-1 bg-slate-100 text-slate-600 text-xs font-bold rounded">Nonaktif</span>
                    @endif
                </div>

                <div class="space-y-2 mb-4">
                    <div class="flex items-center gap-2 text-sm text-slate-600">
                        <span class="material-icons text-sm">location_on</span>
                        <span>{{ $sector->location }}</span>
                    </div>
                    @if($sector->phone)
                    <div class="flex items-center gap-2 text-sm text-slate-600">
                        <span class="material-icons text-sm">phone</span>
                        <span>{{ $sector->phone }}</span>
                    </div>
                    @endif
                    <div class="flex items-center gap-2 text-sm text-slate-600">
                        <span class="material-icons text-sm">groups</span>
                        <span>{{ $sector->members_count }} Anggota</span>
                    </div>
                </div>

                @if($sector->address)
                <p class="text-xs text-slate-500 mb-4 line-clamp-2">{{ $sector->address }}</p>
                @endif

                <div class="flex gap-2 pt-4 border-t border-slate-200">
                    <a href="{{ route('sectors.show', $sector) }}" class="flex-1 flex items-center justify-center gap-1 px-3 py-2 bg-slate-100 hover:bg-slate-200 rounded-lg text-sm font-medium transition-colors">
                        <span class="material-icons text-sm">visibility</span>
                        Detail
                    </a>
                    <a href="{{ route('sectors.edit', $sector) }}" class="flex-1 flex items-center justify-center gap-1 px-3 py-2 bg-blue-100 hover:bg-blue-200 text-blue-700 rounded-lg text-sm font-medium transition-colors">
                        <span class="material-icons text-sm">edit</span>
                        Edit
                    </a>
                    <form action="{{ route('sectors.destroy', $sector) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus sektor ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="flex items-center justify-center gap-1 px-3 py-2 bg-red-100 hover:bg-red-200 text-red-700 rounded-lg text-sm font-medium transition-colors">
                            <span class="material-icons text-sm">delete</span>
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>

        @if($sectors->isEmpty())
        <div class="bg-white border border-slate-200 rounded-xl p-12 text-center">
            <span class="material-icons text-6xl text-slate-300 mb-4">location_off</span>
            <h3 class="text-lg font-semibold text-slate-900 mb-2">Belum Ada Sektor</h3>
            <p class="text-sm text-slate-500 mb-4">Mulai dengan menambahkan sektor baru</p>
            <a href="{{ route('sectors.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-primary hover:bg-primary/90 text-white rounded-lg text-sm font-medium transition-colors">
                <span class="material-icons text-sm">add</span>
                Tambah Sektor
            </a>
        </div>
        @endif
    </div>
</main>

</body>
</html>
