<x-app-layout>
    <div class="relative min-h-screen overflow-hidden">
    {{-- photo background with dark overlay --}}
    <div class="absolute inset-0">
        <img src="{{ asset('images/coachesbackground.jpg') }}" alt="" class="w-full h-full object-cover opacity-100">
        <div class="absolute inset-0 bg-[#151515]/80"></div>
    </div>
    <div class="relative z-10 max-w-5xl mx-auto px-6 py-20">
            <h1 class="text-[#F5F5F5] font-bold uppercase text-4xl mb-6" style="font-family: 'Oswald', sans-serif;">
                Book a Coach or Personal Assistant
            </h1>
            <p class="text-[#8A8A8A] text-lg mb-8">
                Members under 15 must be accompanied by a coach or personal assistant. Please book one below to continue your registration.
            </p>

            <form id="book-coach-form" class="space-y-4">
                <div>
                    <label class="block text-[#F5F5F5] uppercase text-sm font-bold mb-1">Parent/Guardian Name</label>
                    <input type="text" class="w-full bg-[#232323] border border-[#2a2a2a] text-[#F5F5F5] p-3 rounded">
                </div>
                <div>
                    <label class="block text-[#F5F5F5] uppercase text-sm font-bold mb-1">Preferred Coach</label>
                    <select name="coach_id" class="w-full bg-[#232323] border border-[#2a2a2a] text-[#F5F5F5] p-3 rounded">
                        <option value="">-- Select a coach --</option>
                        @foreach (\App\Models\Coach::all() as $coach)
                            <option value="{{ $coach->id }}">{{ $coach->name }} ({{ $coach->specialty }})</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="bg-[#CFFF04] text-[#151515] font-bold uppercase px-8 py-3 rounded hover:bg-[#e2ff4d] transition-colors">
                    Confirm Booking
                </button>
            </form>
        </div>
    </div>
    <script>
    document.getElementById('book-coach-form').addEventListener('submit', function (e) {
        e.preventDefault();
        window.location.href = "/offres";
    });
    </script>
</x-app-layout>