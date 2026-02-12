<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Detail Anggota - Absensi Damkar Merangin Jakarta</title>
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
            <div class="flex items-center gap-2 text-sm text-slate-500 mb-2">
                <a href="{{ route('members.index') }}" class="hover:text-primary">Kelola Anggota</a>
                <span class="material-icons text-xs">chevron_right</span>
                <span>Detail Anggota</span>
            </div>
            <div class="flex items-center justify-between">
                <h1 class="text-2xl font-bold text-slate-900">Detail Anggota</h1>
                <div class="flex items-center gap-2">
                    <a href="{{ route('members.edit', $member) }}" class="flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                        <span class="material-icons text-sm">edit</span>
                        Edit
                    </a>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Profile Card -->
            <div class="lg:col-span-1">
                <div class="bg-white border border-slate-200 rounded-xl p-6">
                    <div class="text-center mb-6">
                        <div class="w-24 h-24 mx-auto rounded-full bg-primary/10 text-primary flex items-center justify-center font-bold text-3xl mb-4">
                            {{ substr($member->name, 0, 2) }}
                        </div>
                        <h2 class="text-xl font-bold text-slate-900 mb-1">{{ $member->name }}</h2>
                        <p class="text-sm text-slate-500">{{ $member->pangkat }}</p>
                        <div class="mt-4">
                            @if($member->is_active)
                            <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-bold rounded-full">Aktif</span>
                            @else
                            <span class="px-3 py-1 bg-slate-100 text-slate-700 text-xs font-bold rounded-full">Nonaktif</span>
                            @endif
                        </div>
                    </div>

                    <div class="space-y-4 border-t border-slate-200 pt-6">
                        <div>
                            <p class="text-xs text-slate-500 mb-1">NIP</p>
                            <p class="font-medium">{{ $member->nip }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-slate-500 mb-1">NRP</p>
                            <p class="font-medium">{{ $member->nrp }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-slate-500 mb-1">Jabatan</p>
                            <p class="font-medium">{{ $member->jabatan }}</p>
                        </div>
                        @if($member->phone)
                        <div>
                            <p class="text-xs text-slate-500 mb-1">No. Telepon</p>
                            <p class="font-medium">{{ $member->phone }}</p>
                        </div>
                        @endif
                        @if($member->email)
                        <div>
                            <p class="text-xs text-slate-500 mb-1">Email</p>
                            <p class="font-medium">{{ $member->email }}</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Details & Attendance -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Penempatan -->
                <div class="bg-white border border-slate-200 rounded-xl p-6">
                    <h3 class="font-bold text-lg mb-4">Penempatan</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center flex-shrink-0">
                                <span class="material-icons text-primary">{{ $member->sector->icon }}</span>
                            </div>
                            <div>
                                <p class="text-xs text-slate-500 mb-1">Sektor</p>
                                <p class="font-bold text-lg">{{ $member->sector->name }}</p>
                                <p class="text-sm text-slate-600">{{ $member->sector->location }}</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center flex-shrink-0">
                                <span class="text-primary font-bold text-xl">{{ $member->regu }}</span>
                            </div>
                            <div>
                                <p class="text-xs text-slate-500 mb-1">Regu</p>
                                <p class="font-bold text-lg">Regu {{ $member->regu }}</p>
                                <p class="text-sm text-slate-600">{{ $member->jabatan }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Attendance Statistics -->
                <div class="bg-white border border-slate-200 rounded-xl p-6">
                    <h3 class="font-bold text-lg mb-4">Statistik Kehadiran</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="p-4 bg-green-50 rounded-lg text-center">
                            <p class="text-sm text-slate-600 mb-2">Total Hadir</p>
                            <p class="text-3xl font-bold text-green-600">{{ $member->attendances->where('status', 'hadir')->count() }}</p>
                        </div>
                        <div class="p-4 bg-yellow-50 rounded-lg text-center">
                            <p class="text-sm text-slate-600 mb-2">Izin</p>
                            <p class="text-3xl font-bold text-yellow-600">{{ $member->attendances->where('status', 'izin')->count() }}</p>
                        </div>
                        <div class="p-4 bg-red-50 rounded-lg text-center">
                            <p class="text-sm text-slate-600 mb-2">Sakit</p>
                            <p class="text-3xl font-bold text-red-600">{{ $member->attendances->where('status', 'sakit')->count() }}</p>
                        </div>
                    </div>
                </div>

                <!-- Recent Attendance -->
                <div class="bg-white border border-slate-200 rounded-xl p-6">
                    <h3 class="font-bold text-lg mb-4">Riwayat Absensi Terbaru</h3>
                    @if($member->attendances->isEmpty())
                    <div class="text-center py-8">
                        <span class="material-icons text-4xl text-slate-300 mb-2">event_busy</span>
                        <p class="text-sm text-slate-500">Belum ada riwayat absensi</p>
                    </div>
                    @else
                    <div class="space-y-3">
                        @foreach($member->attendances->take(10) as $attendance)
                        <div class="flex items-center justify-between p-3 bg-slate-50 rounded-lg">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-lg flex items-center justify-center
                                    {{ $attendance->status == 'hadir' ? 'bg-green-100 text-green-600' : '' }}
                                    {{ $attendance->status == 'izin' ? 'bg-yellow-100 text-yellow-600' : '' }}
                                    {{ $attendance->status == 'sakit' ? 'bg-red-100 text-red-600' : '' }}">
                                    <span class="material-icons text-sm">
                                        {{ $attendance->status == 'hadir' ? 'check_circle' : 'cancel' }}
                                    </span>
                                </div>
                                <div>
                                    <p class="font-medium">{{ \Carbon\Carbon::parse($attendance->attendance_date)->format('d M Y') }}</p>
                                    <p class="text-xs text-slate-500">{{ ucfirst($attendance->session) }} - {{ ucfirst($attendance->status) }}</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-medium">{{ $attendance->check_in_time }}</p>
                                @if($attendance->check_out_time)
                                <p class="text-xs text-slate-500">Keluar: {{ $attendance->check_out_time }}</p>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</main>

</body>
</html>
