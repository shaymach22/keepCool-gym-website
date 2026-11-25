<x-app-layout>
    <div class="bg-[#151515] min-h-screen">

        {{-- Keep Cool Gym --}}
        <div class="relative overflow-hidden border-b border-[#2a2a2a]">
            <div class="max-w-7xl mx-auto px-6 py-24 relative z-10">
                <div class="inline-block bg-[#CFFF04] text-[#151515] px-3 py-1 text-xs font-bold uppercase tracking-widest mb-6"
                     style="clip-path: polygon(4% 0, 100% 0, 96% 100%, 0% 100%);">
                    Open 7 days a week
                </div>

                <h1 class="text-[#F5F5F5] font-bold uppercase leading-[0.95] mb-6"
                    style="font-family: 'Oswald', sans-serif; font-size: clamp(2.5rem, 7vw, 5.5rem);">
                    Stay Strong.<br>
                    <span class="text-[#CFFF04]">stay fit.</span>
                </h1>

                <p class="text-[#8A8A8A] text-lg max-w-xl mb-8">
                Push beyond your limits.
                </p>

                <a href="/inscription" class="inline-block bg-[#CFFF04] text-[#151515] font-bold uppercase tracking-wide px-8 py-4 hover:bg-[#e2ff4d] transition-colors">
                    Join us now →
                </a>
            </div>

          {{-- photo background with dark overlay for text readability --}}
          <div class="absolute inset-0 pointer-events-none">
         <img src="{{ asset('images/gymbackground.jfif') }}" alt="" class="w-full h-full object-cover [object-position:50%_25%]  opacity-45">
    <div class="absolute inset-0 bg-gradient-to-r from-[#151515] via-[#151515]/60 to-transparent"></div>
    <div class="absolute inset-0 bg-gradient-to-t from-[#151515]/40 via-transparent to-transparent"></div>
</div>
</div>
        {{-- COACHES --}}
        <div class="max-w-7xl mx-auto px-6 py-20">
            <div class="flex justify-between items-end mb-10 border-b border-[#2a2a2a] pb-4">
                <h2 class="text-[#F5F5F5] font-bold uppercase text-3xl" style="font-family: 'Oswald', sans-serif;">
                    Our Coaches
                </h2>
                <a href="/coaches" class="text-[#CFFF04] uppercase text-sm font-bold tracking-wide hover:underline">
                    View all
                </a>
            </div>

            @forelse ($coaches as $coach)
                <div class="grid md:grid-cols-3 gap-4 mb-4">
                    <div class="bg-[#232323] border-l-2 border-[#CFFF04] p-6 md:col-span-1">
                        <h3 class="text-[#F5F5F5] font-bold uppercase text-lg" style="font-family: 'Oswald', sans-serif;">
                            {{ $coach->name }}
                        </h3>
                        <p class="text-[#CFFF04] text-sm uppercase tracking-wide mt-1">
                            {{ $coach->specialty }}
                        </p>
                    </div>
                </div>
            @empty
                <p class="text-[#8A8A8A]">No coaches added yet.</p>
            @endforelse
        </div>

        {{-- EVENTS --}}
        <div class="max-w-7xl mx-auto px-6 py-20 border-t border-[#2a2a2a]">
            <div class="flex justify-between items-end mb-10 border-b border-[#2a2a2a] pb-4">
                <h2 class="text-[#F5F5F5] font-bold uppercase text-3xl" style="font-family: 'Oswald', sans-serif;">
                    Upcoming Events
                </h2>
                <a href="/events" class="text-[#CFFF04] uppercase text-sm font-bold tracking-wide hover:underline">
                    View all
                </a>
            </div>

            @forelse ($events as $event)
                <div class="flex items-center gap-6 bg-[#232323] p-6 mb-4">
                    <div class="text-[#CFFF04] font-bold uppercase text-center leading-tight shrink-0" style="font-family: 'Oswald', sans-serif;">
                        <div class="text-2xl">{{ \Illuminate\Support\Carbon::parse($event->event_date)->format('d') }}</div>
                        <div class="text-xs">{{ \Illuminate\Support\Carbon::parse($event->event_date)->format('M') }}</div>
                    </div>
                    <div>
                        <h3 class="text-[#F5F5F5] font-bold uppercase" style="font-family: 'Oswald', sans-serif;">
                            {{ $event->title }}
                        </h3>
                        <p class="text-[#8A8A8A] text-sm mt-1">
                            {{ $event->event_time }} — {{ $event->location }}
                        </p>
                    </div>
                </div>
            @empty
                <p class="text-[#8A8A8A]">No events scheduled yet.</p>
            @endforelse
        </div>
         {{-- GALLERY --}}
        <div class="max-w-7xl mx-auto px-6 py-20 border-t border-[#2a2a2a]">
            <div class="mb-10 border-b border-[#2a2a2a] pb-4">
                <h2 class="text-[#F5F5F5] font-bold uppercase text-3xl" style="font-family: 'Oswald', sans-serif;">
                    Photos
                </h2>
            </div>
 
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                <img src="{{ asset('images/gymphoto1.webp') }}" alt="Gym photo" onclick="openLightbox(this.src)" class="w-full h-80 object-cover rounded cursor-pointer hover:opacity-80 transition-opacity">
                <img src="{{ asset('images/gymphoto2.webp') }}" alt="Gym photo" onclick="openLightbox(this.src)" class="w-full h-80 object-cover rounded cursor-pointer hover:opacity-80 transition-opacity">
                <img src="{{ asset('images/gymphoto3.webp') }}" alt="Gym photo" onclick="openLightbox(this.src)" class="w-full h-80 object-cover rounded cursor-pointer hover:opacity-80 transition-opacity">
                <img src="{{ asset('images/gymphoto4.webp') }}" alt="Gym photo" onclick="openLightbox(this.src)" class="w-full h-80 object-cover rounded cursor-pointer hover:opacity-80 transition-opacity">
                <img src="{{ asset('images/gymphoto5.png') }}" alt="Gym photo" onclick="openLightbox(this.src)" class="w-full h-80 object-cover rounded cursor-pointer hover:opacity-80 transition-opacity">
                <img src="{{ asset('images/gymphoto6.png') }}" alt="Gym photo" onclick="openLightbox(this.src)" class="w-full h-80 object-cover rounded cursor-pointer hover:opacity-80 transition-opacity">
            </div>
        </div>
 
    </div>
 
    {{-- LIGHTBOX OVERLAY --}}
    <div id="lightbox" onclick="closeLightbox()" class="hidden fixed inset-0 bg-black/90 z-50 items-center justify-center p-6 cursor-pointer">
        <img id="lightbox-img" src="" alt="Enlarged gym photo" class="max-w-full max-h-full rounded shadow-2xl">
        <button onclick="closeLightbox()" class="absolute top-6 right-6 text-[#F5F5F5] text-4xl leading-none hover:text-[#CFFF04] transition-colors">&times;</button>
    </div>
 
    <script>
        function openLightbox(src) {
            document.getElementById('lightbox-img').src = src;
            const lightbox = document.getElementById('lightbox');
            lightbox.classList.remove('hidden');
            lightbox.classList.add('flex');
        }
 
        function closeLightbox() {
            const lightbox = document.getElementById('lightbox');
            lightbox.classList.add('hidden');
            lightbox.classList.remove('flex');
        }
    </script>
</x-app-layout>