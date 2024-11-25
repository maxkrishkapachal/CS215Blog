<!-- 
Max Krishka-Pachal
200526378
October 1 2024
CS 215
Assignment 2
index.html
-->

<?php
require_once("db.php");

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data); //encodes
    return $data;
}

try {
    $db = new PDO($attr, $db_user, $db_pwd, $options);
} catch (PDOException $e) {
    throw new PDOException($e->getMessage(), (int)$e->getCode());
}

$query = "SELECT p.*, u.username, u.profile_photo FROM post p JOIN users u ON p.user_id = u.user_id ORDER BY timestamp DESC LIMIT 5";
$stmt = $db->query($query);
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Check whether the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $errors = array();
    $dataOK = TRUE;
    
    // Get and validate the email and password fields
    $email = test_input($_POST["email"]);
    $password = test_input($_POST["p-word"]);

    $emailRegex = "/^[a-z0-9]+[.]?[!$#%'*+\/=?^_`{|}~-]*[a-z0-9]+@[a-z]+[.]?[!$%&'*+\/=?^_`{|}~-]*[a-z]+\.[a-z]{2,3}$/";
    $passwordRegex = "/^.{8}$/";

    if (!preg_match($emailRegex, $email)) {
        $errors["email"] = "Invalid Email";
        $dataOK = FALSE;
    }

    $password = test_input($_POST["p-word"]);
    $passwordRegex = "/^.{8}$/";
    if (!preg_match($passwordRegex, $password)) {
        $errors["p-word"] = "Invalid Password";
        $dataOK = FALSE;
    }

    // Check whether the fields are not empty
    if ($dataOK) {
        $query = "SELECT user_id, first_name, last_name, username, profile_photo FROM users WHERE email='$email' AND password='$password'";
        $result = $db->query($query, PDO::FETCH_ASSOC);

        if (!$result) {
            // query has an error
            $errors["Database Error"] = "Could not retrieve user information";
        } elseif ($row = $result->fetch()) {
            // If there's a row, we have a match and login is successful!
            
            session_start();

            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['first_name'] = $row['first_name'];
            $_SESSION['last_name'] = $row['last_name'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['profile_photo'] = $row['profile_photo'];

            $db = null;
            header("Location: homePage.php");
            exit();
        } else {
            // login unsuccessful
            $errors["Login Failed"] = "That email/password combination does not exist.";
        }

        $db = null;

    } else {

        $errors['Login Failed'] = "You entered invalid data while logging in.";
    }
    if(!empty($errors)){
        foreach($errors as $type => $message) {
            echo "$type: $message <br />\n";
        }
    }

}
?>

<!DOCTYPE html>
<html>

    <head>
        <title>BASECAMP - Login</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="description" content="The front page after the user has logged in with profile on the sidebar" />
        <link rel="stylesheet" type="text/css" href="css/styles.css" />
        <script src="js/eventHandlers.js" type="text/javascript"></script>
    </head>

    <body>
        <div id="container">
            <header id="header">
                <div id="logo">
                    <!-- header image and company name - logo -->
                    <img src="images/LogoNoWordsNoLineTransparent.png" alt="Logo" id="logo-image" />
                    <div id="company-name">BASECAMP</div>
                </div>
                <div id="header-button-container">
                    <!-- login and signup buttons in header -->
                    <a href="signup.php" class="button-style">Signup</a>
                    <a href="index.php" class="button-style">Login</a>
                </div>
            </header>

            <div id="profile" class="profile-else">
                <!-- where the user can login or sign up - becomes the profile when logged in -->
                <div class="title-text">LOGIN</div>
                <form id="login-form" class="auth-form" action="" enctype="multipart/form-data" method="post">
                    <div class="form-input-grid">
                        <!-- username label and input -->
                        <div class="placeholder-container">
                            <label for="email" class="placeholder">Email</label>
                            <input type="text" id="email" name="email" />
                            <div id="error-text-email" class="error-text <?= isset($errors['email'])?'':'hidden' ?>">
                                Email invalid. Incorrect email format.
                            </div>
                        </div>
                        <!-- password label and input -->
                        <div class="placeholder-container">
                            <label for="p-word" class="placeholder">Password</label>
                            <input type="password" id="p-word" name="p-word" />
                            <div id="error-text-pword" class="error-text <?= isset($errors['p-word'])?'':'hidden' ?>">
                                Password invalid. Must be at least 8 characters long and contain at least one non-letter character.
                            </div>
                        </div>

                        <!-- login button -->
                        <input type="submit" id="login" class="button-style" name="login" value="Login" />
    
                    </div>
                </form>
                <div class="button-grid"> 
                    <!-- for signing up -->
                    <label class="title-text">NEW HERE?</label>
                    <a href="signup.php" class="button-style">Signup</a>
                </div>
            </div>

            <div id="announcement-bar">
                <div class="title-text">CHECK OUT THE NEWEST POSTS:</div>
            </div>

            <div id="front-page-posts">
                <?php foreach ($posts as $post): ?>
                    <div class="full-post">
                        <img src="<?= htmlspecialchars($post['profile_photo']) ?>" alt="Profile Picture" class="post-avatar" />
                        <div class="post-username"> <?= htmlspecialchars($post['username']) ?> </div>
                        <div class="post-time"> <?= htmlspecialchars($post['timestamp']) ?> </div>
                        <div class="post-title-full">
                            <a href="viewPost.php?post_id=<?= htmlspecialchars($post['post_id']) ?>"> <?= htmlspecialchars($post['title']) ?> </a>
                        </div>
                        <div class="post-content-full"> <?= htmlspecialchars($post['content']) ?> </div>
                        <?php if ($post['post_image']): ?>
                            <img src="<?= htmlspecialchars($post['post_image']) ?>" alt="Post Image" class="post-photo-full" />
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <script src="js/eventRegisterLogin.js" type="text/javascript"></script>
    </body>
</html>