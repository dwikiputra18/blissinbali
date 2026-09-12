self.addEventListener('install', function (event) {
    self.skipWaiting();
});

self.addEventListener('activate', function (event) {
    event.waitUntil(self.clients.claim());
});

self.addEventListener('push', function (event) {
    if (!(self.Notification && self.Notification.permission === 'granted')) {
        return;
    }

    if (event.data) {
        var msg = event.data.json();
        console.log('Push received in SW: ', msg);

        var options = {
            body: msg.body,
            icon: msg.icon || '/favicon.ico',
            badge: '/favicon.ico',
            data: msg.data,
            silent: false,
            vibrate: [200, 100, 200, 100, 200]
        };

        var notifPromise = self.registration.showNotification(msg.title, options);

        // Notify all open windows to play sound
        var soundPromise = self.clients.matchAll({ type: 'window', includeUncontrolled: true }).then(function (clients) {
            console.log('Found ' + clients.length + ' clients to notify about sound');
            clients.forEach(function (client) {
                client.postMessage({ type: 'PLAY_NOTIFICATION_SOUND' });
            });
        });

        // Also try BroadcastChannel as a backup
        try {
            const bc = new BroadcastChannel('push_notification_channel');
            bc.postMessage({ type: 'PLAY_NOTIFICATION_SOUND' });
            bc.close();
        } catch (e) {
            console.warn('BroadcastChannel failed:', e);
        }

        event.waitUntil(Promise.all([notifPromise, soundPromise]));
    }
});

self.addEventListener('notificationclick', function (event) {
    event.notification.close();

    var data = event.notification.data || {};
    var action = data.action || 'view_booking';
    var id = data.id;
    
    var url = '/blissinbaliadmin'; 

    if (action === 'view_booking' && id) {
        url = '/blissinbaliadmin/bookings/' + id + '/edit';
    } else if (action === 'view_car_booking' && id) {
        url = '/blissinbaliadmin/car-bookings/' + id + '/edit';
    }

    event.waitUntil(
        clients.matchAll({ type: 'window', includeUncontrolled: true }).then(function (clientList) {
            for (var i = 0; i < clientList.length; i++) {
                var client = clientList[i];
                if (client.url.includes('/blissinbaliadmin') && 'focus' in client) {
                    client.focus();
                    if ('navigate' in client) {
                        return client.navigate(url);
                    }
                }
            }
            if (clients.openWindow) {
                return clients.openWindow(url);
            }
        })
    );
});
