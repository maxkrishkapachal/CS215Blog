<!-- 
Max Krishka-Pachal
200526378
October 1 2024
CS 215
Assignment 2
homePage.html
-->

<?php

session_start();
require_once("db.php");

try {
    $db = new PDO($attr, $db_user, $db_pwd, $options);
} catch (PDOException $e) {
    throw new PDOException($e->getMessage(), (int)$e->getCode());
}

$query = "SELECT p.*, u.username, u.profile_photo FROM post p JOIN users u ON p.user_id = u.user_id ORDER BY post_id DESC LIMIT 20";
$stmt = $db->query($query);
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Check whether the user has logged in or not.
if (!isset($_SESSION["user_id"])) {
    header("Location: index.php");
    exit();
} else {
    $firstName = $_SESSION["first_name"];
    $lastName = $_SESSION["last_name"];
    $userid = $_SESSION["user_id"];
    $username = $_SESSION["username"];
    $profilePic = $_SESSION["profile_photo"];
}
?>

<!DOCTYPE html>
<html>

    <head>
        <title>BASECAMP - Home Page</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="description" content="the front page of basecamp before the user has logged in" />
        <link rel="stylesheet" type="text/css" href="css/styles.css" />
        <script src="js/eventHandlers.js" defer type="text/javascript"></script>
    </head>

    <body>
        <div id="container">
            <header id="header">
                <div id="logo">
                    <!-- header logo -->
                    <img src="images/LogoNoWordsNoLineTransparent.png" alt="Logo" id="logo-image" />
                    <div id="company-name">BASECAMP</div>
                </div>
                <div id="header-button-container">
                    <!-- logout button -->
                    <a href="index.php" class="button-style">Logout</a>
                </div>
            </header>

            <div id="profile" class="profile-else">
                <div class="title-text">
                    <?= htmlspecialchars($_SESSION['username']) ?>
                </div>
                <div class="button-grid">
                    <img src="<?= htmlspecialchars($_SESSION['profile_photo']) ?>" alt="Profile Picture" id="profile-picture" />
                    <a href="homePage.php" class="button-style">DISCOVER</a>
                    <a href="createPost.php" class="button-style">CREATE</a>
                    <a href="managePost.php" class="button-style">MANAGE</a>
                </div>
            </div>

            <div id="announcement-bar">
                <div class="title-text">CHECK OUT THE NEWEST POSTS:</div>
            </div>

            <div id="front-page-posts">
                <?php foreach ($posts as $post): ?>
                    <div class="preview-post" data-post=<?= htmlspecialchars($post['post_id']) ?>>
                        <img src="<?= htmlspecialchars($post['profile_photo']) ?>" alt="Profile Picture" class="post-avatar" />
                        <div class="post-username"><?= htmlspecialchars($post['username']) ?></div>
                        <div class="post-time"><?= htmlspecialchars($post['timestamp']) ?></div>
                        <div class="post-title-preview">
                            <a href="viewPost.php?post_id=<?= htmlspecialchars($post['post_id']) ?>"> <?= htmlspecialchars($post['title']) ?> </a>
                        </div>
                        <div class="post-content-preview"><?= htmlspecialchars($post['content']) ?></div>
                        <?php if ($post['post_image']): ?>
                            <img src="<?= htmlspecialchars($post['post_image']) ?>" alt="Post Image" class="post-photo-full" />
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <script src="js/eventRegisterHome.js" defer type="text/javascript"></script>
    </body>
</html>