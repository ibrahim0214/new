<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-3 bg-sky-800 dark:bg-sky-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-sky-800 uppercase tracking-widest hover:bg-sky-700 dark:hover:bg-white focus:bg-sky-700 dark:focus:bg-white active:bg-sky-900 dark:active:bg-sky-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-sky-800 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
