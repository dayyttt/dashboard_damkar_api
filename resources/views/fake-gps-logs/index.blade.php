<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Log Fake GPS - Absensi Damkar DKI Jakarta</title>
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
                <h1 class="text-2xl font-bold text-slate-900">Log Fake GPS Detection</h1>
                <p class="text-sm text-slate-500 mt-1">Monitoring percobaan penggunaan fake GPS oleh anggota</p>
            </div>
            @if($unreadCount > 0)
            <form action="{{ route('fake-gps-logs.mark-all-read') }}" method="POST">
                @csrf
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                    <span class="flex items-center gap-2">
                        <span class="material-icons text-sm">done_all</span>
                        Tandai Semua Dibaca
                    </span>
                </button>
            </form>
            @endif
        </div>

        @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-800 rounded-lg flex items-center gap-3">
            <span class="material-icons">check_circle</span>
            <span>{{ session('success') }}</span>
        </div>
        @endif

        <!-- Alert Card -->
        @if($unreadCount > 0)
        <div class="mb-6 p-6 bg-red-50 border-2 border-red-200 rounded-xl">
            <div class="flex items-start gap-4">
                <div class="flex-shrink-0">
                    <span class="material-icons text-red-600 text-4xl">warning</span>
                </div>
                <div class="flex-1">
                    <h3 class="text-lg font-bold text-red-900 mb-2">Peringatan Keamanan!</h3>
                    <p class="text-red-700 mb-3">
                        Terdapat <strong>{{ $unreadCount }}</strong> percobaan penggunaan fake GPS yang belum ditindaklanjuti.
                        Segera lakukan verifikasi dan tindakan yang diperlukan.
                    </p>
                    <div class="flex items-center gap-2 text-sm text-red-600">
                        <span class="material-icons text-sm">info</span>
                        <span>Fake GPS dapat digunakan untuk manipulasi lokasi absensi</span>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Filters -->
        <div class="bg-white border border-slate-200 rounded-xl p-6 mb-6">
            <form method="GET" action="{{ route('fake-gps-logs.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Tanggal Mulai</label>
                    <input type="date" name="start_date" value="{{ request('start_date') }}" class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Tanggal Akhir</label>
                    <input type="date" name="end_date" value="{{ request('end_date') }}" class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Status</label>
                    <select name="is_read" class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                        <option value="">Semua</option>
                        <option value="0" {{ request('is_read') === '0' ? 'selected' : '' }}>Belum Dibaca</option>
                        <option value="1" {{ request('is_read') === '1' ? 'selected' : '' }}>Sudah Dibaca</option>
                    </select>
                </div>
                <div class="flex items-end gap-2">
                    <button type="submit" class="flex-1 px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary/90 transition-colors">
                        Filter
                    </button>
                    <a href="{{ route('fake-gps-logs.index') }}" class="px-4 py-2 bg-slate-200 text-slate-700 rounded-lg hover:bg-slate-300 transition-colors">
                        Reset
                    </a>
                </div>
            </form>
        </div>

        <!-- Table -->
        <div class="bg-white border border-slate-200 rounded-xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-slate-50 border-b border-slate-200">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Waktu Terdeteksi</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Nama Anggota</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Sektor</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Device Info</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200">
                        @forelse($logs as $log)
                        <tr class="hover:bg-slate-50 {{ !$log->is_read ? 'bg-red-50' : '' }}">
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($log->is_read)
                                <span class="px-2 py-1 bg-slate-100 text-slate-700 text-xs font-semibold rounded-full flex items-center gap-1 w-fit">
                                    <span class="material-icons text-xs">check</span>
                                    Dibaca
                                </span>
                                @else
                                <span class="px-2 py-1 bg-red-100 text-red-700 text-xs font-semibold rounded-full flex items-center gap-1 w-fit">
                                    <span class="material-icons text-xs">priority_high</span>
                                    Baru
                                </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-slate-900">
                                    {{ \Carbon\Carbon::parse($log->detected_at)->format('d M Y') }}
                                </div>
                                <div class="text-xs text-slate-500">
                                    {{ \Carbon\Carbon::parse($log->detected_at)->format('H:i:s') }} WIB
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center">
                                        <span class="material-icons text-red-600">person</span>
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-slate-900">{{ $log->member->name }}</div>
                                        <div class="text-xs text-slate-500">{{ $log->member->nip }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">
                                {{ $log->member->sector->name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">
                                <div>{{ $log->device_info ?? '-' }}</div>
                                <div class="text-xs text-slate-400">v{{ $log->app_version ?? '-' }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex items-center gap-2">
                                    @if(!$log->is_read)
                                    <form action="{{ route('fake-gps-logs.mark-read', $log->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="text-blue-600 hover:text-blue-900" title="Tandai Dibaca">
                                            <span class="material-icons text-sm">done</span>
                                        </button>
                                    </form>
                                    @endif
                                    <form action="{{ route('fake-gps-logs.destroy', $log->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus log ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900" title="Hapus">
                                            <span class="material-icons text-sm">delete</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-slate-500">
                                <span class="material-icons text-4xl mb-2">security</span>
                                <p>Tidak ada log fake GPS detection</p>
                                <p class="text-xs mt-2">Sistem akan mencatat jika ada anggota yang mencoba menggunakan fake GPS</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $logs->appends(request()->all())->links() }}
        </div>
    </div>
</main>

</body>
</html>
