/*import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
*/
document.addEventListener('alpine:init', () => {
    // Alpine è pronto
});

document.addEventListener('livewire:load', () => {
    // Livewire è pronto
    if (window.Alpine) {
        window.Alpine.start();
    }
});
