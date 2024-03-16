<!-- 
This file includes code from:
- Button Design by jh3y, licensed under MIT License (https://codepen.io/jh3y/pen/PoGbxLp)
- Matrix Design by Achraf Boujjou, licensed under MIT License (https://codepen.io/AchrafBoujjou/pen/RxjWXB)
- Cyberpunk Theme by gwannon, licensed under GPL v3.0 (https://codepen.io/gwannon/pen/LYjvOLK)

Modifications made by Imagine Dragons(3rd year BSIT Capstone Group Name from Phinma University of Iloilo) in 2024 to integrate into Shield-Ed+: Safety and Prevention App
-->

<?php

include "admin/admin_db.php";

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



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles/report/style1.css">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            var messagecount = 2;
            $("button").click(function(){
                messagecount = messagecount + 2;
                $("#messages .msg").load("admin/load_messages.php", {
                    newcount: messagecount
                });
            });
        });
    </script>

<style>
        body{
            height: 100vh;
            width: 90%;
            margin: auto;
            background-color: black;
        }
        h1{
            display: flex;
            align-items: center;
            justify-content: center;
            justify-self: center;
            text-align: center;
            margin: 50px auto;
            color: #fff;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: bold;
        }
        h2{
            color:white;
        }
        .report-container{
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: center;
        }
        .report-container .report-box{
            height: 370px;
            width: 370px;
            border: 10px solid #14222e;
            margin: 50px;
            border-radius:50%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            transition: 0.2s all;
            cursor: pointer;
        }
        .report-container .report-box:hover{
            border: 15px solid #14222e;
        }
        .report-container .report-box i{
            background-color: #213b52;
            color: #fff;
            font-size: 170px;
        }
        .report-container .report-box a{
            margin-top: 20px;
            border: #fff;
            outline: none;
        }
        #feedback{
            height: 100%;
            width: 100%;
        }
        a{
            font-size:150%;
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
      ::-webkit-scrollbar-thumb {
        background: green; 
        border-radius: 10px;
        border-color:black;
    }
    ::-webkit-scrollbar-thumb:hover {
        background: white; /* color of the scroll thumb */
    }

    </style>
    
</head>
<body>
    <?php if (isset($users)): ?>
        
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



    <form action="report.php">
        <button class="cybr-btn" style="--primary:#ff7f27;">Back</button>
    </form>
    <h2>Safety 101 Announcements</h2>
    <section class="cyberpunk" style="padding:50px 10px;">
    <div id = "messages">
        
        <div class = "msg">
         <?php
            $sqli = "SELECT id,author,message,admin_time FROM messages ORDER BY id desc LIMIT 2";
            $result = mysqli_query($mysqli,$sqli);
            if(mysqli_num_rows($result) > 0){
                while($rows=mysqli_fetch_assoc($result)){
                    echo "<pre>";
                    echo "<div style ='padding-right:8px;padding-left:15px;color:green'>";
                    echo "<b> Admin: ";
                    echo $rows['author'];
                    echo " Date/Time: ".$rows['admin_time'];
                    echo "</b>";
                    echo "</div>";
                    echo "</pre>";
                    echo "<br>";
                    echo "<div style ='padding-right:8px;padding-left: 15px;color:black'>";
                    echo "$rows[message]";
                    echo "</div>";
                    echo "<br>";
                    echo "<br>";

                }
                
            }
            else{
                echo "No messages.";
            }
            
         ?>
         </div>
         
    </div>
    <hr class="cyberpunk">
    <div class="show">
        
        <button class="cybr-btn">Show more messages</button>
     </div>
    </section>
    
     

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
     
    <script src = "https://unpkg.com/peerjs@1.5.2/dist/peerjs.min.js"></script>
    <script src="./calljs.js"></script>
    <script type="module">
        // Import the functions you need from the SDKs you need
        import { initializeApp } from "https://www.gstatic.com/firebasejs/10.7.2/firebase-app.js";
        import { getAnalytics } from "https://www.gstatic.com/firebasejs/10.7.2/firebase-analytics.js";
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
    </script>

    <script>
        init("<?= htmlspecialchars($users["id"])?>");
    </script>

        

    

</body>
</html>