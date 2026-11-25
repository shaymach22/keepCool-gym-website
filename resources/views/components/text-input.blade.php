@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'bg-[#151515] border-[#2a2a2a] text-[#F5F5F5] focus:border-[#CFFF04] focus:ring-[#CFFF04] rounded-md shadow-sm']) }}>