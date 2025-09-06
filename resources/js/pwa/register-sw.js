/**
 * Register the PWA service worker.
 */
export function registerServiceWorker() {
    if ('serviceWorker' in navigator) {
        navigator.serviceWorker
            .register(new URL('./sw.js', import.meta.url), { type: 'module' })
            .catch((error) => console.error('Service worker registration failed', error));
    }
}
