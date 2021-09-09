var staticCacheName = "pwa-v" + new Date().getTime();
var filesToCache = [
    // '/offline',
    // '/css/app.css',
    // '/js/app.js',
    // '/images/icons/icon-72x72.png',
    // '/images/icons/icon-96x96.png',
    // '/images/icons/icon-128x128.png',
    // '/images/icons/icon-144x144.png',
    // '/images/icons/icon-152x152.png',
    // '/images/icons/icon-192x192.png',
    // '/images/icons/icon-384x384.png',
    // '/images/icons/icon-512x512.png',
    '/images/icons/16.png',
    '/images/icons/20.png',
    '/images/icons/29.png',
    '/images/icons/32.png',
    '/images/icons/40.png',
    '/images/icons/48.png',
    '/images/icons/50.png',
    '/images/icons/55.png',
    '/images/icons/57.png',
    '/images/icons/58.png',
    '/images/icons/60.png',
    '/images/icons/64.png',
    '/images/icons/72.png',
    '/images/icons/76.png',
    '/images/icons/80.png',
    '/images/icons/87.png',
    '/images/icons/88.png',
    '/images/icons/100.png',
    '/images/icons/114.png',
    '/images/icons/120.png',
    '/images/icons/128.png',
    '/images/icons/144.png',
    '/images/icons/152.png',
    '/images/icons/167.png',
    '/images/icons/172.png',
    '/images/icons/180.png',
    '/images/icons/196.png',
    '/images/icons/216.png',
    '/images/icons/256.png',
    '/images/icons/512.png',
    '/images/icons/1024.png',
];

// Cache on install
self.addEventListener("install", event => {
    this.skipWaiting();
    event.waitUntil(
        caches.open(staticCacheName)
            .then(cache => {
                return cache.addAll(filesToCache);
            })
    )
});

// Clear cache on activate
self.addEventListener('activate', event => {
    event.waitUntil(
        caches.keys().then(cacheNames => {
            return Promise.all(
                cacheNames
                    .filter(cacheName => (cacheName.startsWith("pwa-")))
                    .filter(cacheName => (cacheName !== staticCacheName))
                    .map(cacheName => caches.delete(cacheName))
            );
        })
    );
});

// Serve from Cache
self.addEventListener("fetch", event => {
    event.respondWith(
        caches.match(event.request)
            .then(response => {
                return response || fetch(event.request);
            })
            .catch(() => {
                return caches.match('offline');
            })
    )
});
