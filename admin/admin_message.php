<?php
session_start();


 
if (isset($_SESSION["admins_id"])){
    $mysqli = require __DIR__ . "/admin_db.php";

    $sql = "SELECT * FROM admins
            WHERE id = {$_SESSION["admins_id"]}";
    $result = $mysqli->query($sql);

    $admins = $result->fetch_assoc();
}
else{
    header("Location: admin_login.php");
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
    <title>Compose Announcements</title>
    <link rel="stylesheet" href="../styles/admin_dashboard/admin_dashboard.css">
    <script defer src="../styles/admin_dashboard/theme.js"></script>

    <style>
      .adminCall {
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

      /* Close button (if needed) */
      .close {
          position: absolute;
          top: 10px;
          right: 10px;
          font-size: 18px;
          cursor: pointer;
      }
      .navbar{
      width: 5rem;
      height: 100vh;
      position: fixed;
      background-color: var(--bg-primary);
      }
      .main{
          margin-left: 5rem;
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
      @media only screen and (min-width: 260px) {
        #composer{
          margin-left: 4em;
          padding:0; 
          width:45vw;
          height:100vh;
          margin-top:2em;
        }
        #message{
          height:40vh;
          width:40vw;
          padding:0;
        }
        #submit-btn{
          width:8em; 
          font-size:15px;
        }
        #admin-name{
          display:center;
          width: 45vw;  
        }
      
      


      
    
      }
  @media only screen and (min-width: 1920px) {
      #composer{
        margin-left: 20%;
        padding:0; 
        width:60vw;
        height:80vh;
        margin-top:2%;
      }
      #message{
        height:50vh;
        width:80vh;
        padding:0;
      }
      
      #submit-btn{
        width:80vw;
      }

  }
  body{
    overflow:hidden;
    height: 100vh;
  }
  .overlay {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    text-align: center;
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
            width: 10vw;
            
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
<nav class="navbar" style="z-index:2; background-color:black;">
    <ul class="navbar-nav">
      <li class="logo">
        <a href="#" class="nav-link">
          <span class="link-text logo-text">ADMIN</span>
          <svg
            aria-hidden="true"
            focusable="false"
            data-prefix="fad"
            data-icon="angle-double-right"
            role="img"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 448 512"
            class="svg-inline--fa fa-angle-double-right fa-w-14 fa-5x"
          >
            <g class="fa-group">
              <path
                fill="currentColor"
                d="M224 273L88.37 409a23.78 23.78 0 0 1-33.8 0L32 386.36a23.94 23.94 0 0 1 0-33.89l96.13-96.37L32 159.73a23.94 23.94 0 0 1 0-33.89l22.44-22.79a23.78 23.78 0 0 1 33.8 0L223.88 239a23.94 23.94 0 0 1 .1 34z"
                class="fa-secondary"
              ></path>
              <path
                fill="currentColor"
                d="M415.89 273L280.34 409a23.77 23.77 0 0 1-33.79 0L224 386.26a23.94 23.94 0 0 1 0-33.89L320.11 256l-96-96.47a23.94 23.94 0 0 1 0-33.89l22.52-22.59a23.77 23.77 0 0 1 33.79 0L416 239a24 24 0 0 1-.11 34z"
                class="fa-primary"
              ></path>
            </g>
          </svg>
        </a>
      </li>

      <li class="nav-item">
        <a href="admin_report_queries.php" class="nav-link">
          <svg
            aria-hidden="true"
            focusable="false"
            data-prefix="fad"
            data-icon="scroll"
            role="img"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 512 512"
            class="svg-inline--fa fa-scroll fa-w-16 fa-9x"
          >
            <g class="fa-group">
              <path
                fill="currentColor"
                d="M0 80v48c0 17.7 14.3 32 32 32H48 96V80c0-26.5-21.5-48-48-48S0 53.5 0 80zM112 32c10 13.4 16 30 16 48V384c0 35.3 28.7 64 64 64s64-28.7 64-64v-5.3c0-32.4 26.3-58.7 58.7-58.7H480V128c0-53-43-96-96-96H112zM464 480c61.9 0 112-50.1 112-112c0-8.8-7.2-16-16-16H314.7c-14.7 0-26.7 11.9-26.7 26.7V384c0 53-43 96-96 96H368h96z"
                class="fa-secondary"
              ></path>
              <path
                fill="currentColor"
                d="M0 80v48c0 17.7 14.3 32 32 32H48 96V80c0-26.5-21.5-48-48-48S0 53.5 0 80zM112 32c10 13.4 16 30 16 48V384c0 35.3 28.7 64 64 64s64-28.7 64-64v-5.3c0-32.4 26.3-58.7 58.7-58.7H480V128c0-53-43-96-96-96H112zM464 480c61.9 0 112-50.1 112-112c0-8.8-7.2-16-16-16H314.7c-14.7 0-26.7 11.9-26.7 26.7V384c0 53-43 96-96 96H368h96z"
                class="fa-primary"
              ></path>
            </g>
          </svg>
          <span class="link-text">Report Queries</span>
        </a>
      </li>

      <li class="nav-item">
        <a href="admin_message.php" class="nav-link">
          <svg
            aria-hidden="true"
            focusable="false"
            data-prefix="fad"
            data-icon="bullhorn"
            role="img"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 576 512"
            class="svg-inline--fa fa-bullhorn fa-w-18 fa-9x"
          >
            <g class="fa-group">
              <path
                fill="currentColor"
                d="M480 32c0-12.9-7.8-24.6-19.8-29.6s-25.7-2.2-34.9 6.9L381.7 53c-48 48-113.1 75-181 75H192 160 64c-35.3 0-64 28.7-64 64v96c0 35.3 28.7 64 64 64l0 128c0 17.7 14.3 32 32 32h64c17.7 0 32-14.3 32-32V352l8.7 0c67.9 0 133 27 181 75l43.6 43.6c9.2 9.2 22.9 11.9 34.9 6.9s19.8-16.6 19.8-29.6V300.4c18.6-8.8 32-32.5 32-60.4s-13.4-51.6-32-60.4V32zm-64 76.7V240 371.3C357.2 317.8 280.5 288 200.7 288H192V192h8.7c79.8 0 156.5-29.8 215.3-83.3z"
                class="fa-secondary"
              ></path>
              <path
                fill="currentColor"
                d="M480 32c0-12.9-7.8-24.6-19.8-29.6s-25.7-2.2-34.9 6.9L381.7 53c-48 48-113.1 75-181 75H192 160 64c-35.3 0-64 28.7-64 64v96c0 35.3 28.7 64 64 64l0 128c0 17.7 14.3 32 32 32h64c17.7 0 32-14.3 32-32V352l8.7 0c67.9 0 133 27 181 75l43.6 43.6c9.2 9.2 22.9 11.9 34.9 6.9s19.8-16.6 19.8-29.6V300.4c18.6-8.8 32-32.5 32-60.4s-13.4-51.6-32-60.4V32zm-64 76.7V240 371.3C357.2 317.8 280.5 288 200.7 288H192V192h8.7c79.8 0 156.5-29.8 215.3-83.3z"
                class="fa-primary"
              ></path>
            </g>
          </svg>
          <span class="link-text">Compose Announcements</span>
        </a>
      </li>
      
      <li class="nav-item">
        <a href="admin_dashboard.php" class="nav-link" onclick="">
          <svg
            aria-hidden="true"
            focusable="false"
            data-prefix="fad"
            data-icon="space-station-moon-alt"
            role="img"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 512 512"
            class="svg-inline--fa fa-space-station-moon-alt fa-w-16 fa-5x"
          >
            <g class="fa-group">
              <path
                fill="currentColor"
                d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z"
                class="fa-secondary"
              ></path>
              <path
                fill="currentColor"
                d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z"
                class="fa-primary"
              ></path>
            </g>
          </svg>
          <span class="link-text">Search Student</span>
        </a>
      </li>

      <li class="nav-item">
        <a href="#" class="nav-link" onclick="admincallmodal()">
          <svg
            aria-hidden="true"
            focusable="false"
            data-prefix="fad"
            data-icon="space-station-moon-alt"
            role="img"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 512 512"
            class="svg-inline--fa fa-space-station-moon-alt fa-w-16 fa-5x"
          >
            <g class="fa-group">
              <path
                fill="currentColor"
                d="M164.9 24.6c-7.7-18.6-28-28.5-47.4-23.2l-88 24C12.1 30.2 0 46 0 64C0 311.4 200.6 512 448 512c18 0 33.8-12.1 38.6-29.5l24-88c5.3-19.4-4.6-39.7-23.2-47.4l-96-40c-16.3-6.8-35.2-2.1-46.3 11.6L304.7 368C234.3 334.7 177.3 277.7 144 207.3L193.3 167c13.7-11.2 18.4-30 11.6-46.3l-40-96z"
                class="fa-secondary"
              ></path>
              <path
                fill="currentColor"
                d="M164.9 24.6c-7.7-18.6-28-28.5-47.4-23.2l-88 24C12.1 30.2 0 46 0 64C0 311.4 200.6 512 448 512c18 0 33.8-12.1 38.6-29.5l24-88c5.3-19.4-4.6-39.7-23.2-47.4l-96-40c-16.3-6.8-35.2-2.1-46.3 11.6L304.7 368C234.3 334.7 177.3 277.7 144 207.3L193.3 167c13.7-11.2 18.4-30 11.6-46.3l-40-96z"
                class="fa-primary"
              ></path>
            </g>
          </svg>
          <span class="link-text">Call Student</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="#" class="nav-link" id="notifbtn">
          <svg aria-hidden="true" focusable="false" data-prefix="fad" data-icon="space-station-moon-alt" role="img"
            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
            class="svg-inline--fa fa-space-station-moon-alt fa-w-16 fa-5x">
            <g class="fa-group">
              <path fill="currentColor"
                d="M224 0c-17.7 0-32 14.3-32 32V51.2C119 66 64 130.6 64 208v18.8c0 47-17.3 92.4-48.5 127.6l-7.4 8.3c-8.4 9.4-10.4 22.9-5.3 34.4S19.4 416 32 416H416c12.6 0 24-7.4 29.2-18.9s3.1-25-5.3-34.4l-7.4-8.3C401.3 319.2 384 273.9 384 226.8V208c0-77.4-55-142-128-156.8V32c0-17.7-14.3-32-32-32zm45.3 493.3c12-12 18.7-28.3 18.7-45.3H224 160c0 17 6.7 33.3 18.7 45.3s28.3 18.7 45.3 18.7s33.3-6.7 45.3-18.7zz"
                class="fa-secondary"></path>
              <path fill="currentColor"
                d="M224 0c-17.7 0-32 14.3-32 32V51.2C119 66 64 130.6 64 208v18.8c0 47-17.3 92.4-48.5 127.6l-7.4 8.3c-8.4 9.4-10.4 22.9-5.3 34.4S19.4 416 32 416H416c12.6 0 24-7.4 29.2-18.9s3.1-25-5.3-34.4l-7.4-8.3C401.3 319.2 384 273.9 384 226.8V208c0-77.4-55-142-128-156.8V32c0-17.7-14.3-32-32-32zm45.3 493.3c12-12 18.7-28.3 18.7-45.3H224 160c0 17 6.7 33.3 18.7 45.3s28.3 18.7 45.3 18.7s33.3-6.7 45.3-18.7z"
                class="fa-primary"></path>
            </g>
          </svg>
          <span class="link-text">Send Notifications</span>
        </a>
      </li>

      <li class="nav-item">
        <a href="admin_logout.php" class="nav-link">
          <svg
            aria-hidden="true"
            focusable="false"
            data-prefix="fad"
            data-icon="space-station-moon-alt"
            role="img"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 512 512"
            class="svg-inline--fa fa-space-station-moon-alt fa-w-16 fa-5x"
          >
            <g class="fa-group">
              <path
                fill="currentColor"
                d="M288 32c0-17.7-14.3-32-32-32s-32 14.3-32 32V256c0 17.7 14.3 32 32 32s32-14.3 32-32V32zM143.5 120.6c13.6-11.3 15.4-31.5 4.1-45.1s-31.5-15.4-45.1-4.1C49.7 115.4 16 181.8 16 256c0 132.5 107.5 240 240 240s240-107.5 240-240c0-74.2-33.8-140.6-86.6-184.6c-13.6-11.3-33.8-9.4-45.1 4.1s-9.4 33.8 4.1 45.1c38.9 32.3 63.5 81 63.5 135.4c0 97.2-78.8 176-176 176s-176-78.8-176-176c0-54.4 24.7-103.1 63.5-135.4z"
                class="fa-secondary"
              ></path>
              <path
                fill="currentColor"
                d="M288 32c0-17.7-14.3-32-32-32s-32 14.3-32 32V256c0 17.7 14.3 32 32 32s32-14.3 32-32V32zM143.5 120.6c13.6-11.3 15.4-31.5 4.1-45.1s-31.5-15.4-45.1-4.1C49.7 115.4 16 181.8 16 256c0 132.5 107.5 240 240 240s240-107.5 240-240c0-74.2-33.8-140.6-86.6-184.6c-13.6-11.3-33.8-9.4-45.1 4.1s-9.4 33.8 4.1 45.1c38.9 32.3 63.5 81 63.5 135.4c0 97.2-78.8 176-176 176s-176-78.8-176-176c0-54.4 24.7-103.1 63.5-135.4z"
                class="fa-primary"
              ></path>
            </g>
          </svg>
          <span class="link-text">Logout</span>
        </a>
      </li>

      

      
    </ul>
  </nav>
  <canvas id="c"></canvas>
    <div class="overlay">
      <div class="announce">

    


      <section class="cyberpunk both" id="composer" style="padding:60px 60px; background-color:#ff7f27;">
        
        <form action = "message_process.php" method="post">
        
          <?php if (isset($admins)): ?>

            <p class="cyberpunk" id="admin-name" style=" background-color:#ff7f27;">Hello admin <?= htmlspecialchars($admins["firstname"])?></p>

          <?php endif; ?>
          <h2 class="cyberpunk" style="padding:10px; color:black;">Compose An Announcement</h2>
          <textarea class="cyberpunk" id="message" name="message" rows="20" cols="10"  required></textarea>
          <input type="hidden" name = "author" id = "author" value = <?= htmlspecialchars($admins["firstname"])?>>
          <input type="hidden" name = "admin_time" id = "admin_time" value = <?= $date?>>
          <div></div>
          <button class="cybr-btn" id="submit-btn" style="color: white; ">
                  SUBMIT<span aria-hidden></span>
                  <span aria-hidden class="cybr-btn__glitch">SUBMIT</span>
                  <span aria-hidden class="cybr-btn__tag">CITE</span>
              </button>

        
        
        </form>

      </section>

    </div>
    



    <div id="notif" class="notifmodal">
        <div class="modal-content">
            <div id="emergency" class="emergency" style="background-color: orange;">
                <h4>Send Emergency Notifications</h4>
                  <div class="em-content" style="display: flex; justify-content: center; align-items: center; background-color: black;">
                    <input type="image" class="one" src="../styles/admin_user_login/192px.png">
                    <input type="image" class="two" src="../styles/admin_user_login/192px.png">
                    <input type="image" class="three" src="../styles/admin_user_login/192px.png">
                    <input type="image" class="four" src="../styles/admin_user_login/192px.png">
                  </div>
            
              </div>
            <a href="" id="closemodal">CLOSE</a>
        </div>
    </div>





    <div class="vcallmodal" id="vcallmodal">
        <div class="video">
            <div class="primary-video" id="remoteVideo"></div>
            <div class="secondary-video" id="localVideo"></div>
        </div>
        <button id="hangupbtn" class="hangupbtn" onclick="hangup()">Hang Up</button>
    </div>
    
    <div id="customModal" class="modal">
        <div id="callInfo"></div>
        <button id="acceptButton">Accept</button>
        <button id="declineButton">Decline</button>
    </div>

    <div id="admincall" class="adminCall">
        <div id="callInfo">Call a Student</div>
        <input type="text" name="studentid" id="studentid">
        <button id="callbutton" onclick="sendMessage()">Call</button>
        <button id="cancelbutton">Cancel</button>
    </div>

    <div id="userDecline" class="userDecline">
        <div id="declineInfo">Call Declined</div>
        <button id="okbutton" onclick="">OK</button>
    </div>    


    <script src="../styles/admin_dashboard/matrix.js"></script>
    <script src = "https://unpkg.com/peerjs@1.5.2/dist/peerjs.min.js"></script>
    <script src="../calljs.js"></script>
    <script>
    init(<?= htmlspecialchars($admins["id"])?>);
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


</body>
</html>