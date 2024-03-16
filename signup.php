<!-- 
This file includes code from:
- Button Design by jh3y, licensed under MIT License (https://codepen.io/jh3y/pen/PoGbxLp)
- Matrix Design by Achraf Boujjou, licensed under MIT License (https://codepen.io/AchrafBoujjou/pen/RxjWXB)
- Cyberpunk Theme by gwannon, licensed under GPL v3.0 (https://codepen.io/gwannon/pen/LYjvOLK)

Modifications made by Imagine Dragons(3rd year BSIT Capstone Group Name from Phinma University of Iloilo) in 2024 to integrate into Shield-Ed+: Safety and Prevention App
-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="styles/signup/style.css">
    <script>
    function validateForm() {
      var password = document.getElementById("password")
        , password_confirm = document.getElementById("password_confirm");

      var a = document.forms["myForm"]["firstname"].value;
      if (a == "" || a == null) {
        alert("First name must be filled out");
        return false;
      }
      var b = document.forms["myForm"]["lastname"].value;
      if (b == "" || b == null) {
        alert("Last name must be filled out");
        return false;
      }
      var c = document.forms["myForm"]["email"].value;
      if (c == "" || c == null) {
        alert("email must be filled out");
        return false;
      }
      var d = document.forms["myForm"]["password"].value;
      if (d == "" || d == null) {
        alert("password must be filled out");
        return false;
      }
      var e = document.forms["myForm"]["password_confirm"].value;
      if (e == "" || e == null) {
        alert("password must be filled out");
        return false;
      }
      if (password.value != password_confirm.value) {
        alert("Password does not match.")
        return false;

      }
    }
  </script>

</head>

<body>
    <canvas id="c"></canvas>
    <div class="overlay">
        <section class="cyberpunk" style="padding: 40px 40px;">
            <h1 class="cyberpunk">Shield-ED+</h1>
            <h2 class="cyberpunk">User Registration</h2>
            <form name="myForm" action="process.php" onsubmit="return validateForm()" method="post" style="max-width:500px;" required>
                <input class="cyberpunk" type="text" name="firstname"
                placeholder="First Name" pattern="(?=.*[a-z]).{5,50}"
                title="First name must contain atleast 5 and at most 50 characters" required />
                <div></div>
                <input class="cyberpunk" type="text" name="lastname"
                placeholder="Last Name" pattern="(?=.*[a-z]).{5,50}"
                title="Last name must contain atleast 5 and at most 50 characters" required/>
                <div></div>
                <input class="cyberpunk" type="email" name="email" placeholder="Email" required/>
                <div></div>
                <input class="cyberpunk" type="password" name="password" placeholder="Password"
                pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"
                required />
                <input class="cyberpunk" type="password" name="password_confirm" placeholder="Confirm Password"
                pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"
                required />
                <input type="hidden" name="role" value="user">
                <div></div>

                <button class="cybr-btn" style="color: black; margin-top: 1em; --primary:black; color: white;">
                    Register<span aria-hidden></span>
                    <span aria-hidden class="cybr-btn__glitch">REGISTER</span>
                    <span aria-hidden class="cybr-btn__tag">CITE</span>
                </button>


            </form>
            <form action="index.html">
                <button class="cybr-btn" style="color: black; margin-top: 1em; --primary:black; color: white;">
                    BACK<span aria-hidden></span>
                    <span aria-hidden class="cybr-btn__glitch">HOME</span>
                    <span aria-hidden class="cybr-btn__tag">CITE</span>
                </button>
            </form>


        </section>
    </div>

    <script src="styles/signup/matrix.js"></script>

</body>

</html>