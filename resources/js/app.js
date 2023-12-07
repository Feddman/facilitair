import './bootstrap';
import '../../vendor/masmerise/livewire-toaster/resources/js';

import intersect from '@alpinejs/intersect';
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.plugin(intersect);
Alpine.start();
