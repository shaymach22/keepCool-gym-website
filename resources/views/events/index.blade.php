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
                    Upcoming Events
                </h1>
                @if (auth()->check() && auth()->user()->role === 'admin')
                <a href="/events/create" class="bg-[#CFFF04] text-[#151515] font-bold uppercase text-sm px-5 py-2.5 rounded hover:bg-[#e2ff4d] transition-colors">
                    Add Event
                </a>
                @endif
            </div>

            @forelse ($events as $event)
                <div class="bg-[#232323] border-l-2 border-[#CFFF04] p-6 mb-4 flex items-center gap-6">

                    <div class="text-[#CFFF04] font-bold uppercase text-center leading-tight shrink-0" style="font-family: 'Oswald', sans-serif;">
                        <div class="text-2xl">{{ \Illuminate\Support\Carbon::parse($event->event_date)->format('d') }}</div>
                        <div class="text-xs">{{ \Illuminate\Support\Carbon::parse($event->event_date)->format('M') }}</div>
                    </div>

                    <div class="flex-1">
                        <h2 class="text-[#F5F5F5] font-bold uppercase text-xl" style="font-family: 'Oswald', sans-serif;">
                            {{ $event->title }}
                        </h2>
                        <p class="text-[#8A8A8A] text-sm mt-1">
                            {{ $event->event_time }} — {{ $event->location }}
                        </p>
                        <p class="text-[#8A8A8A] mt-3">
                            {{ $event->description }}
                        </p>
                        @if (auth()->check() && auth()->user()->role === 'admin')
                        <div class="mt-4 flex gap-4">
                            <a href="/events/{{ $event->id }}/edit" class="text-[#CFFF04] text-sm font-bold uppercase tracking-wide hover:underline">
                                Edit
                            </a>

                            <form id="delete-form-{{ $event->id }}" method="POST" action="/events/{{ $event->id }}" class="inline-flex items-center">
                                @csrf
                                @method('DELETE')
                                <button type="button" onclick="openDeleteModal('{{ $event->id }}', '{{ $event->title }}')" class="text-red-400 text-sm font-bold uppercase tracking-wide hover:underline">
                                    Delete
                                </button>
                            </form>
                        </div>
                        @endif
                    </div>

                </div>
            @empty
                <p class="text-[#8A8A8A]">No events scheduled yet.</p>
            @endforelse

        </div>
    </div>

    {{-- DELETE CONFIRMATION MODAL --}}
    <div id="delete-modal" class="hidden fixed inset-0 bg-black/80 z-50 items-center justify-center p-6">
        <div class="bg-[#232323] border-t-4 border-[#CFFF04] rounded p-8 max-w-sm w-full">
            <h3 class="text-[#F5F5F5] font-bold uppercase text-lg mb-2" style="font-family: 'Oswald', sans-serif;">
                Delete Event
            </h3>
            <p class="text-[#8A8A8A] mb-6">
                Are you sure you want to delete <span id="delete-event-name" class="text-[#F5F5F5] font-semibold"></span>? This can't be undone.
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

        function openDeleteModal(eventId, eventTitle) {
            formToDelete = document.getElementById('delete-form-' + eventId);
            document.getElementById('delete-event-name').textContent = eventTitle;
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