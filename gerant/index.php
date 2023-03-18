<?php
$msgSign="";
if (isset($_POST['signup'])) {
  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $email = $_POST['email'];
  $password_system='book-hous2023';
  $password = $_POST['password'];
  $Hashed_password = password_hash($password, PASSWORD_DEFAULT);
  $Hashed_password_system = password_hash($password_system, PASSWORD_DEFAULT);



  $conn = mysqli_connect("localhost", "Root", "", "library");
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  if(!empty($first_name)||!empty($last_name) ||!empty($email)||!empty($password)){
    $sql = "INSERT INTO gerant (first_name, last_name, email,password_system, password) VALUES ('$first_name', '$last_name', '$email','$Hashed_password_system', '$Hashed_password')";
    if ($conn->query($sql) === TRUE) {
      header("refresh:0");
      exit();
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
  
    $conn->close();
  }else{
    $msgSign="Please enter all your information";
  }

 
}
?>

<?php

session_start();
$msg = "";

if (isset($_POST['signin'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];
  $password_system = $_POST["password_system"];

  $conn = mysqli_connect("localhost", "Root", "", "library");

  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  if (!empty($email) && !empty($password) && !empty($password_system)) {
    $sql = "SELECT * FROM gerant WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
      $row = mysqli_fetch_assoc($result);

      if (password_verify($password, $row['password']) && password_verify($password_system, $row['password_system'])) {
        $_SESSION["id_gerant"] = $row["id_gerant"];
        $_SESSION["email"] = $row["email"];
        $_SESSION["first_name"] = $row["first_name"];
        $_SESSION["last_name"] = $row["last_name"];

        $id_gerant = $_SESSION["id_gerant"];
        $first_name = $_SESSION["first_name"];
        $last_name = $_SESSION["last_name"];

        header("Location: home.php");
        exit();
      } else {
        echo "Invalid email or password";
      }
    } else {
      echo "Cannot login please check your connection and try again.";
    }
  } else {
    $msg = "Please enter all information";
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
        <p>To keep connected with your system please login with your personal info</p>
        <button class="switch-button" id="slide-right-button">Sign In</button>
      </div>
      <div class="sign-up" id="sign-up">
        <h1>Hello, Manager</h1>
        <p>Enter your personal details and start your system</p>
        <button class="switch-button" id="slide-left-button">Sign Up</button>
      </div>
    </div>
    <div class="form">
      <div class="sign-in" id="sign-in-info">
        <h1>Sign In</h1>
        <form id="sign-in-form" method="post">
          <input type="email" name="email" placeholder="Email" />
          <input type="password" name="password" placeholder="Password" />
          <input type="password" name="password_system" placeholder="System Password" />
          <p class="forgot-password">Forgot your password?</p>
          <p style="color:red;"><?php echo $msg;?></p>
          <button class="control-button in" name="signin">Sign In</button>
        </form>
      </div>
      <div class="sign-up" id="sign-up-info">
        <h1>Create Account</h1>
        <form id="sign-up-form" method="post">
          <input type="text" name="first_name" id="first_name" placeholder="First name" onkeyup="validName()" />
          <input type="text" name="last_name" id="last_name" placeholder="Last name" onkeyup="validPrenom()" />
          <input type="email" name="email" id="email" placeholder="Email" onkeyup="validEmail()" />
          <input type="password" name="password" id="password" placeholder="Password" onkeyup="passwordReg()" />
          <p id="return4" style="font-size: 8px;"></p>
          <input type="password" placeholder="Repeat Password" id="validPassword" />
          <p style="color:red;"><?php echo $msgSign;?></p>
          <button class="control-button up" id="btnDisp" type="submit" name="signup">Sign Up</button>
        </form>
      </div>
    </div>
  </div>

  <script src="./script.js"></script>
  <script>

  </script>

</body>

</html>