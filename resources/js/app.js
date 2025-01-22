import './bootstrap';

import Alpine from 'alpinejs';
import $ from 'jquery';
window.$ = $;
window.jQuery = $;
console.log('jQuery está funcionando!');

window.Alpine = Alpine;
Alpine.start();
