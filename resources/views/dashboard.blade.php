<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard Admin - Absensi Damkar Merangin Jakarta</title>
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
                    borderRadius: {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
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

    <!-- Dashboard Content -->
    <div class="flex-1 overflow-y-auto p-8 bg-background-light">
        <!-- Summary Bar -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm relative overflow-hidden group">
                <div class="absolute -right-2 -top-2 opacity-5 text-primary group-hover:scale-110 transition-transform">
                    <span class="material-icons text-8xl">groups</span>
                </div>
                <p class="text-sm font-medium text-slate-500 mb-2">Total Personel</p>
                <div class="flex items-end gap-3">
                    <span class="text-3xl font-bold">{{ $totalMembers }}</span>
                    <span class="text-xs text-emerald-500 font-medium pb-1 flex items-center">
                        <span class="material-icons text-xs">check_circle</span> Aktif
                    </span>
                </div>
            </div>

            <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm relative overflow-hidden group">
                <div class="absolute -right-2 -top-2 opacity-5 text-primary group-hover:scale-110 transition-transform">
                    <span class="material-icons text-8xl">location_on</span>
                </div>
                <p class="text-sm font-medium text-slate-500 mb-2">Total Sektor</p>
                <div class="flex items-end gap-3">
                    <span class="text-3xl font-bold">{{ $totalSectors }}</span>
                    <span class="text-xs text-primary font-medium pb-1">Merangin Jakarta</span>
                </div>
            </div>

            <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm relative overflow-hidden group">
                <div class="absolute -right-2 -top-2 opacity-5 text-primary group-hover:scale-110 transition-transform">
                    <span class="material-icons text-8xl">check_circle</span>
                </div>
                <p class="text-sm font-medium text-slate-500 mb-2">Kehadiran Hari Ini</p>
                <div class="flex items-end gap-3">
                    <span class="text-3xl font-bold">{{ $attendancePercentage }}%</span>
                    <span class="text-xs text-emerald-500 font-medium pb-1 flex items-center">
                        <span class="material-icons text-xs">arrow_upward</span> Baik
                    </span>
                </div>
            </div>

            <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm relative overflow-hidden group">
                <div class="absolute -right-2 -top-2 opacity-5 text-primary group-hover:scale-110 transition-transform">
                    <span class="material-icons text-8xl">assignment_turned_in</span>
                </div>
                <p class="text-sm font-medium text-slate-500 mb-2">Absensi Hari Ini</p>
                <div class="flex items-end gap-3">
                    <span class="text-3xl font-bold">{{ $todayAttendances }}</span>
                    <span class="text-xs text-primary font-medium pb-1">Check-in</span>
                </div>
            </div>
        </div>

        <!-- Main Layout: Grid and Table -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <!-- Sectors Overview (Grid) -->
            <div class="lg:col-span-5 space-y-4">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-bold">Monitoring Sektor</h2>
                    <a class="text-xs text-primary hover:underline font-medium" href="#">Lihat semua</a>
                </div>
                
                <div class="grid grid-cols-1 gap-4">
                    @foreach($sectors as $sector)
                    <div class="bg-white border border-slate-200 rounded-xl p-5 hover:border-primary/50 transition-colors cursor-pointer group">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="font-bold text-slate-900">{{ $sector->name }}</h3>
                                <p class="text-xs text-slate-500">{{ $sector->location }}</p>
                            </div>
                            @if($sector->percentage >= 90)
                                <span class="px-2 py-1 bg-emerald-500/10 text-emerald-500 text-[10px] font-bold rounded uppercase tracking-wider border border-emerald-500/20">Optimal</span>
                            @elseif($sector->percentage >= 75)
                                <span class="px-2 py-1 bg-blue-500/10 text-blue-500 text-[10px] font-bold rounded uppercase tracking-wider border border-blue-500/20">Baik</span>
                            @else
                                <span class="px-2 py-1 bg-amber-500/10 text-amber-500 text-[10px] font-bold rounded uppercase tracking-wider border border-amber-500/20">Perhatian</span>
                            @endif
                        </div>
                        
                        <div class="flex items-center gap-4 mb-4">
                            <div class="w-10 h-10 rounded bg-primary/10 flex items-center justify-center">
                                <span class="material-icons text-primary">{{ $sector->icon }}</span>
                            </div>
                            <div class="flex-1">
                                <div class="flex justify-between text-[10px] mb-1">
                                    <span class="text-slate-500 uppercase tracking-tighter font-semibold">Tingkat Kehadiran</span>
                                    <span class="font-bold">{{ $sector->percentage }}%</span>
                                </div>
                                <div class="w-full bg-slate-100 h-1.5 rounded-full overflow-hidden">
                                    <div class="bg-primary h-full rounded-full" style="width: {{ $sector->percentage }}%"></div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex items-center justify-between text-xs text-slate-500">
                            <span class="flex items-center gap-1">
                                <span class="material-icons text-xs">groups</span> 
                                3 Regu
                            </span>
                            <span class="flex items-center gap-1">
                                <span class="material-icons text-xs">person</span> 
                                {{ $sector->present_today }}/{{ $sector->total_members }} Hadir
                            </span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Recent Activity Table -->
            <div class="lg:col-span-7">
                <div class="bg-white border border-slate-200 rounded-xl overflow-hidden shadow-sm flex flex-col h-full">
                    <div class="p-6 border-b border-slate-200 flex items-center justify-between">
                        <div>
                            <h2 class="text-lg font-bold">Aktivitas Absensi Terbaru</h2>
                            <p class="text-xs text-slate-500 mt-1">Update real-time absensi dari seluruh sektor</p>
                        </div>
                        <div class="flex gap-2">
                            <button class="p-2 hover:bg-slate-100 rounded-lg text-slate-500 transition-colors">
                                <span class="material-icons text-xl">filter_list</span>
                            </button>
                            <button class="p-2 hover:bg-slate-100 rounded-lg text-slate-500 transition-colors">
                                <span class="material-icons text-xl">refresh</span>
                            </button>
                        </div>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm">
                            <thead class="bg-slate-50 text-slate-500 uppercase text-[10px] font-bold tracking-widest">
                                <tr>
                                    <th class="px-6 py-4">Nama Anggota</th>
                                    <th class="px-6 py-4">Sektor / Regu</th>
                                    <th class="px-6 py-4">Sesi</th>
                                    <th class="px-6 py-4">Waktu</th>
                                    <th class="px-6 py-4">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-200">
                                @forelse($recentAttendances as $attendance)
                                <tr class="hover:bg-slate-50 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-2">
                                            <div class="w-8 h-8 rounded-full bg-primary/10 text-primary flex items-center justify-center font-bold text-xs">
                                                {{ substr($attendance->member->name, 0, 2) }}
                                            </div>
                                            <span class="font-semibold">{{ $attendance->member->name }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center px-2 py-0.5 rounded bg-slate-100 text-xs font-medium border border-slate-200">
                                            {{ $attendance->member->sector->name }} - Regu {{ $attendance->member->regu }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="text-xs font-medium">{{ $attendance->session }}</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="text-xs text-slate-500">{{ $attendance->check_in_time->format('H:i') }}</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-2">
                                            @if($attendance->status === 'Hadir')
                                                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                                                <span class="text-xs text-emerald-600 font-medium">Hadir</span>
                                            @elseif($attendance->status === 'Terlambat')
                                                <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                                                <span class="text-xs text-amber-600 font-medium">Terlambat</span>
                                            @else
                                                <span class="w-2 h-2 rounded-full bg-slate-400"></span>
                                                <span class="text-xs text-slate-600 font-medium">{{ $attendance->status }}</span>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center">
                                            <span class="material-icons text-6xl text-slate-300 mb-2">assignment</span>
                                            <p class="text-sm text-slate-500">Belum ada aktivitas absensi hari ini</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    @if($recentAttendances->count() > 0)
                    <div class="p-4 border-t border-slate-200 flex items-center justify-between mt-auto">
                        <span class="text-xs text-slate-500 font-medium">Menampilkan {{ $recentAttendances->count() }} aktivitas terbaru</span>
                        <a href="#" class="text-xs text-primary hover:underline font-medium">Lihat semua →</a>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Statistik Per Regu -->
        <div class="mt-8 bg-white border border-slate-200 rounded-xl p-6">
            <h3 class="text-lg font-bold mb-4">Statistik Per Regu</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach(['A', 'B', 'C'] as $regu)
                <div class="border border-slate-200 rounded-lg p-5">
                    <div class="flex items-center justify-between mb-3">
                        <div class="flex items-center gap-2">
                            <div class="w-10 h-10 bg-primary/10 rounded-lg flex items-center justify-center">
                                <span class="text-primary font-bold text-lg">{{ $regu }}</span>
                            </div>
                            <span class="text-sm font-bold text-slate-900">Regu {{ $regu }}</span>
                        </div>
                        <span class="text-2xl font-bold text-primary">{{ $reguStats[$regu]['percentage'] }}%</span>
                    </div>
                    <div class="w-full bg-slate-100 rounded-full h-2 mb-3">
                        <div class="bg-primary h-2 rounded-full transition-all" style="width: {{ $reguStats[$regu]['percentage'] }}%"></div>
                    </div>
                    <div class="flex items-center justify-between text-xs text-slate-500">
                        <span>{{ $reguStats[$regu]['present'] }} Hadir</span>
                        <span>{{ $reguStats[$regu]['total'] }} Total</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</main>

</body>
</html>
