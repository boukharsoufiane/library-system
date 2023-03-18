<?php
session_start();
$id_membre = $_SESSION["id_membre"];
$msg="";
if (isset($_POST["Edit"])) {
  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $username = $_POST['username'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $type_membre = $_POST['type_membre'];
  $id_card = $_POST['id_card'];

  $conn = mysqli_connect("localhost", "Root", "", "library");
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  $sql = "UPDATE membre SET first_name='$first_name',last_name='$last_name',username='$username',email='$email',phone='$phone',type_membre='$type_membre',ID_card='$id_card' WHERE id_membre='$id_membre'";
  $result = mysqli_query($conn, $sql);
  if (mysqli_affected_rows($conn) > 0) {
    $msg="Your operation edit has been successful";
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
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
        <h1>Welcome !</h1>
        <p>To edit profile please enter your new personal info</p>
        <form action="Home.php">
          <button type="submit" class="switch-button" id="slide-right-button">Back To Home</button>
        </form>
      </div>
    </div>
    <div class="form">
      <div class="sign-up" id="sign-up-info">
        <h1>Edit Your Profile</h1>
        <?php
        $conn = mysqli_connect("localhost", "Root", "", "library");
        $query = "SELECT * FROM membre WHERE id_membre='$id_membre'";
        $result = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($result)) {
        ?>
          <form id="sign-up-form" method="POST">
            <div style="display: flex;">
              <input type="text" placeholder="First Name" id="first_name" name="first_name" value="<?php echo $row["first_name"] ?>" onkeyup="validName()" />
              <input type="text" placeholder="Last Name" id="last_name" value="<?php echo $row["last_name"] ?>" name="last_name" onkeyup="validPrenom()" />
            </div>

            <div style="display: flex;">
              <input type="text" placeholder="Username" name="username" value="<?php echo $row["username"] ?>" />
              <input type="email" placeholder="Email" id="email" name="email" value="<?php echo $row["email"] ?>" onkeyup="validEmail()" />
            </div>

            <div style="display: flex;">
              <input type="number" placeholder="Phone" name="phone" value="<?php echo $row["phone"] ?>" />
              <input type="text" placeholder="Identify Card" value="<?php echo $row["ID_card"] ?>" name="id_card" />
            </div>
            <select name="type_membre">
              <option value="<?php echo $row["type_membre"] ?>"><?php echo $row["type_membre"] ?></option>
              <option value="STUDENT">STUDENT</option>
              <option value="EMPLOYER">EMPLOYER</option>
              <option value="UNEMPLOYED">UNEMPLOYED</option>
            </select>
            <p style="color:green" id="message"><?php echo $msg;?></p>
            <button class="control-button up" type="submit" id="btnDisp" name="Edit">Edit</button>
          </form>

        <?php
        }



        ?>

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