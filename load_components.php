<!DOCTYPE html>
<html>

<head>
    <title>Subscribing the User</title>

</head>

<body>

    <script src="install.js" defer>
    </script>
    <script src="https://www.gstatic.com/firebasejs/8.2.1/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.2.1/firebase-messaging.js"></script>
    
    <script>
        

        Notification.requestPermission().then(function (permission) {
            if (permission === 'granted') {
                console.log('Notification permission granted.');
                setTimeout(function(){
                    subscribeUserToTopic1();
                 },9000);
                

            } else {
                console.log('Notification permission denied.');
                console.log('Announcement Subscription Denied');
            }
        });
        
    </script>
    <script defer>
        // Your web app's Firebase configuration
        var firebaseConfig = {
            apiKey: "AIzaSyDO_k8XF0RnKNxjNLhTaIYvk52yT6xOkHY",
            authDomain: "finalpwa-a9b4f.firebaseapp.com",
            projectId: "finalpwa-a9b4f",
            storageBucket: "finalpwa-a9b4f.appspot.com",
            messagingSenderId: "336771751216",
            appId: "1:336771751216:web:3248d79fb70d8f5043bcf5",
            measurementId: "G-SZSQ2M0NTH"
        };
        // Initialize Firebase
        firebase.initializeApp(firebaseConfig);

        const messaging = firebase.messaging();


        let count = 0;
        function checkCount() {
            if(count==4){
                window.location.href = "report.php";
            }
        }
        function subscribeUserToTopic1() {
            messaging.getToken()
                .then(token => {
                    console.log('Token:', token);
                    return fetch('https://topic-test.onrender.com', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            token: token,
                            topic: 'construction'
                        })
                    });
                })
                .then(() => {
                    console.log('Subscribed to "construction" topic');
                    count+=1;
                    checkCount();
                    setTimeout(subscribeUserToTopic2, 5000);
                })
                .catch(err => {
                    console.log('Error subscribing to "construction" topic:', err);
                });
        }
        function subscribeUserToTopic2() {
            messaging.getToken()
                .then(token => {
                    console.log('Token:', token);
                    return fetch('https://topic-test.onrender.com', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            token: token,
                            topic: 'violence'
                        })
                    });
                })
                .then(() => {
                    console.log('Subscribed to "violence" topic');
                    count+=1;
                    checkCount();
                    setTimeout(subscribeUserToTopic3, 5000);
                })
                .catch(err => {
                    console.log('Error subscribing to "violence" topic:', err);
                });
        }
        function subscribeUserToTopic3() {
            messaging.getToken()
                .then(token => {
                    console.log('Token:', token);
                    return fetch('https://topic-test.onrender.com', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            token: token,
                            topic: 'medical'
                        })
                    });
                })
                .then(() => {
                    console.log('Subscribed to "medical" topic');
                    count+=1;
                    checkCount();
                    setTimeout(subscribeUserToTopic4, 5000);
                })
                .catch(err => {
                    console.log('Error subscribing to "medical" topic:', err);
                });
        }
        function subscribeUserToTopic4() {
            messaging.getToken()
                .then(token => {
                    console.log('Token:', token);
                    return fetch('https://topic-test.onrender.com', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            token: token,
                            topic: 'fire'
                        })
                    });
                })
                .then(() => {
                    console.log('Subscribed to "fire" topic');
                    count+=1;
                    checkCount();
                })
                .catch(err => {
                    console.log('Error subscribing to "fire" topic:', err);
                });
        }
    </script>
</body>

</html>
