<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center w-full h-11 px-5 bg-accent text-primary-dark rounded-xl font-semibold text-sm hover:bg-[#E08C00] focus:outline-none focus:ring-2 focus:ring-accent/40 focus:ring-offset-2 transition']) }}>
    {{ $slot }}
</button>
