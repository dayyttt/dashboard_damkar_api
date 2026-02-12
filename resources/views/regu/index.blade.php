<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Kelola Regu - Absensi Damkar Merangin Jakarta</title>
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
            <h1 class="text-2xl font-bold text-slate-900">Kelola Regu</h1>
            <p class="text-sm text-slate-500 mt-1">Manajemen anggota per regu (A, B, C) di setiap sektor</p>
        </div>

        <!-- Sector Selector -->
        <div class="bg-white border border-slate-200 rounded-xl p-6 mb-6">
            <label class="block text-sm font-medium text-slate-700 mb-3">Pilih Sektor</label>
            <div class="flex flex-wrap gap-3">
                @foreach($sectors as $sector)
                <a href="{{ route('regu.index', ['sector_id' => $sector->id]) }}" 
                   class="flex items-center gap-2 px-4 py-2 rounded-lg border-2 transition-all {{ $selectedSector && $selectedSector->id == $sector->id ? 'border-primary bg-primary/10 text-primary' : 'border-slate-200 hover:border-primary/50' }}">
                    <span class="material-icons text-sm">{{ $sector->icon }}</span>
                    <span class="font-medium">{{ $sector->name }}</span>
                </a>
                @endforeach
            </div>
        </div>

        @if($selectedSector)
        <!-- Regu Cards -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            @foreach(['A', 'B', 'C'] as $regu)
            <div class="bg-white border border-slate-200 rounded-xl overflow-hidden">
                <!-- Header -->
                <div class="p-6 border-b border-slate-200 bg-gradient-to-br from-primary/5 to-primary/10">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 bg-primary rounded-xl flex items-center justify-center">
                                <span class="text-white font-bold text-xl">{{ $regu }}</span>
                            </div>
                            <div>
                                <h3 class="font-bold text-lg">Regu {{ $regu }}</h3>
                                <p class="text-sm text-slate-500">{{ $selectedSector->name }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs text-slate-500 mb-1">Total Anggota</p>
                            <p class="text-2xl font-bold text-primary">{{ $reguData[$regu]['total'] }}</p>
                        </div>
                        @if($reguData[$regu]['komandan'])
                        <div class="text-right">
                            <p class="text-xs text-slate-500 mb-1">Komandan Regu</p>
                            <p class="text-sm font-semibold">{{ $reguData[$regu]['komandan']->name }}</p>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Members List -->
                <div class="p-4">
                    @if($reguData[$regu]['members']->isEmpty())
                    <div class="text-center py-8">
                        <span class="material-icons text-4xl text-slate-300 mb-2">person_off</span>
                        <p class="text-sm text-slate-500">Belum ada anggota</p>
                    </div>
                    @else
                    <div class="space-y-2 max-h-96 overflow-y-auto">
                        @foreach($reguData[$regu]['members'] as $member)
                        <div class="flex items-center gap-3 p-3 rounded-lg hover:bg-slate-50 transition-colors">
                            <div class="w-10 h-10 rounded-full bg-primary/10 text-primary flex items-center justify-center font-bold text-sm flex-shrink-0">
                                {{ substr($member->name, 0, 2) }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="font-medium text-sm truncate">{{ $member->name }}</p>
                                <p class="text-xs text-slate-500">{{ $member->jabatan }}</p>
                            </div>
                            @if($member->jabatan == 'Komandan Regu')
                            <span class="px-2 py-1 bg-amber-100 text-amber-700 text-xs font-bold rounded flex-shrink-0">
                                Komandan
                            </span>
                            @endif
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>

                <!-- Footer Stats -->
                <div class="p-4 border-t border-slate-200 bg-slate-50">
                    <div class="grid grid-cols-3 gap-4 text-center">
                        <div>
                            <p class="text-xs text-slate-500 mb-1">Komandan</p>
                            <p class="text-sm font-bold">{{ $reguData[$regu]['members']->where('jabatan', 'Komandan Regu')->count() }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-slate-500 mb-1">Anggota</p>
                            <p class="text-sm font-bold">{{ $reguData[$regu]['members']->where('jabatan', 'Anggota')->count() }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-slate-500 mb-1">Total</p>
                            <p class="text-sm font-bold text-primary">{{ $reguData[$regu]['total'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Summary -->
        <div class="mt-6 bg-white border border-slate-200 rounded-xl p-6">
            <h3 class="font-bold text-lg mb-4">Ringkasan {{ $selectedSector->name }}</h3>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class="text-center p-4 bg-slate-50 rounded-lg">
                    <p class="text-sm text-slate-500 mb-2">Total Personel</p>
                    <p class="text-3xl font-bold text-slate-900">
                        {{ $reguData['A']['total'] + $reguData['B']['total'] + $reguData['C']['total'] }}
                    </p>
                </div>
                <div class="text-center p-4 bg-red-50 rounded-lg">
                    <p class="text-sm text-slate-500 mb-2">Regu A</p>
                    <p class="text-3xl font-bold text-primary">{{ $reguData['A']['total'] }}</p>
                </div>
                <div class="text-center p-4 bg-blue-50 rounded-lg">
                    <p class="text-sm text-slate-500 mb-2">Regu B</p>
                    <p class="text-3xl font-bold text-blue-600">{{ $reguData['B']['total'] }}</p>
                </div>
                <div class="text-center p-4 bg-green-50 rounded-lg">
                    <p class="text-sm text-slate-500 mb-2">Regu C</p>
                    <p class="text-3xl font-bold text-green-600">{{ $reguData['C']['total'] }}</p>
                </div>
            </div>
        </div>
        @else
        <div class="bg-white border border-slate-200 rounded-xl p-12 text-center">
            <span class="material-icons text-6xl text-slate-300 mb-4">groups_off</span>
            <h3 class="text-lg font-semibold text-slate-900 mb-2">Pilih Sektor</h3>
            <p class="text-sm text-slate-500">Pilih sektor di atas untuk melihat data regu</p>
        </div>
        @endif
    </div>
</main>

</body>
</html>
