    <!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Pengaturan - Absensi Damkar Merangin Jakarta</title>
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
            <h1 class="text-2xl font-bold text-slate-900">Pengaturan Sistem</h1>
            <p class="text-sm text-slate-500 mt-1">Konfigurasi lokasi absen dan jadwal kehadiran</p>
        </div>

        @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-800 rounded-lg flex items-center gap-3">
            <span class="material-icons">check_circle</span>
            <span>{{ session('success') }}</span>
        </div>
        @endif

        <form method="POST" action="{{ route('settings.update') }}" class="max-w-4xl" id="settingsForm">
            @csrf
            @method('PUT')
            
            <!-- Lokasi Absen -->
            <div class="bg-white border border-slate-200 rounded-xl p-6 mb-6">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 bg-primary/10 rounded-lg flex items-center justify-center">
                        <span class="material-icons text-primary">location_on</span>
                    </div>
                    <div>
                        <h3 class="font-bold text-lg">Lokasi Absen</h3>
                        <p class="text-sm text-slate-500">Atur koordinat dan radius area absen</p>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Latitude <span class="text-red-500">*</span></label>
                        <input type="text" name="office_latitude" value="{{ old('office_latitude', $settings['office_latitude']) }}" required pattern="-?\d+\.?\d*" class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('office_latitude') border-red-500 @enderror">
                        <p class="text-xs text-slate-500 mt-1">Contoh: -6.200000</p>
                        @error('office_latitude')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Longitude <span class="text-red-500">*</span></label>
                        <input type="text" name="office_longitude" value="{{ old('office_longitude', $settings['office_longitude']) }}" required pattern="-?\d+\.?\d*" class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('office_longitude') border-red-500 @enderror">
                        <p class="text-xs text-slate-500 mt-1">Contoh: 106.816666</p>
                        @error('office_longitude')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Radius Area (meter) <span class="text-red-500">*</span></label>
                        <input type="number" name="attendance_radius" value="{{ old('attendance_radius', $settings['attendance_radius']) }}" min="10" max="1000" required class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('attendance_radius') border-red-500 @enderror">
                        <p class="text-xs text-slate-500 mt-1">Jarak maksimal dari lokasi kantor (10-1000 meter)</p>
                        @error('attendance_radius')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Alamat Kantor <span class="text-red-500">*</span></label>
                        <input type="text" name="office_address" value="{{ old('office_address', $settings['office_address']) }}" required class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent @error('office_address') border-red-500 @enderror">
                        @error('office_address')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-4 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                    <div class="flex items-start gap-3">
                        <span class="material-icons text-blue-600 text-sm">info</span>
                        <div class="text-sm text-blue-800">
                            <p class="font-medium mb-1">Cara mengatur lokasi:</p>
                            <ol class="list-decimal list-inside space-y-1 text-xs">
                                <li>Klik pada peta di bawah untuk memilih lokasi</li>
                                <li>Atau masukkan koordinat manual dari Google Maps</li>
                                <li>Atur radius sesuai kebutuhan</li>
                            </ol>
                        </div>
                    </div>
                </div>

                <!-- Map -->
                <div class="mt-4">
                    <label class="block text-sm font-medium text-slate-700 mb-2">Pilih Lokasi di Peta</label>
                    <div id="map" class="w-full h-96 rounded-lg border border-slate-300"></div>
                </div>
            </div>

            <!-- Jadwal Absen -->
            <div class="bg-white border border-slate-200 rounded-xl p-6 mb-6">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 bg-primary/10 rounded-lg flex items-center justify-center">
                        <span class="material-icons text-primary">schedule</span>
                    </div>
                    <div>
                        <h3 class="font-bold text-lg">Jadwal Absen</h3>
                        <p class="text-sm text-slate-500">Atur waktu absen pagi dan malam</p>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="p-4 border border-slate-200 rounded-lg">
                        <h4 class="font-semibold text-slate-900 mb-3 flex items-center gap-2">
                            <span class="material-icons text-amber-500 text-sm">wb_sunny</span>
                            Absen Pagi (Masuk)
                        </h4>
                        <div class="space-y-3">
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-2">Jam Mulai</label>
                                <input type="time" name="morning_start" value="{{ old('morning_start', $settings['morning_start']) }}" required class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-2">Jam Selesai</label>
                                <input type="time" name="morning_end" value="{{ old('morning_end', $settings['morning_end']) }}" required class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                            </div>
                        </div>
                    </div>

                    <div class="p-4 border border-slate-200 rounded-lg">
                        <h4 class="font-semibold text-slate-900 mb-3 flex items-center gap-2">
                            <span class="material-icons text-indigo-500 text-sm">nights_stay</span>
                            Absen Malam (Shift Malam)
                        </h4>
                        <div class="space-y-3">
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-2">Jam Mulai</label>
                                <input type="time" name="night_start" value="{{ old('night_start', $settings['night_start']) }}" required class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-2">Jam Selesai</label>
                                <input type="time" name="night_end" value="{{ old('night_end', $settings['night_end']) }}" required class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                            </div>
                        </div>
                    </div>

                    <div class="p-4 border border-slate-200 rounded-lg">
                        <h4 class="font-semibold text-slate-900 mb-3 flex items-center gap-2">
                            <span class="material-icons text-green-500 text-sm">logout</span>
                            Absen Pulang (Checkout)
                        </h4>
                        <div class="space-y-3">
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-2">Jam Mulai</label>
                                <input type="time" name="checkout_start" value="{{ old('checkout_start', $settings['checkout_start']) }}" required class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-2">Jam Selesai</label>
                                <input type="time" name="checkout_end" value="{{ old('checkout_end', $settings['checkout_end']) }}" required class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <button type="submit" class="flex items-center gap-2 px-6 py-2 bg-primary text-white rounded-lg hover:bg-primary/90 transition-colors">
                    <span class="material-icons text-sm">save</span>
                    Simpan Pengaturan
                </button>
            </div>
        </form>
    </div>
</main>

<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
    const LOCATIONIQ_TOKEN = 'pk.eafc06fe84ce14b24d54041aca83ce40';
    
    // Get initial values
    let lat = parseFloat(document.querySelector('input[name="office_latitude"]').value) || -6.200000;
    let lng = parseFloat(document.querySelector('input[name="office_longitude"]').value) || 106.816666;
    let radius = parseInt(document.querySelector('input[name="attendance_radius"]').value) || 100;
    
    // Round coordinates before form submit
    document.getElementById('settingsForm').addEventListener('submit', function(e) {
        const latInput = document.querySelector('input[name="office_latitude"]');
        const lngInput = document.querySelector('input[name="office_longitude"]');
        
        // Round to 6 decimal places
        latInput.value = parseFloat(latInput.value).toFixed(6);
        lngInput.value = parseFloat(lngInput.value).toFixed(6);
    });
    
    // Initialize map
    const map = L.map('map').setView([lat, lng], 16);
    
    // Add LocationIQ tile layer
    L.tileLayer('https://{s}-tiles.locationiq.com/v3/streets/r/{z}/{x}/{y}.png?key=' + LOCATIONIQ_TOKEN, {
        attribution: '&copy; <a href="https://locationiq.com">LocationIQ</a>',
        maxZoom: 19
    }).addTo(map);
    
    // Add marker
    let marker = L.marker([lat, lng], {
        draggable: true
    }).addTo(map);
    
    // Add circle for radius
    let circle = L.circle([lat, lng], {
        color: '#DC2626',
        fillColor: '#DC2626',
        fillOpacity: 0.2,
        radius: radius
    }).addTo(map);
    
    // Update inputs when marker is dragged
    marker.on('dragend', function(e) {
        const position = marker.getLatLng();
        updateLocation(position.lat, position.lng);
    });
    
    // Update location on map click
    map.on('click', function(e) {
        updateLocation(e.latlng.lat, e.latlng.lng);
    });
    
    // Update radius when input changes
    document.querySelector('input[name="attendance_radius"]').addEventListener('input', function(e) {
        radius = parseInt(e.target.value) || 100;
        circle.setRadius(radius);
    });
    
    // Update map when lat/lng inputs change
    document.querySelector('input[name="office_latitude"]').addEventListener('change', function(e) {
        lat = parseFloat(e.target.value);
        if (!isNaN(lat)) {
            marker.setLatLng([lat, lng]);
            circle.setLatLng([lat, lng]);
            map.setView([lat, lng]);
        }
    });
    
    document.querySelector('input[name="office_longitude"]').addEventListener('change', function(e) {
        lng = parseFloat(e.target.value);
        if (!isNaN(lng)) {
            marker.setLatLng([lat, lng]);
            circle.setLatLng([lat, lng]);
            map.setView([lat, lng]);
        }
    });
    
    function updateLocation(newLat, newLng) {
        lat = newLat;
        lng = newLng;
        
        // Update marker and circle
        marker.setLatLng([lat, lng]);
        circle.setLatLng([lat, lng]);
        
        // Update input fields with rounded values (6 decimal places = ~0.11m accuracy)
        document.querySelector('input[name="office_latitude"]').value = lat.toFixed(6);
        document.querySelector('input[name="office_longitude"]').value = lng.toFixed(6);
        
        // Reverse geocoding to get address
        fetch(`https://us1.locationiq.com/v1/reverse?key=${LOCATIONIQ_TOKEN}&lat=${lat}&lon=${lng}&format=json`)
            .then(response => response.json())
            .then(data => {
                if (data.display_name) {
                    document.querySelector('input[name="office_address"]').value = data.display_name;
                }
            })
            .catch(error => console.error('Geocoding error:', error));
    }
</script>

</body>
</html>
