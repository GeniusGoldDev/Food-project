importScripts("https://www.gstatic.com/firebasejs/5.9.4/firebase-app.js");
importScripts("https://www.gstatic.com/firebasejs/5.9.4/firebase-messaging.js");
firebase.initializeApp({
    messagingSenderId: "587656068333"
});
const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function(payload) {
    const promiseChain = clients
        .matchAll({
            type: "window",
            includeUncontrolled: true
        })
        .then(windowClients => {
            for (let i = 0; i < windowClients.length; i++) {
                const windowClient = windowClients[i];
                windowClient.postMessage(payload);
            }
        })
        .then(() => {
            var notificationTitle = payload.data.title;
            var notificationOptions = {
                body: payload.data.message,
                icon: payload.data.icon,
                image: payload.data.image,
                badge: payload.data.badge,
                timestamp: payload.data.timestamp,
                data: {
                    url: payload.data.click_action
                }
            };
            return self.registration.showNotification(notificationTitle, notificationOptions);
        });
    return promiseChain;
});
self.addEventListener("notificationclick", function(event) {
    if (event.notification.data.url !== undefined) {
        let url = event.notification.data.url;
        event.notification.close(); // Android needs explicit close.
        event.waitUntil(
            clients
                .matchAll({
                    type: "window"
                })
                .then(windowClients => {
                    // Check if there is already a window/tab open with the target URL
                    for (var i = 0; i < windowClients.length; i++) {
                        var client = windowClients[i];
                        // If so, just focus it.
                        if (client.url === url && "focus" in client) {
                            return client.focus();
                        }
                    }
                    // If not, then open the target URL in a new window/tab.
                    if (clients.openWindow) {
                        return clients.openWindow(url);
                    }
                })
        );
    }
});
