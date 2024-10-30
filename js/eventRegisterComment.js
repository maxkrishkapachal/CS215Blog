// comment
let comment = document.getElementById("leave-comment");
comment.addEventListener("blur", commentHandler);

// submit button
let form = document.getElementById("post-comment");
form.addEventListener("submit", validatePostComment);