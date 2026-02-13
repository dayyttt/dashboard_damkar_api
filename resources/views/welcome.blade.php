<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dinas Pemadam Kebakaran Kabupaten Merangin - Siaga Melindungi Masyarakat</title>
    <meta name="description" content="Dinas Pemadam Kebakaran Kabupaten Merangin melayani masyarakat 24/7 untuk pencegahan dan penanggulangan kebakaran di seluruh wilayah Kabupaten Merangin">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .gradient-text {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .hero-pattern {
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
    </style>
</head>
<body class="antialiased bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white/95 backdrop-blur-md border-b border-gray-200 fixed w-full z-50 top-0 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <div class="flex items-center">
                    <div class="flex-shrink-0 flex items-center gap-3">
                        <div class="w-14 h-14 bg-gradient-to-br from-red-600 to-red-700 rounded-xl flex items-center justify-center shadow-lg">
                            <span class="material-icons text-white text-3xl">local_fire_department</span>
                        </div>
                        <div>
                            <div class="text-xl font-bold text-gray-900">Damkar Merangin</div>
                            <div class="text-xs text-gray-500">Kabupaten Merangin, Jambi</div>
                        </div>
                    </div>
                </div>
                <div class="flex items-center space-x-6">
                    <a href="#tentang" class="text-gray-700 hover:text-red-600 font-medium transition hidden md:block">Tentang</a>
                    <a href="#layanan" class="text-gray-700 hover:text-red-600 font-medium transition hidden md:block">Layanan</a>
                    <a href="#sektor" class="text-gray-700 hover:text-red-600 font-medium transition hidden md:block">Sektor</a>
                    <a href="#kontak" class="text-gray-700 hover:text-red-600 font-medium transition hidden md:block">Kontak</a>
                    @auth
                        <a href="{{ url('/dashboard') }}" class="bg-gray-600 text-white px-6 py-2.5 rounded-lg hover:bg-gray-700 transition font-medium shadow-md flex items-center gap-2">
                            <span class="material-icons text-sm">dashboard</span>
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-500 hover:text-gray-700 transition font-medium text-sm">
                            Login
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="pt-20">
        <div class="relative overflow-hidden" style="background: linear-gradient(135deg, #dc2626 0%, #b91c1c 50%, #991b1b 100%);">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 lg:py-32">
                <div class="grid lg:grid-cols-2 gap-12 items-center">
                    <div>
                        <div class="inline-flex items-center gap-2 bg-white/20 backdrop-blur-sm px-4 py-2 rounded-full mb-6 border border-white/30">
                            <span class="material-icons text-sm text-white">verified</span>
                            <span class="text-sm font-medium text-white">Melayani Masyarakat Merangin</span>
                        </div>
                        <h1 class="text-5xl lg:text-6xl font-extrabold mb-6 leading-tight text-white drop-shadow-lg">
                            Siaga Melindungi
                            <span class="block text-yellow-300 mt-2">Masyarakat Merangin</span>
                        </h1>
                        <p class="text-xl text-white mb-8 leading-relaxed drop-shadow-md">
                            Dinas Pemadam Kebakaran Kabupaten Merangin siap melayani masyarakat 24 jam setiap hari untuk pencegahan dan penanggulangan kebakaran serta penyelamatan darurat di seluruh wilayah kabupaten.
                        </p>
                        <div class="flex flex-wrap gap-4">
                            <a href="tel:113" class="inline-flex items-center gap-2 bg-white text-red-700 px-8 py-4 rounded-xl hover:bg-gray-50 transition font-bold text-lg shadow-xl hover:shadow-2xl hover:scale-105">
                                <span class="material-icons">phone</span>
                                Hubungi 113
                            </a>
                            <a href="#layanan" class="inline-flex items-center gap-2 bg-white/20 backdrop-blur-sm text-white px-8 py-4 rounded-xl hover:bg-white/30 transition font-bold text-lg border-2 border-white shadow-lg">
                                <span class="material-icons">info</span>
                                Layanan Kami
                            </a>
                        </div>
                        <div class="mt-12 flex flex-wrap items-center gap-8">
                            <div>
                                <div class="text-4xl font-bold text-white drop-shadow-lg">250+</div>
                                <div class="text-yellow-300 text-sm font-medium">Personel Siaga</div>
                            </div>
                            <div class="w-px h-12 bg-white/30"></div>
                            <div>
                                <div class="text-4xl font-bold text-white drop-shadow-lg">7</div>
                                <div class="text-yellow-300 text-sm font-medium">Pos Pemadam</div>
                            </div>
                            <div class="w-px h-12 bg-white/30"></div>
                            <div>
                                <div class="text-4xl font-bold text-white drop-shadow-lg">24/7</div>
                                <div class="text-yellow-300 text-sm font-medium">Layanan Darurat</div>
                            </div>
                        </div>
                    </div>
                    <div class="hidden lg:block">
                        <div class="relative">
                            <div class="absolute inset-0 bg-gradient-to-tr from-red-500/20 to-transparent rounded-3xl blur-xl"></div>
                            <div class="relative bg-white/15 backdrop-blur-lg rounded-3xl p-8 border-2 border-white/30 shadow-2xl">
                                <div class="space-y-6">
                                    <div class="flex items-center gap-4 bg-white/20 backdrop-blur-sm p-5 rounded-xl border border-white/20 hover:bg-white/30 transition">
                                        <div class="w-14 h-14 bg-red-500 rounded-xl flex items-center justify-center shadow-lg">
                                            <span class="material-icons text-white text-2xl">local_fire_department</span>
                                        </div>
                                        <div class="text-white">
                                            <div class="font-bold text-lg">Pemadaman Kebakaran</div>
                                            <div class="text-sm text-yellow-200">Respons Cepat 24/7</div>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-4 bg-white/20 backdrop-blur-sm p-5 rounded-xl border border-white/20 hover:bg-white/30 transition">
                                        <div class="w-14 h-14 bg-blue-500 rounded-xl flex items-center justify-center shadow-lg">
                                            <span class="material-icons text-white text-2xl">health_and_safety</span>
                                        </div>
                                        <div class="text-white">
                                            <div class="font-bold text-lg">Penyelamatan Darurat</div>
                                            <div class="text-sm text-yellow-200">Tim Profesional</div>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-4 bg-white/20 backdrop-blur-sm p-5 rounded-xl border border-white/20 hover:bg-white/30 transition">
                                        <div class="w-14 h-14 bg-green-500 rounded-xl flex items-center justify-center shadow-lg">
                                            <span class="material-icons text-white text-2xl">school</span>
                                        </div>
                                        <div class="text-white">
                                            <div class="font-bold text-lg">Edukasi & Pencegahan</div>
                                            <div class="text-sm text-yellow-200">Sosialisasi Gratis</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="absolute bottom-0 left-0 right-0">
                <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 120L60 105C120 90 240 60 360 45C480 30 600 30 720 37.5C840 45 960 60 1080 67.5C1200 75 1320 75 1380 75L1440 75V120H1380C1320 120 1200 120 1080 120C960 120 840 120 720 120C600 120 480 120 360 120C240 120 120 120 60 120H0Z" fill="white"/>
                </svg>
            </div>
        </div>

        <!-- About Section -->
        <div id="tentang" class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid lg:grid-cols-2 gap-12 items-center">
                    <div>
                        <div class="inline-block bg-red-100 text-red-700 px-4 py-2 rounded-full text-sm font-bold mb-4">
                            Tentang Kami
                        </div>
                        <h2 class="text-4xl font-extrabold text-gray-900 mb-6">
                            Dinas Pemadam Kebakaran
                            <span class="gradient-text block">Kabupaten Merangin</span>
                        </h2>
                        <div class="space-y-4 text-gray-600 leading-relaxed">
                            <p>
                                Dinas Pemadam Kebakaran Kabupaten Merangin merupakan unit pelayanan publik yang bertugas melindungi masyarakat dari bahaya kebakaran dan bencana lainnya di wilayah Kabupaten Merangin, Provinsi Jambi.
                            </p>
                            <p>
                                Dengan cakupan wilayah yang luas, kami mengoperasikan 7 pos pemadam strategis yang tersebar di seluruh kabupaten, didukung oleh lebih dari 250 personel terlatih yang siaga 24 jam setiap hari untuk melayani masyarakat.
                            </p>
                            <p>
                                Kami berkomitmen memberikan pelayanan terbaik dalam pencegahan, penanggulangan kebakaran, serta penyelamatan darurat untuk keselamatan masyarakat Merangin.
                            </p>
                        </div>
                        <div class="mt-8 grid grid-cols-2 gap-6">
                            <div class="bg-gradient-to-br from-red-50 to-red-100 p-6 rounded-xl">
                                <div class="text-3xl font-bold text-red-700 mb-2">7</div>
                                <div class="text-sm text-gray-700 font-medium">Pos Pemadam</div>
                            </div>
                            <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-6 rounded-xl">
                                <div class="text-3xl font-bold text-blue-700 mb-2">250+</div>
                                <div class="text-sm text-gray-700 font-medium">Personel Terlatih</div>
                            </div>
                            <div class="bg-gradient-to-br from-green-50 to-green-100 p-6 rounded-xl">
                                <div class="text-3xl font-bold text-green-700 mb-2">24/7</div>
                                <div class="text-sm text-gray-700 font-medium">Layanan Siaga</div>
                            </div>
                            <div class="bg-gradient-to-br from-purple-50 to-purple-100 p-6 rounded-xl">
                                <div class="text-3xl font-bold text-purple-700 mb-2">113</div>
                                <div class="text-sm text-gray-700 font-medium">Nomor Darurat</div>
                            </div>
                        </div>
                    </div>
                    <div class="relative">
                        <div class="bg-gradient-to-br from-red-100 to-red-50 rounded-3xl p-8">
                            <div class="space-y-4">
                                <div class="bg-white rounded-xl p-6 shadow-md">
                                    <div class="flex items-center gap-4 mb-4">
                                        <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center">
                                            <span class="material-icons text-red-600">flag</span>
                                        </div>
                                        <div>
                                            <div class="font-bold text-gray-900">Visi</div>
                                        </div>
                                    </div>
                                    <p class="text-gray-600 text-sm leading-relaxed">
                                        Menjadi Dinas Pemadam Kebakaran yang profesional, responsif, dan terpercaya dalam melindungi masyarakat Kabupaten Merangin dari bahaya kebakaran dan bencana.
                                    </p>
                                </div>
                                <div class="bg-white rounded-xl p-6 shadow-md">
                                    <div class="flex items-center gap-4 mb-4">
                                        <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                                            <span class="material-icons text-blue-600">track_changes</span>
                                        </div>
                                        <div>
                                            <div class="font-bold text-gray-900">Misi</div>
                                        </div>
                                    </div>
                                    <ul class="text-gray-600 text-sm space-y-2">
                                        <li class="flex items-start gap-2">
                                            <span class="material-icons text-green-600 text-sm mt-0.5">check_circle</span>
                                            <span>Meningkatkan kesiapsiagaan dan respons cepat terhadap kejadian kebakaran</span>
                                        </li>
                                        <li class="flex items-start gap-2">
                                            <span class="material-icons text-green-600 text-sm mt-0.5">check_circle</span>
                                            <span>Memberikan pelayanan terbaik kepada masyarakat</span>
                                        </li>
                                        <li class="flex items-start gap-2">
                                            <span class="material-icons text-green-600 text-sm mt-0.5">check_circle</span>
                                            <span>Meningkatkan kesadaran masyarakat tentang pencegahan kebakaran</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Emergency Alert -->
        <div class="bg-gradient-to-r from-red-600 to-red-700 py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                    <div class="flex items-center gap-4 text-white">
                        <div class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center animate-pulse">
                            <span class="material-icons text-4xl">emergency</span>
                        </div>
                        <div>
                            <div class="text-2xl font-bold">Keadaan Darurat?</div>
                            <div class="text-red-100">Hubungi kami segera untuk bantuan</div>
                        </div>
                    </div>
                    <a href="tel:113" class="bg-white text-red-700 px-10 py-4 rounded-xl hover:bg-gray-50 transition font-bold text-2xl shadow-xl hover:scale-105 flex items-center gap-3">
                        <span class="material-icons text-3xl">phone</span>
                        113
                    </a>
                </div>
            </div>
        </div>

        <!-- Services Section -->
        <div id="layanan" class="py-20 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <div class="inline-block bg-red-100 text-red-700 px-4 py-2 rounded-full text-sm font-bold mb-4">
                        Layanan Kami
                    </div>
                    <h2 class="text-4xl font-extrabold text-gray-900 mb-4">
                        Melayani Masyarakat Merangin
                    </h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                        Berbagai layanan profesional untuk keselamatan dan keamanan masyarakat dari bahaya kebakaran
                    </p>
                </div>

                <div class="grid gap-8 grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
                    <!-- Service 1 -->
                    <div class="group bg-white rounded-2xl shadow-md border border-gray-200 p-8 hover:shadow-2xl hover:border-red-300 transition-all duration-300">
                        <div class="w-16 h-16 bg-gradient-to-br from-red-500 to-red-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform shadow-lg">
                            <span class="material-icons text-white text-3xl">local_fire_department</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Pemadaman Kebakaran</h3>
                        <p class="text-gray-600 leading-relaxed mb-4">
                            Layanan pemadaman kebakaran 24/7 dengan respons cepat dan peralatan modern untuk menangani berbagai jenis kebakaran.
                        </p>
                        <ul class="space-y-2 text-sm text-gray-600">
                            <li class="flex items-center gap-2">
                                <span class="material-icons text-green-600 text-sm">check_circle</span>
                                Respons cepat 24 jam
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="material-icons text-green-600 text-sm">check_circle</span>
                                Tim profesional terlatih
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="material-icons text-green-600 text-sm">check_circle</span>
                                Peralatan lengkap & modern
                            </li>
                        </ul>
                    </div>

                    <!-- Service 2 -->
                    <div class="group bg-white rounded-2xl shadow-md border border-gray-200 p-8 hover:shadow-2xl hover:border-blue-300 transition-all duration-300">
                        <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform shadow-lg">
                            <span class="material-icons text-white text-3xl">health_and_safety</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Penyelamatan Darurat</h3>
                        <p class="text-gray-600 leading-relaxed mb-4">
                            Operasi penyelamatan untuk korban kebakaran, kecelakaan, atau situasi darurat lainnya dengan prosedur standar keselamatan.
                        </p>
                        <ul class="space-y-2 text-sm text-gray-600">
                            <li class="flex items-center gap-2">
                                <span class="material-icons text-green-600 text-sm">check_circle</span>
                                Evakuasi korban
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="material-icons text-green-600 text-sm">check_circle</span>
                                Pertolongan pertama
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="material-icons text-green-600 text-sm">check_circle</span>
                                Koordinasi medis
                            </li>
                        </ul>
                    </div>

                    <!-- Service 3 -->
                    <div class="group bg-white rounded-2xl shadow-md border border-gray-200 p-8 hover:shadow-2xl hover:border-green-300 transition-all duration-300">
                        <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-green-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform shadow-lg">
                            <span class="material-icons text-white text-3xl">school</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Edukasi & Sosialisasi</h3>
                        <p class="text-gray-600 leading-relaxed mb-4">
                            Program edukasi dan sosialisasi pencegahan kebakaran untuk sekolah, perkantoran, dan masyarakat umum secara gratis.
                        </p>
                        <ul class="space-y-2 text-sm text-gray-600">
                            <li class="flex items-center gap-2">
                                <span class="material-icons text-green-600 text-sm">check_circle</span>
                                Penyuluhan gratis
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="material-icons text-green-600 text-sm">check_circle</span>
                                Simulasi kebakaran
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="material-icons text-green-600 text-sm">check_circle</span>
                                Pelatihan APAR
                            </li>
                        </ul>
                    </div>

                    <!-- Service 4 -->
                    <div class="group bg-white rounded-2xl shadow-md border border-gray-200 p-8 hover:shadow-2xl hover:border-yellow-300 transition-all duration-300">
                        <div class="w-16 h-16 bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform shadow-lg">
                            <span class="material-icons text-white text-3xl">assignment_turned_in</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Inspeksi & Sertifikasi</h3>
                        <p class="text-gray-600 leading-relaxed mb-4">
                            Layanan inspeksi keselamatan kebakaran untuk bangunan, gedung, dan fasilitas umum sesuai standar keselamatan.
                        </p>
                        <ul class="space-y-2 text-sm text-gray-600">
                            <li class="flex items-center gap-2">
                                <span class="material-icons text-green-600 text-sm">check_circle</span>
                                Inspeksi bangunan
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="material-icons text-green-600 text-sm">check_circle</span>
                                Audit keselamatan
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="material-icons text-green-600 text-sm">check_circle</span>
                                Sertifikat laik fungsi
                            </li>
                        </ul>
                    </div>

                    <!-- Service 5 -->
                    <div class="group bg-white rounded-2xl shadow-md border border-gray-200 p-8 hover:shadow-2xl hover:border-purple-300 transition-all duration-300">
                        <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform shadow-lg">
                            <span class="material-icons text-white text-3xl">water_drop</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Bantuan Air Bersih</h3>
                        <p class="text-gray-600 leading-relaxed mb-4">
                            Layanan penyediaan air bersih untuk masyarakat yang mengalami kesulitan air, terutama saat musim kemarau.
                        </p>
                        <ul class="space-y-2 text-sm text-gray-600">
                            <li class="flex items-center gap-2">
                                <span class="material-icons text-green-600 text-sm">check_circle</span>
                                Distribusi air bersih
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="material-icons text-green-600 text-sm">check_circle</span>
                                Tangki air mobile
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="material-icons text-green-600 text-sm">check_circle</span>
                                Layanan sosial gratis
                            </li>
                        </ul>
                    </div>

                    <!-- Service 6 -->
                    <div class="group bg-white rounded-2xl shadow-md border border-gray-200 p-8 hover:shadow-2xl hover:border-indigo-300 transition-all duration-300">
                        <div class="w-16 h-16 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform shadow-lg">
                            <span class="material-icons text-white text-3xl">support_agent</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Konsultasi Keselamatan</h3>
                        <p class="text-gray-600 leading-relaxed mb-4">
                            Konsultasi gratis tentang sistem proteksi kebakaran, perencanaan evakuasi, dan standar keselamatan bangunan.
                        </p>
                        <ul class="space-y-2 text-sm text-gray-600">
                            <li class="flex items-center gap-2">
                                <span class="material-icons text-green-600 text-sm">check_circle</span>
                                Konsultasi gratis
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="material-icons text-green-600 text-sm">check_circle</span>
                                Rekomendasi sistem
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="material-icons text-green-600 text-sm">check_circle</span>
                                Panduan evakuasi
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sectors Section -->
        <div id="sektor" class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <div class="inline-block bg-red-100 text-red-700 px-4 py-2 rounded-full text-sm font-bold mb-4">
                        Cakupan Wilayah
                    </div>
                    <h2 class="text-4xl font-extrabold text-gray-900 mb-4">
                        7 Pos Pemadam Kebakaran
                    </h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                        Tersebar strategis di seluruh Kabupaten Merangin untuk respons cepat dan pelayanan maksimal kepada masyarakat
                    </p>
                </div>

                <div class="grid gap-6 grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                    <!-- Sektor 1 -->
                    <div class="bg-gradient-to-br from-red-50 to-white rounded-2xl p-6 border-2 border-red-200 hover:border-red-400 hover:shadow-xl transition-all">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="w-14 h-14 bg-red-600 rounded-xl flex items-center justify-center shadow-lg">
                                <span class="material-icons text-white text-2xl">location_city</span>
                            </div>
                            <div>
                                <div class="text-2xl font-bold text-gray-900">Pos 1</div>
                                <div class="text-sm text-gray-600">Pusat Kota</div>
                            </div>
                        </div>
                        <div class="space-y-2 text-sm">
                            <div class="flex items-center gap-2 text-gray-700">
                                <span class="material-icons text-red-600 text-sm">place</span>
                                <span>Bangko Kota</span>
                            </div>
                            <div class="flex items-center gap-2 text-gray-700">
                                <span class="material-icons text-blue-600 text-sm">phone</span>
                                <span>Hubungi: 113</span>
                            </div>
                        </div>
                    </div>

                    <!-- Sektor 2 -->
                    <div class="bg-gradient-to-br from-blue-50 to-white rounded-2xl p-6 border-2 border-blue-200 hover:border-blue-400 hover:shadow-xl transition-all">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="w-14 h-14 bg-blue-600 rounded-xl flex items-center justify-center shadow-lg">
                                <span class="material-icons text-white text-2xl">location_city</span>
                            </div>
                            <div>
                                <div class="text-2xl font-bold text-gray-900">Pos 2</div>
                                <div class="text-sm text-gray-600">Wilayah Utara</div>
                            </div>
                        </div>
                        <div class="space-y-2 text-sm">
                            <div class="flex items-center gap-2 text-gray-700">
                                <span class="material-icons text-red-600 text-sm">place</span>
                                <span>Bangko Barat</span>
                            </div>
                            <div class="flex items-center gap-2 text-gray-700">
                                <span class="material-icons text-blue-600 text-sm">phone</span>
                                <span>Hubungi: 113</span>
                            </div>
                        </div>
                    </div>

                    <!-- Sektor 3 -->
                    <div class="bg-gradient-to-br from-green-50 to-white rounded-2xl p-6 border-2 border-green-200 hover:border-green-400 hover:shadow-xl transition-all">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="w-14 h-14 bg-green-600 rounded-xl flex items-center justify-center shadow-lg">
                                <span class="material-icons text-white text-2xl">location_city</span>
                            </div>
                            <div>
                                <div class="text-2xl font-bold text-gray-900">Pos 3</div>
                                <div class="text-sm text-gray-600">Wilayah Selatan</div>
                            </div>
                        </div>
                        <div class="space-y-2 text-sm">
                            <div class="flex items-center gap-2 text-gray-700">
                                <span class="material-icons text-red-600 text-sm">place</span>
                                <span>Jangkat</span>
                            </div>
                            <div class="flex items-center gap-2 text-gray-700">
                                <span class="material-icons text-blue-600 text-sm">phone</span>
                                <span>Hubungi: 113</span>
                            </div>
                        </div>
                    </div>

                    <!-- Sektor 4 -->
                    <div class="bg-gradient-to-br from-yellow-50 to-white rounded-2xl p-6 border-2 border-yellow-200 hover:border-yellow-400 hover:shadow-xl transition-all">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="w-14 h-14 bg-yellow-600 rounded-xl flex items-center justify-center shadow-lg">
                                <span class="material-icons text-white text-2xl">location_city</span>
                            </div>
                            <div>
                                <div class="text-2xl font-bold text-gray-900">Pos 4</div>
                                <div class="text-sm text-gray-600">Wilayah Timur</div>
                            </div>
                        </div>
                        <div class="space-y-2 text-sm">
                            <div class="flex items-center gap-2 text-gray-700">
                                <span class="material-icons text-red-600 text-sm">place</span>
                                <span>Muara Siau</span>
                            </div>
                            <div class="flex items-center gap-2 text-gray-700">
                                <span class="material-icons text-blue-600 text-sm">phone</span>
                                <span>Hubungi: 113</span>
                            </div>
                        </div>
                    </div>

                    <!-- Sektor 5 -->
                    <div class="bg-gradient-to-br from-purple-50 to-white rounded-2xl p-6 border-2 border-purple-200 hover:border-purple-400 hover:shadow-xl transition-all">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="w-14 h-14 bg-purple-600 rounded-xl flex items-center justify-center shadow-lg">
                                <span class="material-icons text-white text-2xl">location_city</span>
                            </div>
                            <div>
                                <div class="text-2xl font-bold text-gray-900">Pos 5</div>
                                <div class="text-sm text-gray-600">Wilayah Barat</div>
                            </div>
                        </div>
                        <div class="space-y-2 text-sm">
                            <div class="flex items-center gap-2 text-gray-700">
                                <span class="material-icons text-red-600 text-sm">place</span>
                                <span>Tabir</span>
                            </div>
                            <div class="flex items-center gap-2 text-gray-700">
                                <span class="material-icons text-blue-600 text-sm">phone</span>
                                <span>Hubungi: 113</span>
                            </div>
                        </div>
                    </div>

                    <!-- Sektor 6 -->
                    <div class="bg-gradient-to-br from-indigo-50 to-white rounded-2xl p-6 border-2 border-indigo-200 hover:border-indigo-400 hover:shadow-xl transition-all">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="w-14 h-14 bg-indigo-600 rounded-xl flex items-center justify-center shadow-lg">
                                <span class="material-icons text-white text-2xl">location_city</span>
                            </div>
                            <div>
                                <div class="text-2xl font-bold text-gray-900">Pos 6</div>
                                <div class="text-sm text-gray-600">Wilayah Tengah</div>
                            </div>
                        </div>
                        <div class="space-y-2 text-sm">
                            <div class="flex items-center gap-2 text-gray-700">
                                <span class="material-icons text-red-600 text-sm">place</span>
                                <span>Renah Pamenang</span>
                            </div>
                            <div class="flex items-center gap-2 text-gray-700">
                                <span class="material-icons text-blue-600 text-sm">phone</span>
                                <span>Hubungi: 113</span>
                            </div>
                        </div>
                    </div>

                    <!-- Sektor 7 -->
                    <div class="bg-gradient-to-br from-pink-50 to-white rounded-2xl p-6 border-2 border-pink-200 hover:border-pink-400 hover:shadow-xl transition-all">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="w-14 h-14 bg-pink-600 rounded-xl flex items-center justify-center shadow-lg">
                                <span class="material-icons text-white text-2xl">location_city</span>
                            </div>
                            <div>
                                <div class="text-2xl font-bold text-gray-900">Pos 7</div>
                                <div class="text-sm text-gray-600">Wilayah Perbatasan</div>
                            </div>
                        </div>
                        <div class="space-y-2 text-sm">
                            <div class="flex items-center gap-2 text-gray-700">
                                <span class="material-icons text-red-600 text-sm">place</span>
                                <span>Lembah Masurai</span>
                            </div>
                            <div class="flex items-center gap-2 text-gray-700">
                                <span class="material-icons text-blue-600 text-sm">phone</span>
                                <span>Hubungi: 113</span>
                            </div>
                        </div>
                    </div>

                    <!-- Info Card -->
                    <div class="bg-gradient-to-br from-gray-900 to-gray-800 rounded-2xl p-6 border-2 border-gray-700 flex flex-col justify-center items-center text-center">
                        <span class="material-icons text-white text-5xl mb-4">emergency</span>
                        <div class="text-white">
                            <div class="text-3xl font-bold mb-2">24/7</div>
                            <div class="text-sm text-gray-300">Siaga Darurat</div>
                            <div class="text-xs text-gray-400 mt-2">Hubungi 113</div>
                        </div>
                    </div>
                </div>

                <div class="mt-12 bg-gradient-to-r from-red-600 to-red-700 rounded-2xl p-8 text-center text-white">
                    <div class="flex items-center justify-center gap-3 mb-4">
                        <span class="material-icons text-4xl">phone_in_talk</span>
                        <h3 class="text-3xl font-bold">Layanan Darurat</h3>
                    </div>
                    <p class="text-red-100 mb-6 text-lg">
                        Untuk keadaan darurat kebakaran, hubungi nomor layanan kami
                    </p>
                    <div class="flex flex-wrap justify-center gap-4">
                        <a href="tel:113" class="bg-white/20 backdrop-blur-sm px-8 py-4 rounded-xl hover:bg-white/30 transition cursor-pointer">
                            <div class="text-sm text-red-100 mb-1">Nomor Darurat</div>
                            <div class="text-3xl font-bold">113</div>
                        </a>
                        <a href="tel:074621XXX" class="bg-white/20 backdrop-blur-sm px-8 py-4 rounded-xl hover:bg-white/30 transition cursor-pointer">
                            <div class="text-sm text-red-100 mb-1">Kantor Pusat</div>
                            <div class="text-2xl font-bold">(0746) 21XXX</div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer id="kontak" class="bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900">
            <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-12">
                    <!-- About -->
                    <div>
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-12 h-12 bg-red-600 rounded-xl flex items-center justify-center shadow-lg">
                                <span class="material-icons text-white text-2xl">local_fire_department</span>
                            </div>
                            <div>
                                <div class="text-lg font-bold text-white">Damkar Merangin</div>
                                <div class="text-xs text-gray-400">Kab. Merangin</div>
                            </div>
                        </div>
                        <p class="text-gray-400 text-sm leading-relaxed mb-4">
                            Dinas Pemadam Kebakaran Kabupaten Merangin melayani masyarakat dengan dedikasi penuh untuk keselamatan dan keamanan dari bahaya kebakaran.
                        </p>
                        <div class="flex gap-3">
                            <a href="#" class="w-10 h-10 bg-gray-800 hover:bg-red-600 rounded-lg flex items-center justify-center transition">
                                <span class="material-icons text-white text-sm">facebook</span>
                            </a>
                            <a href="#" class="w-10 h-10 bg-gray-800 hover:bg-red-600 rounded-lg flex items-center justify-center transition">
                                <span class="material-icons text-white text-sm">photo_camera</span>
                            </a>
                            <a href="#" class="w-10 h-10 bg-gray-800 hover:bg-red-600 rounded-lg flex items-center justify-center transition">
                                <span class="material-icons text-white text-sm">email</span>
                            </a>
                        </div>
                    </div>

                    <!-- Quick Links -->
                    <div>
                        <h3 class="text-white font-bold mb-6 text-lg">Menu Cepat</h3>
                        <ul class="space-y-3">
                            <li>
                                <a href="#tentang" class="text-gray-400 hover:text-red-500 transition flex items-center gap-2 text-sm">
                                    <span class="material-icons text-xs">chevron_right</span>
                                    Tentang Kami
                                </a>
                            </li>
                            <li>
                                <a href="#layanan" class="text-gray-400 hover:text-red-500 transition flex items-center gap-2 text-sm">
                                    <span class="material-icons text-xs">chevron_right</span>
                                    Layanan
                                </a>
                            </li>
                            <li>
                                <a href="#sektor" class="text-gray-400 hover:text-red-500 transition flex items-center gap-2 text-sm">
                                    <span class="material-icons text-xs">chevron_right</span>
                                    Pos Pemadam
                                </a>
                            </li>
                            <li>
                                <a href="#kontak" class="text-gray-400 hover:text-red-500 transition flex items-center gap-2 text-sm">
                                    <span class="material-icons text-xs">chevron_right</span>
                                    Kontak Kami
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- Contact -->
                    <div>
                        <h3 class="text-white font-bold mb-6 text-lg">Kontak</h3>
                        <ul class="space-y-4">
                            <li class="flex items-start gap-3">
                                <span class="material-icons text-red-500 text-sm mt-0.5">location_on</span>
                                <div class="text-gray-400 text-sm">
                                    Jl. Lintas Sumatera, Bangko<br>
                                    Kabupaten Merangin, Jambi 37312
                                </div>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="material-icons text-red-500 text-sm mt-0.5">phone</span>
                                <div class="text-gray-400 text-sm">
                                    Darurat: <a href="tel:113" class="hover:text-red-500">113</a><br>
                                    Kantor: <a href="tel:074621XXX" class="hover:text-red-500">(0746) 21XXX</a>
                                </div>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="material-icons text-red-500 text-sm mt-0.5">email</span>
                                <div class="text-gray-400 text-sm">
                                    <a href="mailto:damkar@meranginkab.go.id" class="hover:text-red-500">damkar@meranginkab.go.id</a>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <!-- Working Hours -->
                    <div>
                        <h3 class="text-white font-bold mb-6 text-lg">Jam Layanan</h3>
                        <div class="space-y-4">
                            <div class="bg-gray-800 rounded-xl p-4">
                                <div class="flex items-center gap-2 mb-2">
                                    <span class="material-icons text-red-500 text-sm">emergency</span>
                                    <div class="text-white font-bold text-sm">Layanan Darurat</div>
                                </div>
                                <div class="text-gray-400 text-sm">24 Jam / 7 Hari</div>
                                <div class="text-xs text-gray-500 mt-1">Hubungi: 113</div>
                            </div>
                            <div class="bg-gray-800 rounded-xl p-4">
                                <div class="flex items-center gap-2 mb-2">
                                    <span class="material-icons text-blue-500 text-sm">business</span>
                                    <div class="text-white font-bold text-sm">Kantor Administrasi</div>
                                </div>
                                <div class="text-gray-400 text-sm">
                                    Senin - Jumat<br>
                                    08:00 - 16:00 WIB
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bottom Footer -->
                <div class="border-t border-gray-800 pt-8">
                    <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                        <div class="text-gray-400 text-sm text-center md:text-left">
                            © 2026 Dinas Pemadam Kebakaran Kabupaten Merangin. All rights reserved.
                        </div>
                        <div class="flex items-center gap-6 text-sm">
                            <a href="#" class="text-gray-400 hover:text-red-500 transition">Kebijakan Privasi</a>
                            <span class="text-gray-700">|</span>
                            <a href="#" class="text-gray-400 hover:text-red-500 transition">Syarat & Ketentuan</a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
