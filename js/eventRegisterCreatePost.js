// title
let title = document.getElementById("post-title");
title.addEventListener("blur", postTitleHandler);

// content
let content = document.getElementById("post-text");
content.addEventListener("blur", postContentHandler);

// submit button
let form = document.getElementById("create-form");
form.addEventListener("submit", validatePost);