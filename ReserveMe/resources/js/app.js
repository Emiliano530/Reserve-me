import './bootstrap';

import Alpine from 'alpinejs';
import focus from '@alpinejs/focus';
window.Alpine = Alpine;
import Swal from 'sweetalert2';
window.Swal = Swal;

Alpine.plugin(focus);

Alpine.start();
