importScripts('https://www.gstatic.com/firebasejs/8.0.0/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.0.0/firebase-messaging.js');

firebase.initializeApp({
  apiKey: "AIzaSyDO_k8XF0RnKNxjNLhTaIYvk52yT6xOkHY",
  authDomain: "finalpwa-a9b4f.firebaseapp.com",
  projectId: "finalpwa-a9b4f",
  storageBucket: "finalpwa-a9b4f.appspot.com",
  messagingSenderId: "336771751216",
  appId: "1:336771751216:web:3248d79fb70d8f5043bcf5",
  measurementId: "G-SZSQ2M0NTH",
});

const messaging = firebase.messaging();

messaging.onBackgroundMessage(function (payload) {
  console.log(
    "[firebase-messaging-sw.js] Received background message ",
    payload
  );
  // Customize notification here
  const notificationTitle = payload.data.title;
  const notification = {
    body: payload.data.body,
    data: { 
      icon: "qwe.png",
      url: payload.data.url,
      
    },
  };

  self.registration.showNotification(notificationTitle, notification);
});
self.addEventListener("notificationclick", (event) => {
  event.notification.close();
  event.waitUntil(clients.openWindow(event.notification.data.url));
});

