import './bootstrap';

/* Because Breeze already include alpine, we do not need it with Livewire
However, that causes a problem for pages which need Alpine but don't have any
Livewire components. To get access to Alpine regardless, you can add @livewireScripts
on every page, probably in your layouts/app.blade.php template.
*/
/* import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start(); */
