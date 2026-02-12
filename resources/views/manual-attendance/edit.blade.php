<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Edit Absensi - Absensi Damkar Merangin Jakarta</title>
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
            <div class="flex items-center gap-3 mb-2">
                <a href="{{ route('manual-attendance.index') }}" class="text-slate-500 hover:text-slate-700">
                    <span class="material-icons">arrow_back</span>
                </a>
                <h1 class="text-2xl font-bold text-slate-900">Edit Absensi</h1>
            </div>
            <p class="text-sm text-slate-500">Update data absensi</p>
        </div>

        @if(session('error'))
        <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-800 rounded-lg flex items-center gap-3">
            <span class="material-icons">error</span>
            <span>{{ session('error') }}</span>
        </div>
        @endif

        <!-- Form -->
        <form method="POST" action="{{ route('manual-attendance.update', $attendance->id) }}" class="max-w-3xl">
            @csrf
            @method('PUT')
            
            <div class="bg-white border border-slate-200 rounded-xl p-6 mb-6">
                <h3 class="font-bold text-lg mb-4">Informasi Absensi</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Member (Read Only) -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Anggota
                        </label>
                        <input type="text" value="{{ $attendance->member->name }} - {{ $attendance->member->sector->name }}" readonly class="w-full px-3 py-2 border border-slate-300 rounded-lg bg-slate-50 text-slate-600">
                    </div>

                    <!-- Date (Read Only) -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Tanggal
                        </label>
                        <input type="text" value="{{ \Carbon\Carbon::parse($attendance->attendance_date)->format('d/m/Y') }}" readonly class="w-full px-3 py-2 border border-slate-300 rounded-lg bg-slate-50 text-slate-600">
                    </div>

                    <!-- Session (Read Only) -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Sesi
                        </label>
                        <input type="text" value="{{ $attendance->session }}" readonly class="w-full px-3 py-2 border border-slate-300 rounded-lg bg-slate-50 text-slate-600">
                    </div>

                    <!-- Time -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Waktu <span class="text-red-500">*</span>
                        </label>
                        <input type="time" name="check_in_time" value="{{ old('check_in_time', $attendance->check_in_time) }}" required class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('check_in_time') border-red-500 @enderror">
                        @error('check_in_time')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Status <span class="text-red-500">*</span>
                        </label>
                        <select name="status" required class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('status') border-red-500 @enderror">
                            <option value="">Pilih Status</option>
                            <option value="Hadir" {{ old('status', $attendance->status) == 'Hadir' ? 'selected' : '' }}>Hadir</option>
                            <option value="Terlambat" {{ old('status', $attendance->status) == 'Terlambat' ? 'selected' : '' }}>Terlambat</option>
                            <option value="Izin" {{ old('status', $attendance->status) == 'Izin' ? 'selected' : '' }}>Izin</option>
                            <option value="Sakit" {{ old('status', $attendance->status) == 'Sakit' ? 'selected' : '' }}>Sakit</option>
                            <option value="Alpha" {{ old('status', $attendance->status) == 'Alpha' ? 'selected' : '' }}>Alpha</option>
                            <option value="Cepat Pulang" {{ old('status', $attendance->status) == 'Cepat Pulang' ? 'selected' : '' }}>Cepat Pulang</option>
                            <option value="Tanpa Keterangan" {{ old('status', $attendance->status) == 'Tanpa Keterangan' ? 'selected' : '' }}>Tanpa Keterangan</option>
                        </select>
                        @error('status')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Notes -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Catatan
                        </label>
                        <textarea name="notes" rows="3" class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('notes') border-red-500 @enderror" placeholder="Tambahkan catatan jika diperlukan">{{ old('notes', $attendance->notes) }}</textarea>
                        @error('notes')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex items-center gap-3">
                <button type="submit" class="flex items-center gap-2 px-6 py-2 bg-primary text-white rounded-lg hover:bg-primary/90 transition-colors">
                    <span class="material-icons text-sm">save</span>
                    Update
                </button>
                <a href="{{ route('manual-attendance.index') }}" class="px-6 py-2 bg-slate-200 text-slate-700 rounded-lg hover:bg-slate-300 transition-colors">
                    Batal
                </a>
            </div>
        </form>
    </div>
</main>

</body>
</html>
