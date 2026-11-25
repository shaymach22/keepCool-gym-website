<x-app-layout>
  <div class="relative min-h-screen overflow-hidden">

    {{-- photo background with dark overlay --}}
    <div class="absolute inset-0">
        <img src="{{ asset('images/coachesbackground.jpg') }}" alt="" class="w-full h-full object-cover opacity-100">
        <div class="absolute inset-0 bg-[#151515]/80"></div>
    </div>

    <div class="relative z-10 max-w-3xl mx-auto px-6 py-20">

        <h1 class="text-[#F5F5F5] font-bold uppercase text-3xl mb-10" style="font-family: 'Oswald', sans-serif;">
            Gym Playlist
        </h1>

        @auth
            <form method="POST" action="/playlist" class="flex gap-3 mb-4">
                @csrf
                <input type="text" name="title" placeholder="Song title" class="flex-1 bg-[#232323] border border-[#2a2a2a] text-[#F5F5F5] p-3 rounded" value="{{ old('title') }}">
                <input type="text" name="artist" placeholder="Artist" class="flex-1 bg-[#232323] border border-[#2a2a2a] text-[#F5F5F5] p-3 rounded" value="{{ old('artist') }}">
                <button type="submit" class="bg-[#CFFF04] text-[#151515] font-bold uppercase px-6 py-3 rounded hover:bg-[#e2ff4d] transition-colors">
                    Add
                </button>
            </form>
            @error('title') <p class="text-red-400 text-sm mb-4">{{ $message }}</p> @enderror
            @error('artist') <p class="text-red-400 text-sm mb-4">{{ $message }}</p> @enderror
        @else
            <p class="text-[#8A8A8A] mb-10">
                <a href="/login" class="text-[#CFFF04] underline">Log in</a> to suggest a song or vote.
            </p>
        @endauth

        <div class="mt-6">
            @forelse ($songs as $song)
                <div class="bg-[#232323] border-l-2 border-[#CFFF04] p-4 mb-3 flex items-center justify-between">
                    <div>
                        <p class="text-[#F5F5F5] font-bold">{{ $song->title }}</p>
                        <p class="text-[#8A8A8A] text-sm">{{ $song->artist }}</p>
                    </div>

                    <div class="flex items-center gap-3">
                        <span class="text-[#CFFF04] font-bold">{{ $song->votes_count }}</span>

                        @auth
                            <form method="POST" action="/playlist/{{ $song->id }}/vote">
                                @csrf
                                <button type="submit" class="bg-[#2a2a2a] text-[#F5F5F5] text-sm font-bold uppercase px-3 py-1.5 rounded hover:bg-[#CFFF04] hover:text-[#151515] transition-colors">
                                    Vote
                                </button>
                            </form>

                            @if ($song->user_id === auth()->id())
                                <form id="delete-form-{{ $song->id }}" method="POST" action="/playlist/{{ $song->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" onclick="openDeleteModal('{{ $song->id }}', '{{ $song->title }}')" class="text-red-400 text-sm font-bold uppercase hover:underline">
                                        Delete
                                    </button>
                                </form>
                            @endif
                        @endauth
                    </div>
                </div>
            @empty
                <p class="text-[#8A8A8A]">No songs suggested yet. Be the first!</p>
            @endforelse
        </div>

    </div>
  </div>

    {{-- DELETE CONFIRMATION MODAL --}}
    <div id="delete-modal" class="hidden fixed inset-0 bg-black/80 z-50 items-center justify-center p-6">
        <div class="bg-[#232323] border-t-4 border-[#CFFF04] rounded p-8 max-w-sm w-full">
            <h3 class="text-[#F5F5F5] font-bold uppercase text-lg mb-2" style="font-family: 'Oswald', sans-serif;">
                Delete Song
            </h3>
            <p class="text-[#8A8A8A] mb-6">
                Are you sure you want to remove <span id="delete-song-name" class="text-[#F5F5F5] font-semibold"></span> from the playlist?
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

        function openDeleteModal(songId, songTitle) {
            formToDelete = document.getElementById('delete-form-' + songId);
            document.getElementById('delete-song-name').textContent = songTitle;
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