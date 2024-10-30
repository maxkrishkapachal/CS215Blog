// Max Krishka-Pachal
// 200526378
// October 30 2024
// CS 215
// Assignment 3
// eventRegisterLogin.js

// email
let email = document.getElementById("email");
email.addEventListener("blur", emailHandler);

// password
// error-text-pword
let password = document.getElementById("pword");
password.addEventListener("blur", passwordHandler);

// submit button
let form = document.getElementById("login-form");
form.addEventListener("submit", validateLogin);