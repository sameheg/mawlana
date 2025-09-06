self.addEventListener('install', (event) => {
    self.skipWaiting();
});

self.addEventListener('activate', (event) => {
    event.waitUntil(self.clients.claim());
});

self.addEventListener('fetch', (event) => {
    event.respondWith(
        caches.open('pwa-orders').then((cache) =>
            cache.match(event.request).then((cached) => {
                const fetchPromise = fetch(event.request)
                    .then((response) => {
                        cache.put(event.request, response.clone());
                        return response;
                    })
                    .catch(() => cached);
                return cached || fetchPromise;
            })
        )
    );
});
