<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-secondary border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-accent active:bg-secondary focus:outline-none focus:ring-2 focus:ring-secondary/50 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed shadow-sm hover:shadow-md transition-all ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
