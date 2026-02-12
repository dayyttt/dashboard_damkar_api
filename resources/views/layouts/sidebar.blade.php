<!-- Sidebar Navigation -->
<aside class="w-64 border-r border-slate-200 bg-white flex flex-col h-full">
    <div class="p-6 flex items-center gap-3">
        <div class="w-8 h-8 bg-primary rounded-lg flex items-center justify-center">
            <span class="material-icons text-white text-xl">local_fire_department</span>
        </div>
        <span class="font-bold text-xl tracking-tight">Damkar Merangin</span>
    </div>
    
    <nav class="flex-1 px-4 space-y-1">
        <a class="flex items-center gap-3 px-3 py-2 {{ request()->routeIs('dashboard') ? 'text-primary bg-primary/10' : 'text-slate-500 hover:text-primary hover:bg-slate-50' }} rounded-lg font-medium transition-colors" href="{{ route('dashboard') }}">
            <span class="material-icons">dashboard</span>
            Dashboard
        </a>
        <a class="flex items-center gap-3 px-3 py-2 {{ request()->routeIs('sectors.*') ? 'text-primary bg-primary/10' : 'text-slate-500 hover:text-primary hover:bg-slate-50' }} rounded-lg font-medium transition-colors" href="{{ route('sectors.index') }}">
            <span class="material-icons">map</span>
            Sektor
        </a>
        <a class="flex items-center gap-3 px-3 py-2 {{ request()->routeIs('regu.*') ? 'text-primary bg-primary/10' : 'text-slate-500 hover:text-primary hover:bg-slate-50' }} rounded-lg font-medium transition-colors" href="{{ route('regu.index') }}">
            <span class="material-icons">groups</span>
            Regu
        </a>
        <a class="flex items-center gap-3 px-3 py-2 {{ request()->routeIs('members.*') ? 'text-primary bg-primary/10' : 'text-slate-500 hover:text-primary hover:bg-slate-50' }} rounded-lg font-medium transition-colors" href="{{ route('members.index') }}">
            <span class="material-icons">person</span>
            Anggota
        </a>
        <a class="flex items-center gap-3 px-3 py-2 {{ request()->routeIs('reports.*') ? 'text-primary bg-primary/10' : 'text-slate-500 hover:text-primary hover:bg-slate-50' }} rounded-lg font-medium transition-colors" href="{{ route('reports.index') }}">
            <span class="material-icons">assignment</span>
            Laporan
        </a>
        <a class="flex items-center gap-3 px-3 py-2 {{ request()->routeIs('manual-attendance.*') ? 'text-primary bg-primary/10' : 'text-slate-500 hover:text-primary hover:bg-slate-50' }} rounded-lg font-medium transition-colors" href="{{ route('manual-attendance.index') }}">
            <span class="material-icons">edit_calendar</span>
            Kelola Absensi
        </a>
        <a class="flex items-center justify-between px-3 py-2 {{ request()->routeIs('fake-gps-logs.*') ? 'text-primary bg-primary/10' : 'text-slate-500 hover:text-primary hover:bg-slate-50' }} rounded-lg font-medium transition-colors" href="{{ route('fake-gps-logs.index') }}">
            <div class="flex items-center gap-3">
                <span class="material-icons">security</span>
                Log Fake GPS
            </div>
            @php
                $unreadCount = \App\Models\FakeGpsLog::where('is_read', false)->count();
            @endphp
            @if($unreadCount > 0)
            <span class="px-2 py-0.5 bg-red-500 text-white text-xs font-bold rounded-full min-w-[20px] text-center">
                {{ $unreadCount > 99 ? '99+' : $unreadCount }}
            </span>
            @endif
        </a>
    </nav>
    
    <div class="p-4 border-t border-slate-200">
        <a class="flex items-center gap-3 px-3 py-2 {{ request()->routeIs('settings.*') ? 'text-primary bg-primary/10' : 'text-slate-500 hover:text-slate-900' }} rounded-lg font-medium transition-colors" href="{{ route('settings.index') }}">
            <span class="material-icons text-sm">settings</span>
            Pengaturan
        </a>
        <div class="mt-4 flex items-center gap-3 px-3">
            <div class="w-8 h-8 rounded-full border-2 border-primary/20 bg-primary text-white flex items-center justify-center font-bold text-sm">
                {{ substr(Auth::user()->name, 0, 1) }}
            </div>
            <div class="overflow-hidden flex-1">
                <p class="text-xs font-bold truncate">{{ Auth::user()->name }}</p>
                <p class="text-[10px] text-slate-500 truncate">Administrator</p>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-slate-400 hover:text-primary transition-colors">
                    <span class="material-icons text-sm">logout</span>
                </button>
            </form>
        </div>
    </div>
</aside>
