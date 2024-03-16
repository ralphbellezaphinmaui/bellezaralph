<?php
session_start();

if (isset($_SESSION["users_id"])){
    $mysqli = require __DIR__ . "/connect.php";

    $sql = "SELECT * FROM users
            WHERE id = {$_SESSION["users_id"]}";
    $result = $mysqli->query($sql);

    $users = $result->fetch_assoc();
}
else{
  header("Location: login.php");
}


date_default_timezone_set('Asia/Manila');
$script_tz = date_default_timezone_get();
$date = date('Y-m-d-H:i:s-a')
?>




<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles/report/style1.css">
  <script defer src="styles/report/theme.js"></script>

  


  <title>Report</title>
  <style>
    h1 {
      display: flex;
      align-items: center;
      justify-content: center;
      justify-self: center;
      text-align: center;
      color: #fff;
      text-transform: uppercase;
      letter-spacing: 1px;
      font-weight: bold;
      width:25%;
      margin-left:38%;

    }

    h2 {
      color: white;
    }

    .report-container {
      display: flex;
      flex-wrap: wrap;
      align-items: center;
      justify-content: center;
      background-color: #ff7f27;
      margin-right: 1em;
      
    }

    .report-container .report-box {
      height: 10px;
      width: 210px;
      border: 10px solid black;
      margin: 50px;
      border-radius: 5%;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      overflow: hidden;
      transition: 0.2s all;
      cursor: pointer;
      padding: 7em;
      
    }

    .report-container .report-box:hover {
      border: 15px solid orange;
    }

    .report-container .report-box i {
      background-color: #213b52;
      color: #fff;
      font-size: 170px;
    }

    .report-container .report-box a {
      margin-top: 20px;
      border: #fff;
      outline: none;
    }

    #feedback {
      height: 100%;
      width: 100%;
    }


    .modal {
      display: none;
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      padding: 20px;
      background-color: #f9f9f9;
      /* Light background color */
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      border-radius: 8px;
      z-index: 1000;
    }

    /* Modal Content Styling */
    #callInfo {
      margin-bottom: 20px;
    }

    /* Button Styling */


    #acceptButton {
      background-color: #4caf50;
      color: #fff;
      padding: 10px 20px;
      margin-right: 10px;
      cursor: pointer;
      border: none;
      border-radius: 4px;
      font-size: 14px;
    }

    #declineButton {
      background-color: #f44336;
      color: #fff;
      padding: 10px 20px;
      margin-right: 10px;
      cursor: pointer;
      border: none;
      border-radius: 4px;
      font-size: 14px;
    }

    /* Close button (if needed) */
    .close {
      position: absolute;
      top: 10px;
      right: 10px;
      font-size: 18px;
      cursor: pointer;
    }

    .vcallmodal {
      display: none;
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      padding: 50px;
      background-color: #f9f9f9;
      /* Light background color */
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      border-radius: 8px;
      z-index: 1000;
      width: 70%;
      height: 70%;
      margin-bottom: 25%;
    }

    .vcallmodal .video {
      position: relative;
      height: 100%;
      width: 100%;
      border-radius: 16px;
      object-fit: cover;
      margin-top: 0%;
    }

    .vcallmodal .video .primary-video {
      position: absolute;
      width: 100%;
      height: 100%;
      object-fit: cover;
      background-color: black;
    }

    .vcallmodal .video .secondary-video {
      position: absolute;
      width: 30%;
      height: 30%;
      margin: 16px;
      border-radius: 16px;
      object-fit: cover;
      background-color: grey;
    }

    #hangupbtn {
      background-color: #f44336;
      color: #fff;
      padding: 10px 20px;
      margin-right: 10px;
      cursor: pointer;
      border: none;
      border-radius: 4px;
      font-size: 14px;
    }

    .userDecline {
      display: none;
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      padding: 20px;
      background-color: #f9f9f9;
      /* Light background color */
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      border-radius: 8px;
      z-index: 1000;
    }

    #declineInfo {
      margin-bottom: 20px;
    }

    #okbutton {
      background-color: #4caf50;
      color: #fff;
      padding: 10px 20px;
      margin-right: 10px;
      cursor: pointer;
      border: none;
      border-radius: 4px;
      font-size: 14px;
    }

    .type1 .tooltip1 {
      visibility: hidden;
      width: 120px;
      background-color: orange;
      color: black;
      text-align: center;

      padding: 5px 0;

      /* Position  the tooltip */
      position: absolute;
      z-index: 1;
    }

    .type1:hover .tooltip1 {
      visibility: visible;
    }

    .type2 .tooltip2 {
      visibility: hidden;
      width: 120px;
      background-color: orange;
      color: black;
      text-align: center;

      padding: 5px 0;

      /* Position  the tooltip */
      position: absolute;
      z-index: 1;
    }

    .type2:hover .tooltip2 {
      visibility: visible;
    }

    .type3 .tooltip3 {
      visibility: hidden;
      width: 120px;
      background-color: orange;
      color: black;
      text-align: center;

      padding: 5px 0;

      /* Position  the tooltip */
      position: absolute;
      z-index: 1;
    }

    .type3:hover .tooltip3 {
      visibility: visible;
    }

    .type4 .tooltip4 {
      visibility: hidden;
      width: 120px;
      background-color: orange;
      color: black;
      text-align: center;

      padding: 5px 0;

      /* Position  the tooltip */
      position: absolute;
      z-index: 1;
    }

    .type4:hover .tooltip4 {
      visibility: visible;
    }

    .studentcallmodal {
      display: none;
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      padding: 20px;
      background-color: #f9f9f9;
      /* Light background color */
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      border-radius: 8px;
      z-index: 1000;
    }


    /* Modal Content Styling */
    #callInfo {
      margin-bottom: 20px;
    }

    /* Button Styling */

    #callbutton {
      background-color: #4caf50;
      color: #fff;
      padding: 10px 20px;
      margin-right: 10px;
      cursor: pointer;
      border: none;
      border-radius: 4px;
      font-size: 14px;
    }

    #cancelbutton {
      background-color: #f44336;
      color: #fff;
      padding: 10px 20px;
      margin-right: 10px;
      cursor: pointer;
      border: none;
      border-radius: 4px;
      font-size: 14px;
    }




    @media only screen and (max-width: 1280px){
      .report-container {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: center;
        background-color: #ff7f27;

        margin-left:24%;
        width:70%;
        
    }
    

    

      h1{
        margin-left: 2.5em;
        width: 70%; 
        color: #ff7f27; 
        margin-left: 24%;
        z-index: -1;
      }

      p {
        margin-left: 15%;
      }
    
    }
     /* Add your modal styling here */
        .notifmodal {
            /* Your modal styles */
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 10px;
            background-color: black;
          /* Light background color */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            z-index: 1000;
            margin-left:2em;
            width: 50vw;
            
        }
        .em-content {
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: black;
            flex-wrap: wrap;
            

        }
        .em-content input[type="image"] {
            width: 100%;
            max-width: 100px;
            margin: 10px;
            height:100px
        }

        /* Responsive styles */
        @media screen and (max-width: 600px) {
            .notifmodal {
                width: 60vw;
            }
        }
  </style>
</head>

<body>

    <?php if (isset($users)): ?>
        
      <div style='font:20px Verdana,tahoma,sans-serif;color:#008000; text-align: center;'>
        <p>Hello <?= htmlspecialchars($users["firstname"])?></p>
      </div>
  
    <?php endif; ?>
  
    <form id="calldata" action="calldata_process.php" method="post">
      <input type="hidden" name = "participants" id = "participants">
      <input type="hidden" name = "caller" id = "caller">
      <input type="hidden" name = "callee" id = "callee">
      <input type="hidden" name = "startTime" id = "startTime">
      <input type="hidden" name = "endTime" id = "endTime">
      
      <input type="hidden" name = "user_id" id = "user_id" value = "<?= htmlspecialchars($users["id"])?>">
      <input type="hidden" name = "user_firstname" id = "user_firstname" value = <?= htmlspecialchars($users["firstname"])?>>
      <input type="hidden" name = "user_lastname" id = "user_lastname" value = <?= htmlspecialchars($users["lastname"])?>>
      <input type="hidden" name = "user_email" id = "user_email" value = <?= htmlspecialchars($users["email"])?>>
      <input type="hidden" name = "category" id = "category" value = "">
      <input type="hidden" name = "user_time" id = "user_time" value = "">
        
    </form>








  <nav class="navbar">
    <ul class="navbar-nav">
      <li class="logo">
        <a href="#" class="nav-link">
          <span class="link-text logo-text">USER</span>
          <svg aria-hidden="true" focusable="false" data-prefix="fad" data-icon="angle-double-right" role="img"
            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"
            class="svg-inline--fa fa-angle-double-right fa-w-14 fa-5x">
            <g class="fa-group">
              <path fill="currentColor"
                d="M224 273L88.37 409a23.78 23.78 0 0 1-33.8 0L32 386.36a23.94 23.94 0 0 1 0-33.89l96.13-96.37L32 159.73a23.94 23.94 0 0 1 0-33.89l22.44-22.79a23.78 23.78 0 0 1 33.8 0L223.88 239a23.94 23.94 0 0 1 .1 34z"
                class="fa-secondary"></path>
              <path fill="currentColor"
                d="M415.89 273L280.34 409a23.77 23.77 0 0 1-33.79 0L224 386.26a23.94 23.94 0 0 1 0-33.89L320.11 256l-96-96.47a23.94 23.94 0 0 1 0-33.89l22.52-22.59a23.77 23.77 0 0 1 33.79 0L416 239a24 24 0 0 1-.11 34z"
                class="fa-primary"></path>
            </g>
          </svg>
        </a>
      </li>



      <li class="nav-item">
        <a href="announcements.php" class="nav-link">
          <svg aria-hidden="true" focusable="false" data-prefix="fad" data-icon="bullhorn" role="img"
            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="svg-inline--fa fa-bullhorn fa-w-18 fa-9x">
            <g class="fa-group">
              <path fill="currentColor"
                d="M480 32c0-12.9-7.8-24.6-19.8-29.6s-25.7-2.2-34.9 6.9L381.7 53c-48 48-113.1 75-181 75H192 160 64c-35.3 0-64 28.7-64 64v96c0 35.3 28.7 64 64 64l0 128c0 17.7 14.3 32 32 32h64c17.7 0 32-14.3 32-32V352l8.7 0c67.9 0 133 27 181 75l43.6 43.6c9.2 9.2 22.9 11.9 34.9 6.9s19.8-16.6 19.8-29.6V300.4c18.6-8.8 32-32.5 32-60.4s-13.4-51.6-32-60.4V32zm-64 76.7V240 371.3C357.2 317.8 280.5 288 200.7 288H192V192h8.7c79.8 0 156.5-29.8 215.3-83.3z"
                class="fa-secondary"></path>
              <path fill="currentColor"
                d="M480 32c0-12.9-7.8-24.6-19.8-29.6s-25.7-2.2-34.9 6.9L381.7 53c-48 48-113.1 75-181 75H192 160 64c-35.3 0-64 28.7-64 64v96c0 35.3 28.7 64 64 64l0 128c0 17.7 14.3 32 32 32h64c17.7 0 32-14.3 32-32V352l8.7 0c67.9 0 133 27 181 75l43.6 43.6c9.2 9.2 22.9 11.9 34.9 6.9s19.8-16.6 19.8-29.6V300.4c18.6-8.8 32-32.5 32-60.4s-13.4-51.6-32-60.4V32zm-64 76.7V240 371.3C357.2 317.8 280.5 288 200.7 288H192V192h8.7c79.8 0 156.5-29.8 215.3-83.3z"
                class="fa-primary"></path>
            </g>
          </svg>
          <span class="link-text">Announcements</span>
        </a>
      </li>

      <li class="nav-item">
        <a href="#" id="notifbtn" class="nav-link">
          <svg aria-hidden="true" focusable="false" data-prefix="fad" data-icon="space-station-moon-alt" role="img"
            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
            class="svg-inline--fa fa-space-station-moon-alt fa-w-16 fa-5x">
            <g class="fa-group">
              <path fill="currentColor"
                d="M96 128a128 128 0 1 0 256 0A128 128 0 1 0 96 128zm94.5 200.2l18.6 31L175.8 483.1l-36-146.9c-2-8.1-9.8-13.4-17.9-11.3C51.9 342.4 0 405.8 0 481.3c0 17 13.8 30.7 30.7 30.7H162.5c0 0 0 0 .1 0H168 280h5.5c0 0 0 0 .1 0H417.3c17 0 30.7-13.8 30.7-30.7c0-75.5-51.9-138.9-121.9-156.4c-8.1-2-15.9 3.3-17.9 11.3l-36 146.9L238.9 359.2l18.6-31c6.4-10.7-1.3-24.2-13.7-24.2H224 204.3c-12.4 0-20.1 13.6-13.7 24.2z"
                class="fa-secondary"></path>
              <path fill="currentColor"
                d="M96 128a128 128 0 1 0 256 0A128 128 0 1 0 96 128zm94.5 200.2l18.6 31L175.8 483.1l-36-146.9c-2-8.1-9.8-13.4-17.9-11.3C51.9 342.4 0 405.8 0 481.3c0 17 13.8 30.7 30.7 30.7H162.5c0 0 0 0 .1 0H168 280h5.5c0 0 0 0 .1 0H417.3c17 0 30.7-13.8 30.7-30.7c0-75.5-51.9-138.9-121.9-156.4c-8.1-2-15.9 3.3-17.9 11.3l-36 146.9L238.9 359.2l18.6-31c6.4-10.7-1.3-24.2-13.7-24.2H224 204.3c-12.4 0-20.1 13.6-13.7 24.2z"
                class="fa-primary"></path>
            </g>
          </svg>
          <span class="link-text">Admin List</span>
        </a>
      </li>

      <li class="nav-item">
        <a href="logout.php" class="nav-link">
          <svg aria-hidden="true" focusable="false" data-prefix="fad" data-icon="space-station-moon-alt" role="img"
            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
            class="svg-inline--fa fa-space-station-moon-alt fa-w-16 fa-5x">
            <g class="fa-group">
              <path fill="currentColor"
                d="M288 32c0-17.7-14.3-32-32-32s-32 14.3-32 32V256c0 17.7 14.3 32 32 32s32-14.3 32-32V32zM143.5 120.6c13.6-11.3 15.4-31.5 4.1-45.1s-31.5-15.4-45.1-4.1C49.7 115.4 16 181.8 16 256c0 132.5 107.5 240 240 240s240-107.5 240-240c0-74.2-33.8-140.6-86.6-184.6c-13.6-11.3-33.8-9.4-45.1 4.1s-9.4 33.8 4.1 45.1c38.9 32.3 63.5 81 63.5 135.4c0 97.2-78.8 176-176 176s-176-78.8-176-176c0-54.4 24.7-103.1 63.5-135.4z"
                class="fa-secondary"></path>
              <path fill="currentColor"
                d="M288 32c0-17.7-14.3-32-32-32s-32 14.3-32 32V256c0 17.7 14.3 32 32 32s32-14.3 32-32V32zM143.5 120.6c13.6-11.3 15.4-31.5 4.1-45.1s-31.5-15.4-45.1-4.1C49.7 115.4 16 181.8 16 256c0 132.5 107.5 240 240 240s240-107.5 240-240c0-74.2-33.8-140.6-86.6-184.6c-13.6-11.3-33.8-9.4-45.1 4.1s-9.4 33.8 4.1 45.1c38.9 32.3 63.5 81 63.5 135.4c0 97.2-78.8 176-176 176s-176-78.8-176-176c0-54.4 24.7-103.1 63.5-135.4z"
                class="fa-primary"></path>
            </g>
          </svg>
          <span class="link-text">Logout</span>
        </a>
      </li>



          

        </a>
      </li>
    </ul>
  </nav>



    <div id="notif" class="notifmodal">
        <div class="modal-content">
            <div id="emergency" class="emergency" style="background-color: orange;">
                <h4 style="text-align:center;">Call an Admin</h4>
                  <div class="em-content" style="display: flex; justify-content: center; align-items: center; background-color: black;">


                    <div id = "messages">
        
                      <div class = "msg">
                          <?php
                              $sqli = "SELECT id,firstname FROM admins ORDER BY id desc LIMIT 2";
                              $result = mysqli_query($mysqli,$sqli);
                              if(mysqli_num_rows($result) > 0){
                                  while($rows=mysqli_fetch_assoc($result)){
                                      echo "<pre>";
                                      echo "<div style ='padding-right:8px;padding-left:15px;color:green'>";
                                      echo "<b> Admin: ";
                                      echo $rows['firstname']."     ";

                                      echo "<b> ID: ";
                                      echo $rows['id'];

                                      echo "</div>";
                                      echo "</pre>";
                                      echo "<br>";


                                  }
                                  
                              }
                              else{
                                  echo "No messages.";
                              }
                              
                          ?>
                      </div>      
                    </div>

                  </div>
            
              </div>
            <a href="" id="closemodal"><center>CLOSE</center></a>
        </div>
    </div>





  <h1 class="cyberpunk" style="color:#ff7f27;">Click A Button</h1>

  <div id="userDecline" class="userDecline">
    <div id="declineInfo">Call Declined</div>
    <button id="okbutton" onclick="">OK</button>
  </div>

  <div class="vcallmodal" id="vcallmodal">
    <div class="video">
      <div class="primary-video" id="remoteVideo"></div>
      <div class="secondary-video" id="localVideo"></div>
    </div>
    <button id="hangupbtn" class="hangupbtn">Hang Up</button>
  </div>



  <div id="customModal" class="modal">
    <div id="callInfo"></div>
    <button id="acceptButton">Accept</button>
    <button id="declineButton">Decline</button>
  </div>

  
    <div class="report-container">
      <div class="report-box">
        <i class="fa-solid fa-gun"></i>
        <div class="type1">
          <span class="tooltip1">Construction Hazard</span>
          <input type="image" id="callbutton1" class="cover" src="styles/report/construction.png" onclick="studentcall1()">
        </div>

      </div>

      <div class="report-box">
        <i class="fa-solid fa-hand-fist"></i>
        <div class="type2">
          <span class="tooltip2">Violence</span>
          <input type="image" id="callbutton2" class="cover" src="styles/report/violence.png" onclick="studentcall2()">
        </div>

      </div>

      <div class="report-box">
        <i class="fa-solid fa-heart-pulse"></i>
        <div class="type3">
          <span class="tooltip3">Medical Attention</span>
          <input type="image" id="callbutton3" class="cover" src="styles/report/medical.png" onclick="studentcall3()">
        </div>

      </div>

      <div class="report-box">
        <i class="fa-solid fa-fire"></i>
        <div class="type4">
          <span class="tooltip4">Fire/Explosion</span>
          <input type="image" id="callbutton4" class="cover" src="styles/report/fire.png" onclick="studentcall4()">
        </div>

      </div>
    </div>




  <div id="studentcallmodal" class="studentcallmodal">
    <div id="callInfo">Call an admin</div>
    <input type="text" name="adminid" id="adminid">
    <button id="callbutton" onclick="StudentsendMessage()">Call</button>
    <button id="cancelbutton">Cancel</button>
  </div>

  <script src = "https://unpkg.com/peerjs@1.5.2/dist/peerjs.min.js"></script>
    <script src="./calljs.js"></script>
        <script>
        if ("serviceWorker" in navigator){
            navigator.serviceWorker.register("./firebase-messaging-sw.js").then(registration =>{
              console.log("sw registered!");
              console.log(registration);  
            }).catch(error => {
              console.log("SW registration failed");
              console.log(error);
            });
        }
    </script>
    <script type="module">
        // Import the functions you need from the SDKs you need
        import { initializeApp } from "https://www.gstatic.com/firebasejs/10.7.2/firebase-app.js";
        import { getAnalytics } from "https://www.gstatic.com/firebasejs/10.7.2/firebase-analytics.js";
        import { getMessaging, getToken } from "https://www.gstatic.com/firebasejs/10.7.2/firebase-messaging.js";
        // TODO: Add SDKs for Firebase products that you want to use
        // https://firebase.google.com/docs/web/setup#available-libraries

        // Your web app's Firebase configuration
        // For Firebase JS SDK v7.20.0 and later, measurementId is optional
        const firebaseConfig = {
          apiKey: "AIzaSyDO_k8XF0RnKNxjNLhTaIYvk52yT6xOkHY",
          authDomain: "finalpwa-a9b4f.firebaseapp.com",
          projectId: "finalpwa-a9b4f",
          storageBucket: "finalpwa-a9b4f.appspot.com",
          messagingSenderId: "336771751216",
          appId: "1:336771751216:web:3248d79fb70d8f5043bcf5",
          measurementId: "G-SZSQ2M0NTH"
        };

        // Initialize Firebase
        const app = initializeApp(firebaseConfig);
        const analytics = getAnalytics(app);

        const messaging = getMessaging(app);
        const token = getToken(messaging);
        Notification.requestPermission().then((permission) => {
          if (permission === 'granted') {
            console.log('Notification permission granted.');
            // Retrieve the FCM token
            token
              .then((token) => {
                console.log('FCM token:', token);
                // Send this token to your server for sending push notifications
              })
              .catch((error) => {
                console.log('Error while retrieving token:', error);
                
              });
          } else {
            console.log('Notification permission denied.');
          }
        });
        
 
    </script>

      <script>
        // Function to open the modal
        function opmodal() {
            var modal = document.getElementById("notif");
            modal.style.display = "block";
        }
        function closemodal(){
            var modal = document.getElementById("notif");
            modal.style.display = "none";
        }

        // Get the button element
        var btn = document.getElementById("notifbtn");
        var nbtn = document.getElementById("closemodal");

        // Attach the function to the button (no need for onclick)
        btn.addEventListener("click", opmodal);
        nbtn.addEventListener("click", closemodal);
        

        // Rest of your modal logic (close button, etc.) remains the same
        // ...
    </script>

    <script>

      init(<?= htmlspecialchars($users["id"])?>);
    </script>







</body>

</html>