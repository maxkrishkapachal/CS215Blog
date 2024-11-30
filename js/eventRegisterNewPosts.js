

// event to check for new posts every two minutes in homePage.php
document.addEventListener("DOMContentLoaded", function () {
    setInterval(function () { checkForNewPosts(); }, 120000); // 2 minutes
});


