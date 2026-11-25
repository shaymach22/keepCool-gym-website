<x-app-layout>
   <div class="relative min-h-screen overflow-hidden">

    {{-- photo background with dark overlay --}}
    <div class="absolute inset-0">
        <img src="{{ asset('images/coachesbackground.jpg') }}" alt="" class="w-full h-full object-cover opacity-100">
        <div class="absolute inset-0 bg-[#151515]/80"></div>
    </div>

    <div class="relative z-10 max-w-7xl mx-auto px-6 py-20">
            <h1 class="text-[#F5F5F5] font-bold uppercase text-3xl mb-10" style="font-family: 'Oswald', sans-serif;">
                Edit Coach
            </h1>

            <form method="POST" action="/coaches/{{ $coach->id }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="flex gap-6 mb-4">

                    {{-- Left column: main fields --}}
                    <div class="flex-1 space-y-4">
                        <div>
                            <label class="block text-[#F5F5F5] uppercase text-sm font-bold mb-1">Name</label>
                            <input type="text" name="name" class="w-full bg-[#232323] border border-[#2a2a2a] text-[#F5F5F5] p-3 rounded" value="{{ old('name', $coach->name) }}">
                            @error('name') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-[#F5F5F5] uppercase text-sm font-bold mb-1">Specialty</label>
                            <input type="text" name="specialty" class="w-full bg-[#232323] border border-[#2a2a2a] text-[#F5F5F5] p-3 rounded" value="{{ old('specialty', $coach->specialty) }}">
                            @error('specialty') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                             <label class="block text-[#F5F5F5] uppercase text-sm font-bold mb-1">WhatsApp Number</label>
                             <input type="text" name="phone" class="w-full bg-[#232323] border border-[#2a2a2a] text-[#F5F5F5] p-3 rounded" value="{{ old('phone', $coach->phone) }}">
                              @error('phone') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    {{-- Right column: current photo + upload new one --}}
                    <div class="w-40 shrink-0">
                        @if ($coach->photo)
                            <img src="{{ asset('storage/' . $coach->photo) }}" alt="{{ $coach->name }}" class="w-full h-32 object-cover rounded mb-2">

                            <form method="POST" action="/coaches/{{ $coach->id }}/photo" onsubmit="return confirm('Remove this photo?');">
                             @csrf
                             @method('DELETE')
                            <button type="submit" class="text-red-400 text-xs font-bold uppercase hover:underline mb-2">
                             Remove Photo
                            </button>
                            </form>
                        @endif
                        
                        <label class="block text-[#F5F5F5] uppercase text-sm font-bold mb-1">Photo</label>
                        <div class="bg-[#232323] border border-[#2a2a2a] rounded p-3">
                            <input type="file" name="photo" accept="image/*" class="w-full text-xs text-[#8A8A8A]">
                        </div>
                        @error('photo') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                        
                    </div>

                </div>

                <div class="mb-6">
                    <label class="block text-[#F5F5F5] uppercase text-sm font-bold mb-1">Bio</label>
                    <textarea name="bio" class="w-full bg-[#232323] border border-[#2a2a2a] text-[#F5F5F5] p-3 rounded" rows="4">{{ old('bio', $coach->bio) }}</textarea>
                    @error('bio') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <button type="submit" class="bg-[#CFFF04] text-[#151515] font-bold uppercase px-8 py-3 rounded hover:bg-[#e2ff4d] transition-colors">
                    Update Coach
                </button>
            </form>
        </div>
    </div>
</x-app-layout>