<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laporan Absensi - Absensi Damkar Merangin Jakarta</title>
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
                <h1 class="text-2xl font-bold text-slate-900">Laporan Absensi</h1>
                <p class="text-sm text-slate-500 mt-1">Monitoring dan export data kehadiran personel</p>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
            <div class="bg-white border border-slate-200 rounded-xl p-6">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-sm text-slate-500">Total Absensi</span>
                    <span class="material-icons text-slate-400">assignment</span>
                </div>
                <p class="text-3xl font-bold text-slate-900">{{ $totalAttendances }}</p>
            </div>
            <div class="bg-white border border-slate-200 rounded-xl p-6">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-sm text-slate-500">Hadir</span>
                    <span class="material-icons text-green-500">check_circle</span>
                </div>
                <p class="text-3xl font-bold text-green-600">{{ $totalHadir }}</p>
                <p class="text-xs text-slate-500 mt-1">{{ $totalAttendances > 0 ? number_format(($totalHadir / $totalAttendances) * 100, 1) : 0 }}%</p>
            </div>
            <div class="bg-white border border-slate-200 rounded-xl p-6">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-sm text-slate-500">Izin</span>
                    <span class="material-icons text-yellow-500">event_busy</span>
                </div>
                <p class="text-3xl font-bold text-yellow-600">{{ $totalIzin }}</p>
                <p class="text-xs text-slate-500 mt-1">{{ $totalAttendances > 0 ? number_format(($totalIzin / $totalAttendances) * 100, 1) : 0 }}%</p>
            </div>
            <div class="bg-white border border-slate-200 rounded-xl p-6">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-sm text-slate-500">Sakit</span>
                    <span class="material-icons text-red-500">local_hospital</span>
                </div>
                <p class="text-3xl font-bold text-red-600">{{ $totalSakit }}</p>
                <p class="text-xs text-slate-500 mt-1">{{ $totalAttendances > 0 ? number_format(($totalSakit / $totalAttendances) * 100, 1) : 0 }}%</p>
            </div>
        </div>

        <!-- Filters -->
        <div class="bg-white border border-slate-200 rounded-xl p-6 mb-6">
            <form method="GET" action="{{ route('reports.index') }}" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-6 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Tanggal Mulai</label>
                        <input type="date" name="start_date" value="{{ $startDate }}" class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Tanggal Akhir</label>
                        <input type="date" name="end_date" value="{{ $endDate }}" class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Sektor</label>
                        <select name="sector_id" class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                            <option value="">Semua</option>
                            @foreach($sectors as $sector)
                            <option value="{{ $sector->id }}" {{ request('sector_id') == $sector->id ? 'selected' : '' }}>{{ $sector->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Regu</label>
                        <select name="regu" class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                            <option value="">Semua</option>
                            <option value="A" {{ request('regu') == 'A' ? 'selected' : '' }}>Regu A</option>
                            <option value="B" {{ request('regu') == 'B' ? 'selected' : '' }}>Regu B</option>
                            <option value="C" {{ request('regu') == 'C' ? 'selected' : '' }}>Regu C</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Sesi</label>
                        <select name="session" class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                            <option value="">Semua</option>
                            <option value="pagi" {{ request('session') == 'pagi' ? 'selected' : '' }}>Pagi</option>
                            <option value="malam" {{ request('session') == 'malam' ? 'selected' : '' }}>Malam</option>
                            <option value="checkout" {{ request('session') == 'checkout' ? 'selected' : '' }}>Checkout</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Status</label>
                        <select name="status" class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                            <option value="">Semua</option>
                            <option value="hadir" {{ request('status') == 'hadir' ? 'selected' : '' }}>Hadir</option>
                            <option value="izin" {{ request('status') == 'izin' ? 'selected' : '' }}>Izin</option>
                            <option value="sakit" {{ request('status') == 'sakit' ? 'selected' : '' }}>Sakit</option>
                        </select>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <button type="submit" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary/90 transition-colors">
                        <span class="flex items-center gap-2">
                            <span class="material-icons text-sm">filter_list</span>
                            Filter
                        </span>
                    </button>
                    <a href="{{ route('reports.index') }}" class="px-4 py-2 border border-slate-300 text-slate-700 rounded-lg hover:bg-slate-50 transition-colors">
                        Reset
                    </a>
                    <div class="flex-1"></div>
                    <a href="{{ route('reports.export', request()->all()) }}" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                        <span class="flex items-center gap-2">
                            <span class="material-icons text-sm">download</span>
                            Export CSV
                        </span>
                    </a>
                </div>
            </form>
        </div>

        <!-- Attendance Table -->
        <div class="bg-white border border-slate-200 rounded-xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-slate-50 border-b border-slate-200">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-bold text-slate-700 uppercase tracking-wider">Tanggal</th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-slate-700 uppercase tracking-wider">Sesi</th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-slate-700 uppercase tracking-wider">Nama</th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-slate-700 uppercase tracking-wider">Sektor</th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-slate-700 uppercase tracking-wider">Regu</th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-slate-700 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-slate-700 uppercase tracking-wider">Jam Masuk</th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-slate-700 uppercase tracking-wider">Jam Keluar</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200">
                        @forelse($attendances as $attendance)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4 text-sm text-slate-900">
                                {{ \Carbon\Carbon::parse($attendance->attendance_date)->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 bg-slate-100 text-slate-700 text-xs font-bold rounded">
                                    {{ ucfirst($attendance->session) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div>
                                    <p class="font-medium text-slate-900">{{ $attendance->member->name }}</p>
                                    <p class="text-xs text-slate-500">{{ $attendance->member->pangkat }}</p>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-sm font-medium text-slate-900">{{ $attendance->member->sector->name }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 bg-primary/10 text-primary text-xs font-bold rounded">
                                    Regu {{ $attendance->member->regu }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                @php
                                    $statusConfig = [
                                        'Hadir' => ['bg' => 'bg-green-100', 'text' => 'text-green-700', 'icon' => 'check_circle'],
                                        'Terlambat' => ['bg' => 'bg-yellow-100', 'text' => 'text-yellow-700', 'icon' => 'schedule'],
                                        'Izin' => ['bg' => 'bg-blue-100', 'text' => 'text-blue-700', 'icon' => 'event_busy'],
                                        'Sakit' => ['bg' => 'bg-purple-100', 'text' => 'text-purple-700', 'icon' => 'local_hospital'],
                                        'Alpha' => ['bg' => 'bg-red-100', 'text' => 'text-red-700', 'icon' => 'cancel'],
                                        'Cepat Pulang' => ['bg' => 'bg-orange-100', 'text' => 'text-orange-700', 'icon' => 'logout'],
                                        'Tanpa Keterangan' => ['bg' => 'bg-gray-100', 'text' => 'text-gray-700', 'icon' => 'help'],
                                    ];
                                    $config = $statusConfig[$attendance->status] ?? ['bg' => 'bg-gray-100', 'text' => 'text-gray-700', 'icon' => 'info'];
                                @endphp
                                <span class="px-2 py-1 {{ $config['bg'] }} {{ $config['text'] }} text-xs font-bold rounded flex items-center gap-1 w-fit">
                                    <span class="material-icons text-xs">{{ $config['icon'] }}</span>
                                    {{ $attendance->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-600">{{ $attendance->check_in_time ?? '-' }}</td>
                            <td class="px-6 py-4 text-sm text-slate-600">
                                @if($attendance->session == 'Pulang')
                                    {{ $attendance->check_in_time ?? '-' }}
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="px-6 py-12 text-center">
                                <span class="material-icons text-6xl text-slate-300 mb-4">event_busy</span>
                                <p class="text-slate-500">Tidak ada data absensi</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if($attendances->hasPages())
            <div class="px-6 py-4 border-t border-slate-200">
                {{ $attendances->appends(request()->all())->links() }}
            </div>
            @endif
        </div>
    </div>
</main>

</body>
</html>
