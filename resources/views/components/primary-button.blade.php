<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-[#CFFF04] border border-transparent rounded-md font-bold text-xs text-[#151515] uppercase tracking-widest hover:bg-[#e2ff4d] focus:outline-none transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>