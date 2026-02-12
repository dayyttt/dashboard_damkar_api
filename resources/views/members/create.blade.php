<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Tambah Anggota - Absensi Damkar Merangin Jakarta</title>
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
                <span>Tambah Anggota</span>
            </div>
            <h1 class="text-2xl font-bold text-slate-900">Tambah Anggota Baru</h1>
        </div>

        <form method="POST" action="{{ route('members.store') }}" class="max-w-4xl">
            @csrf
            
            <div class="bg-white border border-slate-200 rounded-xl p-6 mb-6">
                <h3 class="font-bold text-lg mb-4">Data Pribadi</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                        <input type="text" name="name" value="{{ old('name') }}" required class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('name') border-red-500 @enderror">
                        @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">NIP (18 digit) <span class="text-red-500">*</span></label>
                        <input type="text" name="nip" value="{{ old('nip') }}" maxlength="18" required class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('nip') border-red-500 @enderror">
                        @error('nip')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">NRP <span class="text-red-500">*</span></label>
                        <input type="text" name="nrp" value="{{ old('nrp') }}" required class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('nrp') border-red-500 @enderror">
                        @error('nrp')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Pangkat <span class="text-red-500">*</span></label>
                        <select name="pangkat" required class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('pangkat') border-red-500 @enderror">
                            <option value="">Pilih Pangkat</option>
                            <option value="Ajun Inspektur Polisi Satu" {{ old('pangkat') == 'Ajun Inspektur Polisi Satu' ? 'selected' : '' }}>Ajun Inspektur Polisi Satu</option>
                            <option value="Ajun Inspektur Polisi Dua" {{ old('pangkat') == 'Ajun Inspektur Polisi Dua' ? 'selected' : '' }}>Ajun Inspektur Polisi Dua</option>
                            <option value="Brigadir" {{ old('pangkat') == 'Brigadir' ? 'selected' : '' }}>Brigadir</option>
                            <option value="Brigadir Kepala" {{ old('pangkat') == 'Brigadir Kepala' ? 'selected' : '' }}>Brigadir Kepala</option>
                            <option value="Ajun Brigadir Polisi" {{ old('pangkat') == 'Ajun Brigadir Polisi' ? 'selected' : '' }}>Ajun Brigadir Polisi</option>
                        </select>
                        @error('pangkat')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">No. Telepon</label>
                        <input type="text" name="phone" value="{{ old('phone') }}" class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('phone') border-red-500 @enderror">
                        @error('phone')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('email') border-red-500 @enderror">
                        @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="bg-white border border-slate-200 rounded-xl p-6 mb-6">
                <h3 class="font-bold text-lg mb-4">Penempatan</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Sektor <span class="text-red-500">*</span></label>
                        <select name="sector_id" required class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('sector_id') border-red-500 @enderror">
                            <option value="">Pilih Sektor</option>
                            @foreach($sectors as $sector)
                            <option value="{{ $sector->id }}" {{ old('sector_id') == $sector->id ? 'selected' : '' }}>{{ $sector->name }}</option>
                            @endforeach
                        </select>
                        @error('sector_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Regu <span class="text-red-500">*</span></label>
                        <select name="regu" required class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('regu') border-red-500 @enderror">
                            <option value="">Pilih Regu</option>
                            <option value="A" {{ old('regu') == 'A' ? 'selected' : '' }}>Regu A</option>
                            <option value="B" {{ old('regu') == 'B' ? 'selected' : '' }}>Regu B</option>
                            <option value="C" {{ old('regu') == 'C' ? 'selected' : '' }}>Regu C</option>
                        </select>
                        @error('regu')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Jabatan <span class="text-red-500">*</span></label>
                        <select name="jabatan" required class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('jabatan') border-red-500 @enderror">
                            <option value="">Pilih Jabatan</option>
                            <option value="Komandan Regu" {{ old('jabatan') == 'Komandan Regu' ? 'selected' : '' }}>Komandan Regu</option>
                            <option value="Anggota" {{ old('jabatan') == 'Anggota' ? 'selected' : '' }}>Anggota</option>
                        </select>
                        @error('jabatan')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="bg-white border border-slate-200 rounded-xl p-6 mb-6">
                <h3 class="font-bold text-lg mb-4">Keamanan</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Password <span class="text-red-500">*</span></label>
                        <input type="password" name="password" required class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('password') border-red-500 @enderror">
                        <p class="text-xs text-slate-500 mt-1">Minimal 5 karakter</p>
                        @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <button type="submit" class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-primary/90 transition-colors">
                    Simpan
                </button>
                <a href="{{ route('members.index') }}" class="px-6 py-2 border border-slate-300 text-slate-700 rounded-lg hover:bg-slate-50 transition-colors">
                    Batal
                </a>
            </div>
        </form>
    </div>
</main>

</body>
</html>
