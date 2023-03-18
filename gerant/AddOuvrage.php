<?php
session_start();

if (isset($_POST["add"])) {
  $name_ouvrage = $_POST["name_ouvrage"];
  $state_ouvrage = $_POST["state_ouvrage"];
  $date_achat = $_POST["date_achat"];
  $date_edition = $_POST["date_edition"];
  $type_ouvrage = $_POST["type_ouvrage"];
  $pages_ouvrage = $_POST["pages_ouvrage"];
  $quantity = $_POST['quantity'];
  $id_gerant = $_SESSION["id_gerant"];

  $image = $_FILES['image_main']['name'];
  $tmp_name = $_FILES['image_main']['tmp_name'];
  $gerant_folder = "images/" . $image;
  // move_uploaded_file($tmp_name, $gerant_folder);

  $client_folder = "library/client/images/" . $image;
  // move_uploaded_file($tmp_name, $client_folder);




  $conn = mysqli_connect("localhost", "Root", "", "library");

  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  if (!empty($pages_ouvrage)) {
    $sql = "INSERT INTO ouvrage (name_ouvrage, state_ouvrage, date_achat, date_edition, type_ouvrage, pages_ouvrage, image_main) VALUES ";
    $values = array();
    for ($i = 0; $i < $quantity; $i++) {
      $values[] = "('$name_ouvrage','$state_ouvrage','$date_achat','$date_edition','$type_ouvrage','$pages_ouvrage','$gerant_folder')";
    }
    $sql .= implode(",", $values);
  } else {
    $sql = "INSERT INTO ouvrage (name_ouvrage, state_ouvrage, date_achat, date_edition, type_ouvrage, pages_ouvrage, image_main) VALUES ";
    $values = array();
    for ($i = 0; $i < $quantity; $i++) {
      $values[] = "('$name_ouvrage','$state_ouvrage','$date_achat','$date_edition','$type_ouvrage','0','$gerant_folder')";
    }
    $sql .= implode(",", $values);
  }




  if (mysqli_query($conn, $sql)) {
    $id_ouvrage = mysqli_insert_id($conn);
    $query = "INSERT INTO gestion (id_ouvrage, id_gerant, type_operation, date_operation) VALUES('$id_ouvrage','$id_gerant', 'Addition', NOW())";

    if (mysqli_query($conn, $query)) {
      header("Location:index.php");
    } else {
      echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
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
</head>

<body>



  <div class="container">
    <div class="overlay" id="overlay">
      <div class="sign-in" id="sign-in">
        <h1>Welcome Back!</h1>
        <p>To add new book or other thing please enter info of the book</p>
        <form action="index.php">
          <button class="control-button up" type="submit" style="background-color: #efebeb;color:#717fe0">Back to Home</button>
        </form>

      </div>
    </div>
    <div class="form">
      <div class="sign-up" id="sign-up-info">
        <h1 style="margin-bottom: 2%;">Add New Book</h1>
        <form id="sign-up-form" method="post" enctype="multipart/form-data">
          <input type="text" placeholder="Name" name="name_ouvrage" />
          <input type="date" placeholder="Date of buy" name="date_achat" />
          <input type="date" placeholder="Date of edition" name="date_edition" />
          <div style="display: flex;margin-left:22%">
            <select name="state_ouvrage">
              <option selected>STATE</option>
              <option value="EXCELLENT">EXCELLENT</option>
              <option value="MEDUIM">MEDUIM</option>
            </select>
            <select name="type_ouvrage" style="margin-left: 3%;" onchange="showType(this)">
              <option selected>TYPE</option>
              <option value="BOOK">BOOK</option>
              <option value="CD">CD</option>
              <option value="NOVEL">NOVEL</option>
              <option value="MAGAZINE">MAGAZINE</option>
            </select>
          </div>

          <input type="number" id="pages" style="display: none;margin-left:15%" placeholder="Pages" name="pages_ouvrage" />
          <input type="file" name="image_main" />
          <input type="number" placeholder="Quantity" name="quantity" />
          <button class="control-button up" type="submit" name="add">Add Book</button>
        </form>
      </div>
    </div>
  </div>

  <style>
    :root {
      --form-height: 650px;
      --form-width: 900px;
      --left-color: #7A1616 !important;
      --right-color: #a94141 !important;
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

    select {
      padding: 10px;
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
    function showType(selectElem) {
      if (selectElem.value === "BOOK" || selectElem.value === "NOVEL" || selectElem.value === "MAGAZINE") {
        document.getElementById("pages").style.display = "block";
      } else {
        document.getElementById("pages").style.display = "none";
      }
    }
  </script>

</body>

</html>