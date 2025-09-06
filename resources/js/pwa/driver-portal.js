class DriverPortal extends EventTarget {
    assign(orderId, driverId) {
        this.dispatchEvent(new CustomEvent('assign', { detail: { orderId, driverId } }));
    }

    updateStatus(orderId, status) {
        this.dispatchEvent(new CustomEvent('status', { detail: { orderId, status } }));
    }
}

export const driverPortal = new DriverPortal();
