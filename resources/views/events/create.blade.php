<x-app-layout>
    <div class="relative min-h-screen overflow-hidden">

    {{-- photo background with dark overlay --}}
    <div class="absolute inset-0">
        <img src="{{ asset('images/coachesbackground.jpg') }}" alt="" class="w-full h-full object-cover opacity-100">
        <div class="absolute inset-0 bg-[#151515]/80"></div>
    </div>

    <div class="relative z-10 max-w-7xl mx-auto px-6 py-20">
            <h1 class="text-[#F5F5F5] font-bold uppercase text-3xl mb-10" style="font-family: 'Oswald', sans-serif;">
                Add an Event
            </h1>

            <form method="POST" action="/events">
                @csrf

                <div class="mb-4">
                    <label class="block text-[#F5F5F5] uppercase text-sm font-bold mb-1">Title</label>
                    <input type="text" name="title" class="w-full bg-[#232323] border border-[#2a2a2a] text-[#F5F5F5] p-3 rounded" value="{{ old('title') }}">
                    @error('title') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-[#F5F5F5] uppercase text-sm font-bold mb-1">Description</label>
                    <textarea name="description" class="w-full bg-[#232323] border border-[#2a2a2a] text-[#F5F5F5] p-3 rounded" rows="4">{{ old('description') }}</textarea>
                    @error('description') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-[#F5F5F5] uppercase text-sm font-bold mb-1">Date</label>
                        <input type="date" name="event_date" class="w-full bg-[#232323] border border-[#2a2a2a] text-[#F5F5F5] p-3 rounded [color-scheme:dark]" value="{{ old('event_date') }}">
                        @error('event_date') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-[#F5F5F5] uppercase text-sm font-bold mb-1">Time</label>
                        <input type="time" name="event_time" class="w-full bg-[#232323] border border-[#2a2a2a] text-[#F5F5F5] p-3 rounded [color-scheme:dark]" value="{{ old('event_time') }}">
                        @error('event_time') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-[#F5F5F5] uppercase text-sm font-bold mb-1">Location</label>
                    <input type="text" name="location" class="w-full bg-[#232323] border border-[#2a2a2a] text-[#F5F5F5] p-3 rounded" value="{{ old('location') }}">
                    @error('location') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <button type="submit" class="bg-[#CFFF04] text-[#151515] font-bold uppercase px-8 py-3 rounded hover:bg-[#e2ff4d] transition-colors">
                    Save Event
                </button>
            </form>
        </div>
    </div>
</x-app-layout>