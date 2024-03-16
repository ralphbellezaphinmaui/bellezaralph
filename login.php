<!-- 
This file includes code from:
- Button Design by jh3y, licensed under MIT License (https://codepen.io/jh3y/pen/PoGbxLp)
- Matrix Design by Achraf Boujjou, licensed under MIT License (https://codepen.io/AchrafBoujjou/pen/RxjWXB)
- Cyberpunk Theme by gwannon, licensed under GPL v3.0 (https://codepen.io/gwannon/pen/LYjvOLK)

Modifications made by Imagine Dragons(3rd year BSIT Capstone Group Name from Phinma University of Iloilo) in 2024 to integrate into Shield-Ed+: Safety and Prevention App
-->


<?php



$is_invalid = false;
if ($_SERVER["REQUEST_METHOD"] === "POST"){
    $mysqli = require __DIR__ . "/connect.php";

    $sql = sprintf("SELECT * FROM users
                    WHERE email = '%s'",
                    $mysqli->real_escape_string($_POST["email"]));
    $result = $mysqli->query($sql);
    $users = $result->fetch_assoc();

    if($users){
        if(password_verify($_POST["password"],$users["password_hash"])){
            session_start();

            session_regenerate_id();
            
            $_SESSION["users_id"] = $users["id"];
            header("Location: report.php");
            exit;
        }
    }
    $is_invalid = true;

}

session_start();


 
if (isset($_SESSION["users_id"])){
    $mysqli = require __DIR__ . "/connect.php";

    $sql = "SELECT * FROM users
            WHERE id = {$_SESSION["users_id"]}";
    $result = $mysqli->query($sql);

    $users = $result->fetch_assoc();

    header("Location: report.php");
}






?>



<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="styles/admin_user_login/style.css">
  <style>
    .login-validation{
      text-align: center;
      color: red;
      
    }

  </style>
</head>
<body>
  <canvas id="c"></canvas>
  <div class="overlay">
    <img src="styles/admin_user_login/192px.png" alt="">
    

    <section class="cyberpunk both" id="login">
      
      <h2 style="color: black;" class="cyberpunk">Shield-ED+: Safety & Prevention App</h2>
      <form style="max-width: 500px" method="post" required>
        <input class="cyberpunk" type="email" name="email" placeholder="Email" value = "<?= htmlspecialchars($_POST["email"] ?? "") ?>"/>
        <input class="cyberpunk" type="password" name="password" placeholder="Password"/>

        <button class="cybr-btn">
          Login<span aria-hidden></span>
          <span aria-hidden class="cybr-btn__glitch">LOGIN</span>
          <span aria-hidden class="cybr-btn__tag">CITE</span>
        </button>
      </form>
      <div style="height: 0.5rem;"></div>
      <form action="index.html">
        <button class="cybr-btn">
          Register<span aria-hidden></span>
          <span aria-hidden class="cybr-btn__glitch">REGISTER</span>
          <span aria-hidden class="cybr-btn__tag">CITE</span>
        </button>
      </form>
      
      <?php if ($is_invalid): ?>
        <em>email or password does not match</em>

      <?php endif; ?>

      <h2 style="color: black;" class="glitched">User Login</h2>
    </section>
    
  </div>
  
  
  <script src="styles/admin_user_login/matrix.js"></script>

  

  
  
  
</body>
</html>
