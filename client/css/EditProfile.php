<?php
$msg="";
if (isset($_POST["signup"])) {
  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $username = $_POST['username'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $type_membre = $_POST['type_membre'];
  $id_card = $_POST['id_card'];
  $password = $_POST['password'];
  $Hashed_password = password_hash($password, PASSWORD_DEFAULT);

  $conn = mysqli_connect("localhost", "Root", "", "library");
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
  $sql_email="SELECT email,ID_card FROM membre";
  $result_email = mysqli_query($conn,$sql_email);
  $row_email=mysqli_fetch_assoc($result_email);
  if($email == $row_email["email"] || $id_card == $row_email["ID_card"]){
    $msg = "Email or ID Card is already use it";
  }else{
    $sql = "INSERT INTO membre (first_name, last_name, username, email, phone, type_membre, ID_card, date_inscription, banned, password) VALUES ('$first_name', '$last_name', '$username', '$email', '$phone', '$type_membre', '$id_card', NOW(), 0, '$Hashed_password')";
    $result = mysqli_query($conn, $sql);
    if (mysqli_affected_rows($conn) > 0) {
      header("refresh:0");
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    mysqli_close($conn);
  }
}

?>

<?php
if (isset($_POST["signin"])) {
  $username = $_POST['email'];
  $password = $_POST['password'];
  $conn = mysqli_connect("localhost", "Root", "", "library");

  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  $sql = "SELECT id_membre, first_name,last_name, password, banned FROM membre WHERE username = '$username' OR email = '$username'";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
    if (password_verify($password, $row['password'])) {
      if ($row['banned'] >= 4) {
        header("Location:banned.php");
      } else {
        session_start();
        $_SESSION['id_membre'] = $row['id_membre'];
        $_SESSION['first_name'] = $row['first_name'];
        $_SESSION['last_name'] = $row['last_name'];
        header("Location:index.php");
        exit();
      }
    } else {
      echo "Invalid username or password";
    }
  } else {
    echo "Invalid username or password";
  }

  mysqli_close($conn);
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BOOK-HOUSE</title>
  <link rel="stylesheet" href="styles.css">
</head>

<body>
  <div class="container">
    <div class="overlay" id="overlay">
      <div class="sign-in" id="sign-in">
        <h1>Welcome Back!</h1>
        <p>To keep connected with us please login with your personal info</p>
        <button class="switch-button" id="slide-right-button">Sign In</button>
      </div>
      <div class="sign-up" id="sign-up">
        <h1>Hello, Friend!</h1>
        <p>Enter your personal details and start a journey with us</p>
        <button class="switch-button" id="slide-left-button">Sign Up</button>
      </div>
    </div>
    <div class="form">
      <div class="sign-in" id="sign-in-info">
        <h1>Sign In</h1>
        <div class="social-media-buttons">
          <div class="icon">
            <svg viewBox="0 0 24 24">
              <path fill="#000000" d="M17,2V2H17V6H15C14.31,6 14,6.81 14,7.5V10H14L17,10V14H14V22H10V14H7V10H10V6A4,4 0 0,1 14,2H17Z" />
            </svg>
          </div>
          <div class="icon">
            <svg viewBox="0 0 24 24">
              <path fill="#000000" d="M23,11H21V9H19V11H17V13H19V15H21V13H23M8,11V13.4H12C11.8,14.4 10.8,16.4 8,16.4C5.6,16.4 3.7,14.4 3.7,12C3.7,9.6 5.6,7.6 8,7.6C9.4,7.6 10.3,8.2 10.8,8.7L12.7,6.9C11.5,5.7 9.9,5 8,5C4.1,5 1,8.1 1,12C1,15.9 4.1,19 8,19C12,19 14.7,16.2 14.7,12.2C14.7,11.7 14.7,11.4 14.6,11H8Z" />
            </svg>
          </div>
          <div class="icon">
            <svg viewBox="0 0 24 24">
              <path fill="#000000" d="M21,21H17V14.25C17,13.19 15.81,12.31 14.75,12.31C13.69,12.31 13,13.19 13,14.25V21H9V9H13V11C13.66,9.93 15.36,9.24 16.5,9.24C19,9.24 21,11.28 21,13.75V21M7,21H3V9H7V21M5,3A2,2 0 0,1 7,5A2,2 0 0,1 5,7A2,2 0 0,1 3,5A2,2 0 0,1 5,3Z" />
            </svg>
          </div>
        </div>
        <p class="small">or use your email account:</p>
        <form id="sign-in-form" method="post">
          <div>
            <input type="text" placeholder="Email or Username" name="email" />
            <input type="password" placeholder="Password" name="password" />
          </div>

          <p class="forgot-password">Forgot your password?</p>
          <button class="control-button in" type="submit" name="signin">Sign In</button>
        </form>
      </div>
      <div class="sign-up" id="sign-up-info">
        <h1>Create Account</h1>
        <div class="social-media-buttons">
          <div class="icon">
            <svg viewBox="0 0 24 24">
              <path fill="#000000" d="M17,2V2H17V6H15C14.31,6 14,6.81 14,7.5V10H14L17,10V14H14V22H10V14H7V10H10V6A4,4 0 0,1 14,2H17Z" />
            </svg>
          </div>
          <div class="icon">
            <svg viewBox="0 0 24 24">
              <path fill="#000000" d="M23,11H21V9H19V11H17V13H19V15H21V13H23M8,11V13.4H12C11.8,14.4 10.8,16.4 8,16.4C5.6,16.4 3.7,14.4 3.7,12C3.7,9.6 5.6,7.6 8,7.6C9.4,7.6 10.3,8.2 10.8,8.7L12.7,6.9C11.5,5.7 9.9,5 8,5C4.1,5 1,8.1 1,12C1,15.9 4.1,19 8,19C12,19 14.7,16.2 14.7,12.2C14.7,11.7 14.7,11.4 14.6,11H8Z" />
            </svg>
          </div>
          <div class="icon">
            <svg viewBox="0 0 24 24">
              <path fill="#000000" d="M21,21H17V14.25C17,13.19 15.81,12.31 14.75,12.31C13.69,12.31 13,13.19 13,14.25V21H9V9H13V11C13.66,9.93 15.36,9.24 16.5,9.24C19,9.24 21,11.28 21,13.75V21M7,21H3V9H7V21M5,3A2,2 0 0,1 7,5A2,2 0 0,1 5,7A2,2 0 0,1 3,5A2,2 0 0,1 5,3Z" />
            </svg>
          </div>
        </div>
        <p class="small">or use your email for registration:</p>
        <form id="sign-up-form" method="POST">
          <div style="display: flex;">
            <input type="text" placeholder="First Name" id="first_name" name="first_name" onkeyup="validName()" />
            <input type="text" placeholder="Last Name" id="last_name" name="last_name" onkeyup="validPrenom()" />
          </div>

          <div style="display: flex;">
            <input type="text" placeholder="Username" name="username" />
            <input type="email" placeholder="Email" id="email" name="email" onkeyup="validEmail()" />
          </div>

          <div style="display: flex;">
            <input type="number" placeholder="Phone" name="phone" />
            <input type="text" placeholder="Identify Card" name="id_card" />
          </div>

          <div style="display: flex;">
            <input type="password" placeholder="Password" id="password" name="password" onkeyup="passwordReg()" />
            <input type="password" placeholder="Repeat Password" id="validPassword" />
          </div>
          <select name="type_membre">
            <option selected>STATE</option>
            <option value="STUDENT">STUDENT</option>
            <option value="EMPLOYER">EMPLOYER</option>
            <option value="UNEMPLOYED">UNEMPLOYED</option>
          </select>
          <p style="color:red" id="message"><?php echo $msg;?></p>
          <button class="control-button up" type="submit" id="btnDisp" name="signup">Sign Up</button>
        </form>
      </div>
    </div>
  </div>
  <style>
    :root {
      --form-height: 550px;
      --form-width: 1050px;
      --left-color: #6c7ae0;
      --right-color: #818de4;

    }

    body,
    html {
      width: 100%;
      height: 100%;
      margin: 0;
      font-family: 'Helvetica Neue', sans-serif;
      letter-spacing: 0.5px;
    }

    .container {
      width: var(--form-width);
      height: var(--form-height);
      position: relative;
      margin: auto;
      box-shadow: 2px 10px 40px rgba(22, 20, 19, 0.4);
      border-radius: 10px;
      margin-top: 50px;
    }

    select {
      padding: 10px;
    }

    /* 
----------------------
      Overlay
----------------------
*/
    .overlay {
      width: 100%;
      height: 100%;
      position: absolute;
      z-index: 100;
      background-image: linear-gradient(to right, var(--left-color), var(--right-color));
      border-radius: 10px;
      color: white;
      clip: rect(0, 385px, var(--form-height), 0);
    }

    .open-sign-up {
      animation: slideleft 1s linear forwards;
    }

    .open-sign-in {
      animation: slideright 1s linear forwards;
    }

    .overlay .sign-in,
    .overlay .sign-up {
      /*  Width is 385px - padding  */
      --padding: 50px;
      width: calc(385px - var(--padding) * 2);
      height: 100%;
      display: flex;
      justify-content: center;
      flex-direction: column;
      align-items: center;
      padding: 0px var(--padding);
      text-align: center;
    }

    .overlay .sign-in {
      float: left;
    }

    .overlay-text-left-animation {
      animation: text-slide-in-left 1s linear;
    }

    .overlay-text-left-animation-out {
      animation: text-slide-out-left 1s linear;
    }

    .overlay .sign-up {
      float: right;
    }

    .overlay-text-right-animation {
      animation: text-slide-in-right 1s linear;
    }

    .overlay-text-right-animation-out {
      animation: text-slide-out-right 1s linear;
    }


    .overlay h1 {
      margin: 0px 5px;
      font-size: 2.1rem;
    }

    .overlay p {
      margin: 20px 0px 30px;
      font-weight: 200;
    }

    /* 
------------------------
      Buttons
------------------------
*/
    .switch-button,
    .control-button {
      cursor: pointer;
      display: block;
      margin-left: auto;
      margin-right: auto;
      width: 140px;
      height: 40px;
      font-size: 14px;
      text-transform: uppercase;
      background: none;
      border-radius: 20px;
      color: white;
    }

    .switch-button {
      border: 2px solid;
    }

    .control-button {
      border: none;
      margin-top: 15px;
    }

    .switch-button:focus,
    .control-button:focus {
      outline: none;
    }

    .control-button.up {
      background-color: var(--left-color);
    }

    .control-button.in {
      background-color: var(--right-color);
    }

    /* 
--------------------------
      Forms
--------------------------
*/
    .form {
      width: 100%;
      height: 100%;
      position: absolute;
      border-radius: 10px;
    }

    .form .sign-in,
    .form .sign-up {
      --padding: 50px;
      position: absolute;
      /*  Width is 100% - 385px - padding  */
      width: calc(var(--form-width) - 385px - var(--padding) * 2);
      height: 100%;
      display: flex;
      justify-content: center;
      flex-direction: column;
      align-items: center;
      padding: 0px var(--padding);
      text-align: center;
    }

    /* Sign in is initially not displayed */
    .form .sign-in {
      display: none;
    }

    .form .sign-in {
      left: 0;
    }

    .form .sign-up {
      right: 0;
    }

    .form-right-slide-in {
      animation: form-slide-in-right 1s;
    }

    .form-right-slide-out {
      animation: form-slide-out-right 1s;
    }

    .form-left-slide-in {
      animation: form-slide-in-left 1s;
    }

    .form-left-slide-out {
      animation: form-slide-out-left 1s;
    }

    .form .sign-in h1 {
      color: var(--right-color);
      margin: 0;
    }

    .form .sign-up h1 {
      color: var(--left-color);
      margin: 0;
    }

    .social-media-buttons {
      display: flex;
      justify-content: center;
      width: 100%;
      margin: 15px;
    }

    .social-media-buttons .icon {
      width: 40px;
      height: 40px;
      border: 1px solid #dadada;
      border-radius: 100%;
      display: flex;
      justify-content: center;
      align-items: center;
      margin: 10px 7px;
    }

    .small {
      font-size: 13px;
      color: grey;
      font-weight: 200;
      margin: 5px;
    }

    .social-media-buttons .icon svg {
      width: 25px;
      height: 25px;
    }

    #sign-in-form input,
    #sign-up-form input {
      margin: 12px;
      font-size: 14px;
      padding: 15px;
      width: 260px;
      font-weight: 300;
      border: none;
      background-color: #e4e4e494;
      font-family: 'Helvetica Neue', sans-serif;
      letter-spacing: 1.5px;
      padding-left: 20px;
    }

    #sign-in-form input::placeholder {
      letter-spacing: 1px;
    }

    .forgot-password {
      font-size: 12px;
      display: inline-block;
      border-bottom: 2px solid #efebeb;
      padding-bottom: 3px;
    }

    .forgot-password:hover {
      cursor: pointer;
    }

    /* 
---------------------------
    Animation
---------------------------
*/
    @keyframes slideright {
      0% {
        clip: rect(0, 385px, var(--form-height), 0);
      }

      30% {
        clip: rect(0, 480px, var(--form-height), 0);
      }

      /*  we want the width to be slightly larger here  */
      50% {
        clip: rect(0px, calc(var(--form-width) / 2 + 480px / 2), var(--form-height), calc(var(--form-width) / 2 - 480px / 2));
      }

      80% {
        clip: rect(0px, var(--form-width), var(--form-height), calc(var(--form-width) - 480px));
      }

      100% {
        clip: rect(0px, var(--form-width), var(--form-height), calc(var(--form-width) - 385px));
      }
    }

    @keyframes slideleft {
      100% {
        clip: rect(0, 385px, var(--form-height), 0);
      }

      70% {
        clip: rect(0, 480px, var(--form-height), 0);
      }

      /*  we want the width to be slightly larger here  */
      50% {
        clip: rect(0px, calc(var(--form-width) / 2 + 480px / 2), var(--form-height), calc(var(--form-width) / 2 - 480px / 2));
      }

      30% {
        clip: rect(0px, var(--form-width), var(--form-height), calc(var(--form-width) - 480px));
      }

      0% {
        clip: rect(0px, var(--form-width), var(--form-height), calc(var(--form-width) - 385px));
      }
    }

    @keyframes text-slide-in-left {
      0% {
        padding-left: 20px;
      }

      100% {
        padding-left: 50px;
      }
    }

    @keyframes text-slide-in-right {
      0% {
        padding-right: 20px;
      }

      100% {
        padding-right: 50px;
      }
    }

    @keyframes text-slide-out-left {
      0% {
        padding-left: 50px;
      }

      100% {
        padding-left: 20px;
      }
    }

    @keyframes text-slide-out-right {
      0% {
        padding-right: 50px;
      }

      100% {
        padding-right: 20px;
      }
    }

    @keyframes form-slide-in-right {
      0% {
        padding-right: 100px;
      }

      100% {
        padding-right: 50px;
      }
    }

    @keyframes form-slide-in-left {
      0% {
        padding-left: 100px;
      }

      100% {
        padding-left: 50px;
      }
    }

    @keyframes form-slide-out-right {
      0% {
        padding-right: 50px;
      }

      100% {
        padding-right: 80px;
      }
    }

    @keyframes form-slide-out-left {
      0% {
        padding-left: 50px;
      }

      100% {
        padding-left: 80px;
      }
    }
  </style>

  <script src="./script.js"></script>
  <script>
    function validName() {
      let nom = document.getElementById('first_name').value;
      let button = document.getElementById('btnDisp');
      let regName = /^[a-zA-Z]{3,30}$/;
      if (regName.test(nom) === false) {
        document.getElementById('first_name').style.border = '3px solid red';
        document.getElementById('first_name').style.background = 'rgb(248, 147, 147)';
        button.disabled = true;
      } else {
        document.getElementById('first_name').style.border = '3px solid green';
        document.getElementById('first_name').style.background = 'rgb(130, 246, 130)';

      }
    }

    function validPrenom() {
      let prenom = document.getElementById('last_name').value;
      let regName = /^[a-zA-Z]{3,30}$/;
      let button = document.getElementById('btnDisp');

      if (regName.test(prenom) === false) {
        document.getElementById('last_name').style.border = '3px solid red';
        document.getElementById('last_name').style.background = 'rgb(248, 147, 147)';
        button.disabled = true;

      } else {
        document.getElementById('last_name').style.border = '3px solid green';
        document.getElementById('last_name').style.background = 'rgb(130, 246, 130)';
      }
    }


    function validEmail() {
      let email = document.getElementById('email').value;
      let button = document.getElementById('btnDisp');
      let validRegex = /^[a-zA-Z]+[a-zA-Z-._]+[@]+[a-zA-Z]+\.+(com)$/;

      if (validRegex.test(email)) {
        document.getElementById('email').style.border = '3px solid green';
        document.getElementById('email').style.background = 'rgb(130, 246, 130)';

      } else {
        document.getElementById('email').style.border = '3px solid red';
        document.getElementById('email').style.background = 'rgb(248, 147, 147)';
        button.disabled = true;

      }
    }



    function passwordReg() {
      let password = document.getElementById('password').value;
      let regexPass = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!.%*#?&])[A-Za-z\d@$!.%*#?&]{8,}$/;
      let button = document.getElementById('btnDisp');

      if (regexPass.test(password)) {
        document.getElementById('password').style.border = '3px solid green';
        document.getElementById('password').style.background = 'rgb(130, 246, 130)';

      } else {
        document.getElementById('password').style.border = '3px solid red';
        document.getElementById('password').style.background = 'rgb(248, 147, 147)';
        document.getElementById('return4').innerHTML = "Please enter minimum eight characters,at least one letter, one number and one special character";
        document.getElementById('return4').style.color = "red";
        button.disabled = true;

      }
      document.getElementById('validPassword').onkeyup = function() {
        let validPassword = document.getElementById('validPassword').value;

        if (validPassword == password) {
          document.getElementById('validPassword').style.border = '3px solid green';
          document.getElementById('validPassword').style.background = 'rgb(130, 246, 130)';
          button.disabled = false;


        } else {
          document.getElementById('validPassword').style.border = '3px solid red';
          document.getElementById('validPassword').style.background = 'rgb(248, 147, 147)';
          button.disabled = true;

        }

      }
    }








    function checkInputs() {
      // Get input elements and submit button element
      const input1 = document.getElementById("first_name");
      const input2 = document.getElementById("last_name");
      const input3 = document.getElementById("phone");
      const input4 = document.getElementById("email");
      const input5 = document.getElementById("password");
      const input6 = document.getElementById("validPassword");

      const btnDisplay = document.getElementById("btnDisp");

      // Check if any input field is empty
      if (input1.value.trim() === "" || input2.value.trim() === "" || input3.value.trim() === "" || input4.value.trim() === "" || input5.value.trim() === "" || input6.value.trim() === "") {
        btnDisplay.disabled = true;
      } else {
        btnDisplay.disabled = true;
      }
    }
  </script>

</body>

</html>