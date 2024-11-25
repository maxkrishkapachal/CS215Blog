<?php
require_once("db.php");

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

try {
    $db = new PDO($attr, $db_user, $db_pwd, $options);
} catch (PDOException $e) {
    throw new PDOException($e->getMessage(), (int)$e->getCode());
}

$userId = $_SESSION['user_id'];
$query = "SELECT * FROM post WHERE user_id = $userId ORDER BY timestamp DESC";
$stmt = $db->query($query);
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>




<!DOCTYPE html>
<html>

<head>
    <title>BASECAMP - Manage Posts</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="description" content="The page where one can manage the posts they've made" />
    <link rel="stylesheet" type="text/css" href="css/styles.css" />
</head>

<body>
    <div id="container">
        <header id="header">
            <div id="logo">
                <img src="images/LogoNoWordsNoLineTransparent.png" alt="Logo" id="logo-image" />
                <div id="company-name">BASECAMP</div>
            </div>
            <div id="header-button-container">
                <a href="logout.php" class="button-style">Logout</a>
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
            <div class="title-text">Manage Your Posts</div>
        </div>

        <div id="front-page-posts">
            <?php foreach ($posts as $post): ?>
                <div class="full-post">
                    <img src="<?= htmlspecialchars($_SESSION['profile_photo']) ?>" alt="Profile Picture" class="post-avatar" />
                    <div class="post-username"> <?= htmlspecialchars($_SESSION['username']) ?> </div>
                    <div class="post-time"> <?= htmlspecialchars($post['timestamp']) ?> </div>
                    <div class="post-title-full">
                        <a href="viewPost.php?post_id=<?= htmlspecialchars($post['post_id']) ?>"> <?= htmlspecialchars($post['title']) ?> </a>
                    </div>
                    <div class="post-content-full"> <?= htmlspecialchars($post['content']) ?> </div>
                    <?php if ($post['post_image']): ?>
                        <img src="<?= htmlspecialchars($post['post_image']) ?>" alt="Post Image" class="post-photo-full" />
                    <?php endif; ?>
                </div>

                <?php
                $postId = $post['post_id'];
                $commentQuery = "SELECT c.*, u.username, u.profile_photo FROM comment c JOIN users u ON c.user_id = u.user_id WHERE c.post_id = $postId ORDER BY c.timestamp ASC";
                $commentStmt = $db->query($commentQuery);
                $comments = $commentStmt->fetchAll(PDO::FETCH_ASSOC);
                ?>

                <?php foreach ($comments as $comment): ?>
                    <div class="individual-comment">
                        <img src="<?= htmlspecialchars($comment['profile_photo']) ?>" alt="Comment Avatar" class="comment-avatar" />
                        <div class="comment-username"> <?= htmlspecialchars($comment['username']) ?> </div>
                        <div class="comment-time"> <?= htmlspecialchars($comment['timestamp']) ?> </div>
                        <div class="comment-content"> <?= htmlspecialchars($comment['content']) ?> </div>
                        <div class="comment-stats">
                            <?php
                            $commentId = $comment['comment_id'];
                            $voteQuery = "SELECT SUM(updown) as up_votes, COUNT(updown) - SUM(updown) as down_votes FROM vote WHERE comment_id = $commentId";
                            $voteStmt = $db->query($voteQuery);
                            $votes = $voteStmt->fetch(PDO::FETCH_ASSOC);
                            ?>
                            <div class="vote-style">+<?= htmlspecialchars($votes['up_votes']) ?></div>
                            <div class="vote-style">-<?= htmlspecialchars($votes['down_votes']) ?></div>
                        </div>
                    </div>
                <?php endforeach; ?>

                <hr />
            <?php endforeach; ?>
        </div>
    </div>
</body>

</html>

<?php
$db = null;
?>