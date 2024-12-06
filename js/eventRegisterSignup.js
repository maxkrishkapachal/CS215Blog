// Max Krishka-Pachal
// 200526378
// October 30 2024
// CS 215
// Assignment 3
// eventRegisterSignup.js

// image
let image = document.getElementById("upload-photo-button");
image.addEventListener("change", postImageHandler);

// email
// error-text-email
let email = document.getElementById("email");
email.addEventListener("blur", emailHandler);

// username
// error-text-uname
let username = document.getElementById("u-name");
username.addEventListener("blur", usernameHandler);

// password
// error-text-pword
let password = document.getElementById("p-word");
password.addEventListener("blur", passwordHandler);

// confirm password
// error-text-cpword
let cpassword = document.getElementById("confirm-pword");
cpassword.addEventListener("blur", cPasswordHandler);

// submit button
let form = document.getElementById("signup-form");
form.addEventListener("submit", validateSignup);