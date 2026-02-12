<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Edit Sektor - Absensi Damkar Merangin Jakarta</title>
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
        <div class="max-w-3xl mx-auto">
            <!-- Page Header -->
            <div class="mb-6">
                <a href="{{ route('sectors.index') }}" class="inline-flex items-center gap-2 text-sm text-slate-600 hover:text-primary mb-4">
                    <span class="material-icons text-sm">arrow_back</span>
                    Kembali ke Daftar Sektor
                </a>
                <h1 class="text-2xl font-bold text-slate-900">Edit Sektor</h1>
                <p class="text-sm text-slate-500 mt-1">Perbarui informasi sektor {{ $sector->name }}</p>
            </div>

            <!-- Form -->
            <div class="bg-white border border-slate-200 rounded-xl p-6">
                <form action="{{ route('sectors.update', $sector) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="space-y-6">
                        <!-- Nama Sektor -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-slate-700 mb-2">
                                Nama Sektor <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="name" id="name" value="{{ old('name', $sector->name) }}" required
                                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary @error('name') border-red-500 @enderror">
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Kode Sektor -->
                        <div>
                            <label for="code" class="block text-sm font-medium text-slate-700 mb-2">
                                Kode Sektor <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="code" id="code" value="{{ old('code', $sector->code) }}" required
                                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary @error('code') border-red-500 @enderror">
                            @error('code')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Lokasi -->
                        <div>
                            <label for="location" class="block text-sm font-medium text-slate-700 mb-2">
                                Lokasi <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="location" id="location" value="{{ old('location', $sector->location) }}" required
                                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary @error('location') border-red-500 @enderror">
                            @error('location')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Icon -->
                        <div>
                            <label for="icon" class="block text-sm font-medium text-slate-700 mb-2">
                                Icon Material <span class="text-red-500">*</span>
                            </label>
                            <select name="icon" id="icon" required
                                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary @error('icon') border-red-500 @enderror">
                                <option value="">Pilih Icon</option>
                                <option value="local_fire_department" {{ old('icon', $sector->icon) == 'local_fire_department' ? 'selected' : '' }}>🔥 Fire Department</option>
                                <option value="apartment" {{ old('icon', $sector->icon) == 'apartment' ? 'selected' : '' }}>🏢 Apartment</option>
                                <option value="location_on" {{ old('icon', $sector->icon) == 'location_on' ? 'selected' : '' }}>📍 Location</option>
                                <option value="explore" {{ old('icon', $sector->icon) == 'explore' ? 'selected' : '' }}>🧭 Explore</option>
                                <option value="near_me" {{ old('icon', $sector->icon) == 'near_me' ? 'selected' : '' }}>📡 Near Me</option>
                                <option value="sailing" {{ old('icon', $sector->icon) == 'sailing' ? 'selected' : '' }}>⛵ Sailing</option>
                                <option value="flight" {{ old('icon', $sector->icon) == 'flight' ? 'selected' : '' }}>✈️ Flight</option>
                            </select>
                            @error('icon')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Alamat -->
                        <div>
                            <label for="address" class="block text-sm font-medium text-slate-700 mb-2">
                                Alamat Lengkap
                            </label>
                            <textarea name="address" id="address" rows="3"
                                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary @error('address') border-red-500 @enderror">{{ old('address', $sector->address) }}</textarea>
                            @error('address')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Telepon -->
                        <div>
                            <label for="phone" class="block text-sm font-medium text-slate-700 mb-2">
                                Nomor Telepon
                            </label>
                            <input type="text" name="phone" id="phone" value="{{ old('phone', $sector->phone) }}"
                                class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary @error('phone') border-red-500 @enderror">
                            @error('phone')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div>
                            <label class="flex items-center gap-2">
                                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $sector->is_active) ? 'checked' : '' }}
                                    class="w-4 h-4 text-primary border-slate-300 rounded focus:ring-primary">
                                <span class="text-sm font-medium text-slate-700">Sektor Aktif</span>
                            </label>
                            <p class="mt-1 text-xs text-slate-500">Nonaktifkan sektor jika tidak digunakan sementara</p>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex gap-3 mt-8 pt-6 border-t border-slate-200">
                        <a href="{{ route('sectors.index') }}" class="flex-1 px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-lg text-sm font-medium text-center transition-colors">
                            Batal
                        </a>
                        <button type="submit" class="flex-1 px-4 py-2 bg-primary hover:bg-primary/90 text-white rounded-lg text-sm font-medium transition-colors">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

</body>
</html>
