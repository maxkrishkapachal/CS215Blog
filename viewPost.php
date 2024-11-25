<!-- 
Max Krishka-Pachal
200526378
October 1 2024
CS 215
Assignment 2
viewPost.html
-->

<?php
require_once("db.php");

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$postId = $_GET['post_id'];

try {
    $db = new PDO($attr, $db_user, $db_pwd, $options);
} catch (PDOException $e) {
    throw new PDOException($e->getMessage(), (int)$e->getCode());
}

// Retrieve post details
$query = "SELECT p.*, u.username, u.profile_photo FROM post p JOIN users u ON p.user_id = u.user_id WHERE p.post_id = $postId";
$stmt = $db->query($query);
$post = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$post) {
    echo "Post not found.";
    exit();
}

// Retrieve comments
$commentQuery = "SELECT c.*, u.username, u.profile_photo, (SELECT SUM(updown) FROM vote WHERE comment_id = c.comment_id) as vote_score FROM comment c JOIN users u ON c.user_id = u.user_id WHERE c.post_id = $postId ORDER BY vote_score DESC, c.timestamp ASC";
$commentStmt = $db->query($commentQuery);
$comments = $commentStmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>

<head>
    <title>BASECAMP - View Post</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="description" content="The page to view a specific post" />
    <link rel="stylesheet" type="text/css" href="css/styles.css" />
    <script src="js/eventHandlers.js" type="text/javascript"></script>
</head>

<body>
    <div id="container">
        <header id="header">
            <div id="logo">
                <img src="images/LogoNoWordsNoLineTransparent.png" alt="Logo" id="logo-image" />
                <div id="company-name">BASECAMP</div>
            </div>
            <div id="header-button-container">
                <a href="index.php" class="button-style">Logout</a>
            </div>
        </header>

        <div id="profile" class="profile-else">
            <div class="title-text">
                <?= htmlspecialchars($_SESSION['username']) ?>
            </div>
            <div class="button-grid">
                <img src="images/<?= htmlspecialchars($_SESSION['profile_photo']) ?>" alt="Profile Picture" id="profile-picture" />
                <a href="homePage.php" class="button-style">DISCOVER</a>
                <a href="createPost.php" class="button-style">CREATE</a>
                <a href="managePost.php" class="button-style">MANAGE</a>
            </div>
        </div>

        <div id="view-post-container">
            <div class="full-post">
                <img src="images/<?= htmlspecialchars($post['profile_photo']) ?>" alt="Profile Picture" class="post-avatar" />
                <div class="post-username"> <?= htmlspecialchars($post['username']) ?> </div>
                <div class="post-time"> <?= htmlspecialchars($post['timestamp']) ?> </div>
                <div class="post-title-full"> <?= htmlspecialchars($post['title']) ?> </div>
                <div class="post-content-full"> <?= htmlspecialchars($post['content']) ?> </div>
                <?php if ($post['post_image']): ?>
                    <img src="images/<?= htmlspecialchars($post['post_image']) ?>" alt="Post Image" class="post-photo-full" />
                <?php endif; ?>
            </div>

            <div id="comment-section">
                <?php foreach ($comments as $comment): ?>
                    <div class="individual-comment">
                        <img src="images/<?= htmlspecialchars($comment['profile_photo']) ?>" alt="Comment Avatar" class="comment-avatar" />
                        <div class="comment-username"> <?= htmlspecialchars($comment['username']) ?> </div>
                        <div class="comment-time"> <?= htmlspecialchars($comment['timestamp']) ?> </div>
                        <div class="comment-content"> <?= htmlspecialchars($comment['content']) ?> </div>
                        <div class="comment-stats">
                            <a href="vote.php?comment_id=<?= $comment['comment_id'] ?>&updown=1" class="vote-style">+<?= htmlspecialchars($comment['vote_score'] ?? 0) ?></a>
                            <a href="vote.php?comment_id=<?= $comment['comment_id'] ?>&updown=0" class="vote-style">-<?= htmlspecialchars($comment['vote_score'] ?? 0) ?></a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <?php if (isset($_SESSION['user_id'])): ?>
                <form class="comment-form" action="addComment.php" method="post">
                    <input type="hidden" name="post_id" value="<?= $postId ?>">
                    <div class="comment-form-container">
                        <textarea rows="4" cols="50" id="leave-comment" name="content" ></textarea>
                        <div id="error-text-comment" class="error-text hidden">
                            Must contain 1 - 1000 characters.
                        </div>
                        <input type="submit" id="post-comment" class="button-style" name="post-comment" value="Post" />
                    </div>
                </form>
            <?php endif; ?>
        </div>
    </div>
    
    <script src="js/eventRegisterComment.js" type="text/javascript"></script>
</body>

</html>

<?php
$db = null;
?>
