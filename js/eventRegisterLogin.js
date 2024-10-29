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