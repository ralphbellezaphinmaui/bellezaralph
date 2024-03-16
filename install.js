if ("serviceWorker" in navigator){
    navigator.serviceWorker.register("./firebase-messaging-sw.js").then(registration =>{
      console.log("sw registered!");
      console.log(registration);  
    }).catch(error => {
      console.log("SW registration failed");
      console.log(error);
    });
}

