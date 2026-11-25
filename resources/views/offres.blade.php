<x-app-layout>
  <div class="relative min-h-screen overflow-hidden">

    {{-- photo background with dark overlay --}}
    <div class="absolute inset-0">
        <img src="{{ asset('images/coachesbackground.jpg') }}" alt="" class="w-full h-full object-cover opacity-100">
        <div class="absolute inset-0 bg-[#151515]/80"></div>
    </div>
    <div class="relative z-10 max-w-5xl mx-auto px-6 py-20">
            <h1 class="text-[#F5F5F5] font-bold uppercase text-4xl mb-10" style="font-family: 'Oswald', sans-serif;">
                Our plans
            </h1>

            @if (session('success'))
                <div class="bg-[#232323] border-l-4 border-[#CFFF04] text-[#F5F5F5] p-4 rounded mb-8">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid md:grid-cols-3 gap-6">

                <div class="bg-[#232323] p-8 rounded border-t-4 border-[#CFFF04]">
                    <h2 class="text-[#F5F5F5] font-bold uppercase text-xl mb-2" style="font-family: 'Oswald', sans-serif;">Basic</h2>
                    <p class="text-[#CFFF04] text-3xl font-bold mb-4">50 DT<span class="text-sm text-[#8A8A8A]">/month</span></p>
                    <p class="text-[#8A8A8A] mb-6">Gym access, standard hours.</p>

                    @auth
                        @if (auth()->user()->registration)
                            <form method="POST" action="/subscribe">
                                @csrf
                                <input type="hidden" name="plan_name" value="Basic">
                                <input type="hidden" name="price" value="50">
                                <button type="submit" class="w-full bg-[#CFFF04] text-[#151515] font-bold uppercase py-3 rounded hover:bg-[#e2ff4d] transition-colors">
                                    Choose Basic
                                </button>
                            </form>
                        @else
                            <a href="/inscription" class="block text-center w-full bg-[#2a2a2a] text-[#8A8A8A] font-bold uppercase py-3 rounded hover:text-[#F5F5F5] transition-colors">
                                Complete registration first
                            </a>
                        @endif
                    @else
                        <a href="/login" class="block text-center w-full bg-[#2a2a2a] text-[#8A8A8A] font-bold uppercase py-3 rounded hover:text-[#F5F5F5] transition-colors">
                            Log in to subscribe
                        </a>
                    @endauth
                </div>

                <div class="bg-[#232323] p-8 rounded border-t-4 border-[#CFFF04]">
                    <h2 class="text-[#F5F5F5] font-bold uppercase text-xl mb-2" style="font-family: 'Oswald', sans-serif;">Standard</h2>
                    <p class="text-[#CFFF04] text-3xl font-bold mb-4">80 DT<span class="text-sm text-[#8A8A8A]">/month</span></p>
                    <p class="text-[#8A8A8A] mb-6">Unlimited access + group classes.</p>

                    @auth
                        @if (auth()->user()->registration)
                            <form method="POST" action="/subscribe">
                                @csrf
                                <input type="hidden" name="plan_name" value="Standard">
                                <input type="hidden" name="price" value="80">
                                <button type="submit" class="w-full bg-[#CFFF04] text-[#151515] font-bold uppercase py-3 rounded hover:bg-[#e2ff4d] transition-colors">
                                    Choose Standard
                                </button>
                            </form>
                        @else
                            <a href="/inscription" class="block text-center w-full bg-[#2a2a2a] text-[#8A8A8A] font-bold uppercase py-3 rounded hover:text-[#F5F5F5] transition-colors">
                                Complete registration first
                            </a>
                        @endif
                    @else
                        <a href="/login" class="block text-center w-full bg-[#2a2a2a] text-[#8A8A8A] font-bold uppercase py-3 rounded hover:text-[#F5F5F5] transition-colors">
                            Log in to subscribe
                        </a>
                    @endauth
                </div>

                <div class="bg-[#232323] p-8 rounded border-t-4 border-[#CFFF04]">
                    <h2 class="text-[#F5F5F5] font-bold uppercase text-xl mb-2" style="font-family: 'Oswald', sans-serif;">Premium</h2>
                    <p class="text-[#CFFF04] text-3xl font-bold mb-4">120 DT<span class="text-sm text-[#8A8A8A]">/month</span></p>
                    <p class="text-[#8A8A8A] mb-6">Unlimited access + personal coach.</p>

                    @auth
                        @if (auth()->user()->registration)
                            <form method="POST" action="/subscribe">
                                @csrf
                                <input type="hidden" name="plan_name" value="Premium">
                                <input type="hidden" name="price" value="120">
                                <button type="submit" class="w-full bg-[#CFFF04] text-[#151515] font-bold uppercase py-3 rounded hover:bg-[#e2ff4d] transition-colors">
                                    Choose Premium
                                </button>
                            </form>
                        @else
                            <a href="/inscription" class="block text-center w-full bg-[#2a2a2a] text-[#8A8A8A] font-bold uppercase py-3 rounded hover:text-[#F5F5F5] transition-colors">
                                Complete registration first
                            </a>
                        @endif
                    @else
                        <a href="/login" class="block text-center w-full bg-[#2a2a2a] text-[#8A8A8A] font-bold uppercase py-3 rounded hover:text-[#F5F5F5] transition-colors">
                            Log in to subscribe
                        </a>
                    @endauth
                </div>

            </div>
        </div>
    </div>
</x-app-layout>