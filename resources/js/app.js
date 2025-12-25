import './bootstrap';

import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse';
import persist from '@alpinejs/persist';

Alpine.plugin(collapse);
Alpine.plugin(persist);

// Global store para el sidebar
Alpine.store('sidebar', {
    collapsed: Alpine.$persist(false).as('sidebar-collapsed')
});

window.Alpine = Alpine;

Alpine.start();
