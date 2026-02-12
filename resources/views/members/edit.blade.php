<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Edit Anggota - Absensi Damkar Merangin Jakarta</title>
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
                <span>Edit Anggota</span>
            </div>
            <h1 class="text-2xl font-bold text-slate-900">Edit Data Anggota</h1>
        </div>

        <form method="POST" action="{{ route('members.update', $member) }}" class="max-w-4xl">
            @csrf
            @method('PUT')
            
            <div class="bg-white border border-slate-200 rounded-xl p-6 mb-6">
                <h3 class="font-bold text-lg mb-4">Data Pribadi</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                        <input type="text" name="name" value="{{ old('name', $member->name) }}" required class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('name') border-red-500 @enderror">
                        @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">NIP (18 digit) <span class="text-red-500">*</span></label>
                        <input type="text" name="nip" value="{{ old('nip', $member->nip) }}" maxlength="18" required class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('nip') border-red-500 @enderror">
                        @error('nip')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">NRP <span class="text-red-500">*</span></label>
                        <input type="text" name="nrp" value="{{ old('nrp', $member->nrp) }}" required class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('nrp') border-red-500 @enderror">
                        @error('nrp')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Pangkat <span class="text-red-500">*</span></label>
                        <select name="pangkat" required class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('pangkat') border-red-500 @enderror">
                            <option value="">Pilih Pangkat</option>
                            <option value="Ajun Inspektur Polisi Satu" {{ old('pangkat', $member->pangkat) == 'Ajun Inspektur Polisi Satu' ? 'selected' : '' }}>Ajun Inspektur Polisi Satu</option>
                            <option value="Ajun Inspektur Polisi Dua" {{ old('pangkat', $member->pangkat) == 'Ajun Inspektur Polisi Dua' ? 'selected' : '' }}>Ajun Inspektur Polisi Dua</option>
                            <option value="Brigadir" {{ old('pangkat', $member->pangkat) == 'Brigadir' ? 'selected' : '' }}>Brigadir</option>
                            <option value="Brigadir Kepala" {{ old('pangkat', $member->pangkat) == 'Brigadir Kepala' ? 'selected' : '' }}>Brigadir Kepala</option>
                            <option value="Ajun Brigadir Polisi" {{ old('pangkat', $member->pangkat) == 'Ajun Brigadir Polisi' ? 'selected' : '' }}>Ajun Brigadir Polisi</option>
                        </select>
                        @error('pangkat')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">No. Telepon</label>
                        <input type="text" name="phone" value="{{ old('phone', $member->phone) }}" class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('phone') border-red-500 @enderror">
                        @error('phone')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Email</label>
                        <input type="email" name="email" value="{{ old('email', $member->email) }}" class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('email') border-red-500 @enderror">
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
                            <option value="{{ $sector->id }}" {{ old('sector_id', $member->sector_id) == $sector->id ? 'selected' : '' }}>{{ $sector->name }}</option>
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
                            <option value="A" {{ old('regu', $member->regu) == 'A' ? 'selected' : '' }}>Regu A</option>
                            <option value="B" {{ old('regu', $member->regu) == 'B' ? 'selected' : '' }}>Regu B</option>
                            <option value="C" {{ old('regu', $member->regu) == 'C' ? 'selected' : '' }}>Regu C</option>
                        </select>
                        @error('regu')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Jabatan <span class="text-red-500">*</span></label>
                        <select name="jabatan" required class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('jabatan') border-red-500 @enderror">
                            <option value="">Pilih Jabatan</option>
                            <option value="Komandan Regu" {{ old('jabatan', $member->jabatan) == 'Komandan Regu' ? 'selected' : '' }}>Komandan Regu</option>
                            <option value="Anggota" {{ old('jabatan', $member->jabatan) == 'Anggota' ? 'selected' : '' }}>Anggota</option>
                        </select>
                        @error('jabatan')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="bg-white border border-slate-200 rounded-xl p-6 mb-6">
                <h3 class="font-bold text-lg mb-4">Status & Keamanan</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Status</label>
                        <div class="flex items-center gap-4">
                            <label class="flex items-center gap-2">
                                <input type="radio" name="is_active" value="1" {{ old('is_active', $member->is_active) == 1 ? 'checked' : '' }} class="text-primary focus:ring-primary">
                                <span class="text-sm">Aktif</span>
                            </label>
                            <label class="flex items-center gap-2">
                                <input type="radio" name="is_active" value="0" {{ old('is_active', $member->is_active) == 0 ? 'checked' : '' }} class="text-primary focus:ring-primary">
                                <span class="text-sm">Nonaktif</span>
                            </label>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Password Baru</label>
                        <input type="password" name="password" class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('password') border-red-500 @enderror">
                        <p class="text-xs text-slate-500 mt-1">Kosongkan jika tidak ingin mengubah password</p>
                        @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <button type="submit" class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-primary/90 transition-colors">
                    Simpan Perubahan
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
