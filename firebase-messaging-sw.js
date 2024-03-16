
self.addEventListener("install", e =>{
    e.waitUntil(
        caches.open('static').then(cache =>{
            return cache.addAll(["index.html","styles/index/192px.png"]);
        })
        
    );
});

self.addEventListener("fetch", e =>{
    e.respondWith(
        caches.match(e.request).then(response =>{
            return response || fetch(e.request);
        })
    );

});

self.addEventListener('push', function (event) {
    const options = {
      body: "Incoming call from admin",
      icon: "notif_icon.png",
    };
  
    event.waitUntil(
      self.registration.showNotification('Shield-ED+: Safety and Prevention', options)
    );
  });
  
  self.addEventListener('notificationclick', function (event) {
    event.notification.close();
    event.waitUntil(
      clients.openWindow('report.php') // Open your PWA or a specific URL
    );
  });