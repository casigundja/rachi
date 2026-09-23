import Alpine from 'alpinejs';
import * as bootstrap from 'bootstrap';

window.Alpine = Alpine;
window.bootstrap = bootstrap;


// Custom Alpine store for cart & notifications
Alpine.store('cart', {
    items: JSON.parse(localStorage.getItem('rachi_cart') || '[]'),
    add(product) {
        const existing = this.items.find(i => i.id === product.id);
        if (existing) {
            existing.quantity += 1;
        } else {
            this.items.push({ ...product, quantity: 1 });
        }
        this.save();
    },
    remove(id) {
        this.items = this.items.filter(i => i.id !== id);
        this.save();
    },
    total() {
        return this.items.reduce((sum, item) => sum + (item.price * item.quantity), 0);
    },
    count() {
        return this.items.reduce((sum, item) => sum + item.quantity, 0);
    },
    save() {
        localStorage.setItem('rachi_cart', JSON.stringify(this.items));
    }
});

Alpine.start();
