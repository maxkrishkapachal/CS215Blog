// Max Krishka-Pachal
// 200526378
// October 30 2024
// CS 215
// Assignment 3
// eventRegisterCreatePost.js

// title
let title = document.getElementById("post-title");
title.addEventListener("blur", postTitleHandler);

// content
let content = document.getElementById("post-text");
content.addEventListener("blur", postContentHandler);

// image
let postImage = document.getElementById("upload-photo-button");
postImage.addEventListener("change", postImageHandler);

// submit button
let form = document.getElementById("create-form");
form.addEventListener("submit", validatePost);

// dynamic counter
let blogPostTitle = document.getElementById("post-title");
blogPostTitle.addEventListener("input", (event) => charCounter(event, 100));

// dynamic counter for body text
let blogPostTextarea = document.getElementById("post-text");
blogPostTextarea.addEventListener("input", (event) => charCounter(event, 2000));