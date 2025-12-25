<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-4 py-2 bg-white border border-neutral/30 rounded-md font-semibold text-xs text-neutral uppercase tracking-widest shadow-sm hover:bg-light hover:border-neutral/50 hover:text-primary focus:outline-none focus:ring-2 focus:ring-neutral/30 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed transition-all ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
