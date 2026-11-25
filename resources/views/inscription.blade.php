<x-app-layout>
  <div class="relative min-h-screen overflow-hidden">

    {{-- photo background with dark overlay --}}
    <div class="absolute inset-0">
        <img src="{{ asset('images/coachesbackground.jpg') }}" alt="" class="w-full h-full object-cover opacity-100">
        <div class="absolute inset-0 bg-[#151515]/80"></div>
    </div>

    <div class="relative z-10 max-w-3xl mx-auto px-6 py-20">

    <div class="relative z-10 max-w-3xl mx-auto px-6 py-20">
            <h1 class="text-[#F5F5F5] font-bold uppercase text-4xl mb-6" style="font-family: 'Oswald', sans-serif;">
                Sign Up
            </h1>
            <p class="text-[#8A8A8A] text-lg mb-8">
                Join the gym today. Fill out the form below to get started.
            </p>

            <form method="POST" action="/inscription" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-[#F5F5F5] uppercase text-sm font-bold mb-1">Name</label>
                    <input type="text" name="name" min="1" max="120" required class="w-full bg-[#232323] border border-[#2a2a2a] text-[#F5F5F5] p-3 rounded">
                </div>
                <div>
                    <label class="block text-[#F5F5F5] uppercase text-sm font-bold mb-1">Age</label>
                    <input type="number" name="age" required class="w-full bg-[#232323] border border-[#2a2a2a] text-[#F5F5F5] p-3 rounded">
                    @error('age') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-[#F5F5F5] uppercase text-sm font-bold mb-1">Date joined</label>
                    <input type="date" name="datej"  required class="w-full bg-[#232323] border border-[#2a2a2a] text-[#F5F5F5] p-3 rounded">
                </div>
                <div>
                    <label class="block text-[#F5F5F5] uppercase text-sm font-bold mb-1">Training Focus</label>
                    <select name="training_focus" class="w-full bg-[#232323] border border-[#2a2a2a] text-[#F5F5F5] p-3 rounded">
                        <option value="">-- Select your training focus --</option>
                        <option value="Bodybuilding">Bodybuilding</option>
                        <option value="Powerlifting">Powerlifting</option>
                        <option value="CrossFit">CrossFit</option>
                        <option value="Yoga">Yoga</option>
                        <option value="Boxing">Boxing</option>
                    </select>
                </div>
                <button type="submit" class="bg-[#CFFF04] text-[#151515] font-bold uppercase px-8 py-3 rounded hover:bg-[#e2ff4d] transition-colors">
                    Submit
                </button>
            </form>
        </div>
    </div>
</x-app-layout>