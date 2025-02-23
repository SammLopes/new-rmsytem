import './bootstrap';

import Alpine from 'alpinejs';
import $ from 'jquery';
import 'jquery-mask-plugin';
import 'inputmask';
import './global.js';

window.$ = $;
console.log('jQuery está funcionando!');

window.Alpine = Alpine;
Alpine.start();
