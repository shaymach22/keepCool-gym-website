<x-app-layout>
  <div class="relative min-h-screen overflow-hidden">

    {{-- photo background with dark overlay --}}
    <div class="absolute inset-0">
        <img src="{{ asset('images/coachesbackground.jpg') }}" alt="" class="w-full h-full object-cover opacity-100">
        <div class="absolute inset-0 bg-[#151515]/80"></div>
    </div>

    <div class="relative z-10 max-w-7xl mx-auto px-6 py-20">

        <div class="flex justify-between items-end mb-10 border-b border-[#2a2a2a] pb-4">
            <h1 class="text-[#F5F5F5] font-bold uppercase text-3xl" style="font-family: 'Oswald', sans-serif;">
                Our Coaches
            </h1>
            @if (auth()->check() && auth()->user()->role === 'admin')
            <a href="/coaches/create" class="bg-[#CFFF04] text-[#151515] font-bold uppercase text-sm px-5 py-2.5 rounded hover:bg-[#e2ff4d] transition-colors">
                Add Coach
            </a>
            @endif
        </div>

        @forelse ($coaches as $coach)
            <div class="bg-[#232323] border-l-2 border-[#CFFF04] p-6 mb-4 flex gap-6 items-start">

                {{-- Left: text info --}}
                <div class="flex-1">
                    <h2 class="text-[#F5F5F5] font-bold uppercase text-xl" style="font-family: 'Oswald', sans-serif;">
                        {{ $coach->name }}
                    </h2>
                    <p class="text-[#CFFF04] text-sm uppercase tracking-wide mt-1">
                        {{ $coach->specialty }}
                    </p>
                    <p class="text-[#8A8A8A] mt-3">
                        {{ $coach->bio }}
                    </p>
                    @if (auth()->check() && auth()->user()->role === 'admin')
                    <div class="mt-4 flex gap-4">
                        <a href="/coaches/{{ $coach->id }}/edit" class="text-[#CFFF04] text-sm font-bold uppercase tracking-wide hover:underline">
                            Edit
                        </a>
                        

                        <form id="delete-form-{{ $coach->id }}" method="POST" action="/coaches/{{ $coach->id }}" class="inline-flex items-center">
                            @csrf
                            @method('DELETE')
                            <button type="button" onclick="openDeleteModal('{{ $coach->id }}', '{{ $coach->name }}')" class="text-red-400 text-sm font-bold uppercase tracking-wide hover:underline">
                                Delete
                            </button>
                        </form>
                        
                    </div>
                    @endif
                </div>
                {{-- Right: small photo box --}}
               <div class="w-32 shrink-0 flex flex-col items-center gap-2 self-stretch">
    @if ($coach->photo)
        <img src="{{ asset('storage/' . $coach->photo) }}" alt="{{ $coach->name }}" class="w-32 h-32 object-cover rounded">
    @endif

    @if ($coach->phone)
        <a href="https://wa.me/{{ $coach->phone }}" target="_blank" class="mt-auto inline-flex items-center gap-2 text-[#25D366] hover:text-[#1ebe57] transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20" fill="currentColor">
                <path d="M17.6 6.32A7.85 7.85 0 0 0 12.05 4a7.94 7.94 0 0 0-6.9 11.9L4 20l4.2-1.1a7.9 7.9 0 0 0 3.85 1h.01a7.94 7.94 0 0 0 5.54-13.58zM12.06 18.4a6.57 6.57 0 0 1-3.36-.92l-.24-.14-2.5.66.67-2.44-.16-.25a6.6 6.6 0 1 1 5.6 3.1zm3.6-4.94c-.2-.1-1.17-.58-1.35-.64s-.32-.1-.45.1-.5.64-.62.77-.23.15-.43.05a5.4 5.4 0 0 1-1.6-.98 6 6 0 0 1-1.1-1.37c-.12-.2 0-.3.09-.4.09-.1.2-.24.3-.36.1-.12.13-.2.2-.34.06-.13.03-.25 0-.35s-.45-1.1-.62-1.5c-.16-.4-.33-.34-.45-.34h-.38a.73.73 0 0 0-.53.25 2.24 2.24 0 0 0-.7 1.66 3.9 3.9 0 0 0 .82 2.06 8.9 8.9 0 0 0 3.42 3.02c.48.2.85.33 1.14.42.48.15.92.13 1.26.08.38-.06 1.17-.48 1.34-.94.16-.46.16-.85.12-.94-.05-.1-.19-.15-.4-.25z"/>
            </svg>
            <span class="text-sm font-bold">Contact</span>
        </a>
    @endif
</div>
        @empty
            <p class="text-[#8A8A8A]">No coaches added yet.</p>
        @endforelse

    </div>
  </div>

    {{-- DELETE CONFIRMATION MODAL --}}
    <div id="delete-modal" class="hidden fixed inset-0 bg-black/80 z-50 items-center justify-center p-6">
        <div class="bg-[#232323] border-t-4 border-[#CFFF04] rounded p-8 max-w-sm w-full">
            <h3 class="text-[#F5F5F5] font-bold uppercase text-lg mb-2" style="font-family: 'Oswald', sans-serif;">
                Delete Coach
            </h3>
            <p class="text-[#8A8A8A] mb-6">
                Are you sure you want to delete <span id="delete-coach-name" class="text-[#F5F5F5] font-semibold"></span>? This can't be undone.
            </p>
            <div class="flex gap-3">
                <button onclick="closeDeleteModal()" class="flex-1 bg-[#2a2a2a] text-[#F5F5F5] font-bold uppercase text-sm py-2.5 rounded hover:bg-[#3a3a3a] transition-colors">
                    Cancel
                </button>
                <button onclick="confirmDelete()" class="flex-1 bg-red-500 text-white font-bold uppercase text-sm py-2.5 rounded hover:bg-red-600 transition-colors">
                    Delete
                </button>
            </div>
        </div>
    </div>

    <script>
        let formToDelete = null;

        function openDeleteModal(coachId, coachName) {
            formToDelete = document.getElementById('delete-form-' + coachId);
            document.getElementById('delete-coach-name').textContent = coachName;
            const modal = document.getElementById('delete-modal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeDeleteModal() {
            const modal = document.getElementById('delete-modal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            formToDelete = null;
        }

        function confirmDelete() {
            if (formToDelete) {
                formToDelete.submit();
            }
        }
    </script>
</x-app-layout>