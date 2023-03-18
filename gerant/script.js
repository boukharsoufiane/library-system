var overlay = document.getElementById("overlay");

// Buttons to 'switch' the page
var openSignUpButton = document.getElementById("slide-left-button");
var openSignInButton = document.getElementById("slide-right-button");

// The sidebars
var leftText = document.getElementById("sign-in");
var rightText = document.getElementById("sign-up");

// The forms
var accountForm = document.getElementById("sign-in-info")
var signinForm = document.getElementById("sign-up-info");

// Open the Sign Up page
openSignUp = () => {
  // Remove classes so that animations can restart on the next 'switch'
  leftText.classList.remove("overlay-text-left-animation-out");
  overlay.classList.remove("open-sign-in");
  rightText.classList.remove("overlay-text-right-animation");
  // Add classes for animations
  accountForm.className += " form-left-slide-out"
  rightText.className += " overlay-text-right-animation-out";
  overlay.className += " open-sign-up";
  leftText.className += " overlay-text-left-animation";
  // hide the sign up form once it is out of view
  setTimeout(function () {
    accountForm.classList.remove("form-left-slide-in");
    accountForm.style.display = "none";
    accountForm.classList.remove("form-left-slide-out");
  }, 700);
  // display the sign in form once the overlay begins moving right
  setTimeout(function () {
    signinForm.style.display = "flex";
    signinForm.classList += " form-right-slide-in";
  }, 200);
}

// Open the Sign In page
openSignIn = () => {
  // Remove classes so that animations can restart on the next 'switch'
  leftText.classList.remove("overlay-text-left-animation");
  overlay.classList.remove("open-sign-up");
  rightText.classList.remove("overlay-text-right-animation-out");
  // Add classes for animations
  signinForm.classList += " form-right-slide-out";
  leftText.className += " overlay-text-left-animation-out";
  overlay.className += " open-sign-in";
  rightText.className += " overlay-text-right-animation";
  // hide the sign in form once it is out of view
  setTimeout(function () {
    signinForm.classList.remove("form-right-slide-in")
    signinForm.style.display = "none";
    signinForm.classList.remove("form-right-slide-out")
  }, 700);
  // display the sign up form once the overlay begins moving left
  setTimeout(function () {
    accountForm.style.display = "flex";
    accountForm.classList += " form-left-slide-in";
  }, 200);
}

// When a 'switch' button is pressed, switch page
openSignUpButton.addEventListener("click", openSignUp, false);
openSignInButton.addEventListener("click", openSignIn, false);



function validName() {
  let nom = document.getElementById('first_name').value;
  let button = document.getElementById('btnDisp');
  let regName = /^[a-zA-Z]{3,30}$/;
  if (regName.test(nom) === false) {
      document.getElementById('first_name').style.border = '3px solid red';
      document.getElementById('first_name').style.background = 'rgb(248, 147, 147)';
      button.disabled = true;
  }
  else {
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

  }
  else {
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

  }
  else {
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

  }
  else {
      document.getElementById('password').style.border = '3px solid red';
      document.getElementById('password').style.background = 'rgb(248, 147, 147)';
      document.getElementById('return4').innerHTML = "Please enter minimum eight characters,at least one letter, one number and one special character";
      document.getElementById('return4').style.color = "red";
      button.disabled = true;

  }
  document.getElementById('validPassword').onkeyup = function () {
      let validPassword = document.getElementById('validPassword').value;
      
      if (validPassword == password) {
          document.getElementById('validPassword').style.border = '3px solid green';
          document.getElementById('validPassword').style.background = 'rgb(130, 246, 130)';
          button.disabled = false;


      }
      else {
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
