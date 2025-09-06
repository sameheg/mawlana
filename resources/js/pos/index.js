export class Cart {
    constructor() {
        this.items = [];
    }

    addItem(product, price, quantity = 1) {
        this.items.push({ product, price, quantity });
    }

    clear() {
        this.items = [];
    }

    get total() {
        return this.items.reduce((sum, item) => sum + item.price * item.quantity, 0);
    }
}

export class Invoice {
    constructor(cart) {
        this.cart = cart;
        this.number = Date.now();
        this.createdAt = new Date();
    }

    summary() {
        return {
            number: this.number,
            createdAt: this.createdAt,
            items: this.cart.items,
            total: this.cart.total,
        };
    }
}

