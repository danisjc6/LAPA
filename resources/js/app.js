// import './bootstrap';
import '@fortawesome/fontawesome-free/css/all.min.css';
import persist from '@alpinejs/persist';
import Alpine from 'alpinejs';
import './modelo-3d';

Alpine.plugin(persist);

window.Alpine = Alpine;

Alpine.start();
