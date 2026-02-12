<!-- Top Header -->
<header class="h-16 border-b border-slate-200 bg-white backdrop-blur-md flex items-center justify-between px-8 shrink-0 relative z-50">
    <div class="flex items-center flex-1 max-w-xl">
        <div class="relative w-full" x-data="searchComponent()">
            <form action="{{ route('search') }}" method="GET">
                <span class="material-icons absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-sm pointer-events-none">search</span>
                <input 
                    name="q" 
                    x-model="query"
                    @input.debounce.300ms="search()"
                    @focus="showResults = true"
                    @click.away="showResults = false"
                    class="w-full pl-10 pr-4 py-2 bg-slate-100 border-none rounded-lg text-sm focus:ring-2 focus:ring-primary transition-all" 
                    placeholder="Cari sektor, regu, atau anggota..." 
                    type="text"
                    autocomplete="off"
                />
            </form>
            
            <!-- Dropdown Results -->
            <div 
                x-show="showResults && (members.length > 0 || sectors.length > 0 || (query.length > 0 && !loading))"
                x-transition
                class="fixed mt-2 bg-white border border-slate-200 rounded-lg shadow-2xl max-h-96 overflow-y-auto"
                style="z-index: 99999; width: 600px; left: 2rem; top: 4rem;"
                @click.away="showResults = false"
            >
                <!-- Loading -->
                <div x-show="loading" class="p-4 text-center text-sm text-slate-500">
                    <span class="material-icons animate-spin">refresh</span>
                    Mencari...
                </div>
                
                <!-- Sectors -->
                <template x-if="sectors.length > 0">
                    <div class="border-b border-slate-200">
                        <div class="px-4 py-2 bg-slate-50 text-xs font-bold text-slate-700 uppercase">Sektor</div>
                        <template x-for="sector in sectors" :key="sector.id">
                            <a :href="`/sectors/${sector.id}`" class="flex items-center gap-3 px-4 py-3 hover:bg-slate-50 transition-colors">
                                <div class="w-10 h-10 bg-primary/10 rounded-lg flex items-center justify-center">
                                    <span class="material-icons text-primary text-sm" x-text="sector.icon"></span>
                                </div>
                                <div>
                                    <p class="font-medium text-sm" x-text="sector.name"></p>
                                    <p class="text-xs text-slate-500" x-text="sector.location"></p>
                                </div>
                            </a>
                        </template>
                    </div>
                </template>
                
                <!-- Members -->
                <template x-if="members.length > 0">
                    <div>
                        <div class="px-4 py-2 bg-slate-50 text-xs font-bold text-slate-700 uppercase">Anggota</div>
                        <template x-for="member in members" :key="member.id">
                            <a :href="`/members/${member.id}`" class="flex items-center gap-3 px-4 py-3 hover:bg-slate-50 transition-colors">
                                <div class="w-10 h-10 rounded-full bg-primary/10 text-primary flex items-center justify-center font-bold text-xs" x-text="member.name.substring(0, 2)"></div>
                                <div class="flex-1">
                                    <p class="font-medium text-sm" x-text="member.name"></p>
                                    <p class="text-xs text-slate-500">
                                        <span x-text="member.jabatan"></span> - 
                                        <span x-text="member.sector_name"></span> - 
                                        Regu <span x-text="member.regu"></span>
                                    </p>
                                </div>
                            </a>
                        </template>
                    </div>
                </template>
                
                <!-- No Results -->
                <div x-show="!loading && query.length > 0 && members.length === 0 && sectors.length === 0" class="p-4 text-center text-sm text-slate-500">
                    Tidak ada hasil untuk "<span x-text="query"></span>"
                </div>
                
                <!-- View All -->
                <template x-if="(members.length > 0 || sectors.length > 0) && query.length > 0">
                    <div class="border-t border-slate-200 p-2">
                        <a :href="`/search?q=${query}`" class="block text-center text-sm text-primary hover:text-primary/80 font-medium py-2">
                            Lihat Semua Hasil →
                        </a>
                    </div>
                </template>
            </div>
        </div>
    </div>
    <div class="flex items-center gap-4">
        <div class="text-sm text-slate-600">
            <span class="font-medium">{{ now()->isoFormat('dddd, D MMMM Y') }}</span>
        </div>
        <a href="{{ route('dashboard') }}" class="flex items-center gap-2 px-4 py-2 bg-slate-100 hover:bg-slate-200 rounded-lg text-sm font-medium transition-colors">
            <span class="material-icons text-sm">dashboard</span>
            Dashboard
        </a>
    </div>
</header>

<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<script>
function searchComponent() {
    return {
        query: '',
        members: [],
        sectors: [],
        loading: false,
        showResults: false,
        
        async search() {
            if (this.query.length < 2) {
                this.members = [];
                this.sectors = [];
                return;
            }
            
            this.loading = true;
            
            try {
                const response = await fetch(`/api/search?q=${encodeURIComponent(this.query)}`);
                const data = await response.json();
                
                this.members = data.members || [];
                this.sectors = data.sectors || [];
            } catch (error) {
                console.error('Search error:', error);
            } finally {
                this.loading = false;
            }
        }
    }
}
</script>
