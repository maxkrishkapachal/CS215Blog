// Max Krishka-Pachal
// 200526378
// October 30 2024
// CS 215
// Assignment 3
// eventRegisterComment.js

// comment
let comment = document.getElementById("leave-comment");
comment.addEventListener("blur", commentHandler);

// submit button
let form = document.getElementById("post-comment");
form.addEventListener("submit", validatePostComment);