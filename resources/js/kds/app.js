import '../bootstrap';

const list = document.getElementById('orders');

function render(order) {
    let item = document.getElementById(`order-${order.id}`);
    if (!item) {
        item = document.createElement('li');
        item.id = `order-${order.id}`;
        list.appendChild(item);
    }
    item.textContent = `Order #${order.id} - ${order.status}`;
}

window.Echo.channel('orders')
    .listen('OrderCreated', (e) => render(e.order))
    .listen('OrderUpdated', (e) => render(e.order));
