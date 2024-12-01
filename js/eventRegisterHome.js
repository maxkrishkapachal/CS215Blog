
// reloading main page after two minutes
document.addEventListener("DOMContentLoaded", function () {
    setInterval(() => getNewPosts(20), 10000); // 120000 ms = 2 minutes
});