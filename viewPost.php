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

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data); //encodes
    return $data;
}

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$userId = $_SESSION['user_id'];
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
$commentQuery = "SELECT c.*, u.username, u.profile_photo, 
        SUM(CASE WHEN v.updown = 1 THEN 1 ELSE 0 END) AS upvotes, 
        SUM(CASE WHEN v.updown = 0 THEN 1 ELSE 0 END) AS downvotes
    FROM comment c 
    JOIN users u ON c.user_id = u.user_id 
    LEFT JOIN vote v ON c.comment_id = v.comment_id
    WHERE c.post_id = '$postId'
    GROUP BY c.comment_id
    ORDER BY c.timestamp ASC;";
$commentStmt = $db->query($commentQuery);
$comments = $commentStmt->fetchAll(PDO::FETCH_ASSOC);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // If we got here through a POST submitted form, process the form
    if (isset($_POST['post-comment'])){
        $comment = test_input($_POST["content"]);
    
        //If there are no errors so far we can try inserting a user     
        $query = "INSERT INTO comment (post_id, user_id, timestamp, content) VALUES ('$postId', '$userId', NOW(), '$comment')";
        $result = $db->exec($query);

        if (!$result) {
            $errors["Database Error:"] = "Failed to insert comment";
        } 
        else {
            header("Location: " . $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING']);
            exit();
        }
    }
    else {
        $commentId = test_input($_POST["comment_id"]);
        $updown = isset($_POST['comment-upvote']) ? 1 : 0;

        $query = "SELECT updown FROM vote WHERE user_id='$userId' AND comment_id='$commentId'";
        $result = $db->query($query, PDO::FETCH_ASSOC);
        $match = $result->fetch();

        if (!$match) {
            $query = "INSERT INTO vote (comment_id, user_id, updown) VALUES ('$commentId', '$userId', '$updown')";
            $result = $db->exec($query);
            
        }
        else if($match['updown'] != $updown){
            $query = "UPDATE vote SET updown='$updown' WHERE user_id=$userId AND comment_id='$commentId'";
            $result = $db->exec($query);
        }
        
        header("Location: " . $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING']);
        exit();
    }

    // Collect and validate form inputs
    
    

    if (!empty($errors)) {
        foreach($errors as $type => $message) {
            print("$type: $message \n<br />");
        }
    }
} // submit method was POST

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

        <div id="view-post-container">
            <div class="full-post">
                <img src="<?= htmlspecialchars($post['profile_photo']) ?>" alt="Profile Picture" class="post-avatar" />
                <div class="post-username"> <?= htmlspecialchars($post['username']) ?> </div>
                <div class="post-time"> <?= htmlspecialchars($post['timestamp']) ?> </div>
                <div class="post-title-full"> <?= htmlspecialchars($post['title']) ?> </div>
                <div class="post-content-full"> <?= htmlspecialchars($post['content']) ?> </div>
                <?php if ($post['post_image']): ?>
                    <img src="<?= htmlspecialchars($post['post_image']) ?>" alt="Post Image" class="post-photo-full" />
                <?php endif; ?>
            </div>

            <div id="comment-section">
                <?php foreach ($comments as $comment): ?>
                    <div class="individual-comment">
                        <img src="<?= htmlspecialchars($comment['profile_photo']) ?>" alt="Comment Avatar" class="comment-avatar" />
                        <div class="comment-username"> <?= htmlspecialchars($comment['username']) ?> </div>
                        <div class="comment-time"> <?= htmlspecialchars($comment['timestamp']) ?> </div>
                        <div class="comment-content"> <?= htmlspecialchars($comment['content']) ?> </div>
                        <form class="comment-stats" action="" enctype="multipart/form-data" method="post">
                            <input type="hidden" name="comment_id" value="<?= htmlspecialchars($comment['comment_id']) ?>">
                            <input type="submit" id="post-comment" class="button-style" name="comment-upvote" value="+<?= htmlspecialchars($comment['upvotes'] ?? 0) ?>" />
                            <input type="submit" id="post-comment" class="button-style" name="comment-downvote" value="-<?= htmlspecialchars($comment['downvotes'] ?? 0) ?>" />
                        </form>
                    </div>
                <?php endforeach; ?>
            </div>

            <?php if (isset($_SESSION['user_id'])): ?>
                <form class="comment-form" action="" enctype="multipart/form-data" method="post">
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
