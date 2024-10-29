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

// profile picture
// error-text-avatar
let avatar = document.getElementById("upload-photo-button");
avatar.addEventListener("blur", avatarHandler);

// submit button
let form = document.getElementById("signup-form");
form.addEventListener("submit", validateSignup);