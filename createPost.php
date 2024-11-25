<?php

session_start();
require_once("db.php");

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

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data); //encodes
    return $data;
}

// This variables will keep track of errors and form values
// we find while processing the form but we'll make them global
// so we can display POST results on the form when there's an error.
$errors = array();
$postTitle = "";
$postText = "";

    // Check whether the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // If we got here through a POST submitted form, process the form

    // Collect and validate form inputs
    $postTitle = test_input($_POST["post-title"]);
    $postText = test_input($_POST["post-text"]);

    // Declare $target_file here so we can use it later
    $target_file = "";

    try {
        $db = new PDO($attr, $db_user, $db_pwd, $options);
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("PDO Error >> " . $e->getMessage() . "\n<br />");
    }

    //If there are no errors so far we can try inserting a user
    if (empty($errors)) {
        
        $query = "INSERT INTO post (user_id, timestamp, title, content, post_image) VALUES ('$userid', NOW(), '$postTitle', '$postText', 'image_stub')";
        $result = $db->exec($query);

        if (!$result) {
            $errors["Database Error:"] = "Failed to create post";
        } else {
            $target_dir = "uploads/post/";
            $uploadOk = TRUE;

            
        
            // Fetch the image filetype
            $imageFileType = strtolower(pathinfo($_FILES["post-image"]["name"],PATHINFO_EXTENSION));
            $postid = $db->lastInsertId();
            $target_file = $target_dir . $postid . "." . $imageFileType;

            // Check whether the file exists in the uploads directory
            if (file_exists($target_file)) {
                $errors["post-image"] = "Sorry, file already exists. ";
                $uploadOk = FALSE;
            }
                
            // Check whether the file is not too large
            if ($_FILES["post-image"]["size"] > 1000000) {
                $errors["post-image"] = "File is too large. Maximum 1MB. ";
                $uploadOk = FALSE;
            }

            // Check image file type
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
                $errors["post-image"] = "Bad image type. Only JPG, JPEG, PNG, and GIF files are allowed. ";
                $uploadOk = FALSE;
            }
                            
            // Check if $uploadOk still TRUE after validations
            if ($uploadOk) {
                // Move the user's avatar to the uploads directory and capture the result as $fileStatus.
                $fileStatus = move_uploaded_file($_FILES["post-image"]["tmp_name"], $target_file);

                // Check $fileStatus:
                if (!$fileStatus) {
                    // The user's avatar file could not be moved
                    $errors["Server Error"] = "Unable to upload photo.";
                    $uploadOK = FALSE;
                }
            }
            
            // Check if $uploadOk still TRUE after attempt to move
            if (!$uploadOk)
            {
                $query = "DELETE FROM post WHERE post_image='image_stub'";
                $result = $db->exec($query);

                if (!$result) {
                    $errors["Database Error"] = "could not delete post when image upload failed";
                }
                $db = null;
            } else {
                $query =  "UPDATE post SET post_image='$target_file' WHERE post_id=$postid";
                $result = $db->exec($query);

                if (!$result) {
                    $errors["Database Error:"] = "could not update post image";
                } else {
                    $db = null;
                    header("Location: managePost.php");
                    exit();
                }
            } // image was uploadOk
        } // Insert user query worked
    } 
    

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
        <title>BASECAMP - Create Post</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="description" content="The page to create a new post" />
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
                <div class="title-text">USERNAME</div>
                
                <div class="button-grid"> 
                    <img src="images/red-netflix-profile.jpg" alt="red netflix profile picture" id="profile-picture" />
                    <a href="homePage.php" class="button-style">DISCOVER</a>
                    <a href="createPost.php" class="button-style">CREATE</a>
                    <a href="managePost.php" class="button-style">MANAGE</a>
                </div>
            </div>

            <div id="create-post">
                <div class="title-text">Create your new post:</div>
                
                <form id="create-form" class="create-post-form" action="" enctype="multipart/form-data" method="post">
                    <!-- Label and Input for the post title-->
                    <div class="placeholder-container">
                        <label for="post-title" class="placeholder">Post Title:</label>           
                        <input type="text" id="post-title" name="post-title" />
                        <div id="error-text-title" class="error-text <?= isset($errors['post-title'])?'':'hidden' ?>">
                            Must contain 1 - 100 characters.
                        </div>
                    </div>
                    <!-- Label and Input for the post text-->
                    <div class="placeholder-container">
                        <label for="post-text" class="placeholder">Post Body:</label>           
                        <textarea rows="5" cols="50" id="post-text" name="post-text"> </textarea>
                        <div id="error-text-content" class="error-text <?= isset($errors['post-text'])?'':'hidden' ?>">
                            Must contain 1 - 2000 characters.
                        </div>
                    </div>

                    <!-- Label and Input for photo uploading-->
                    <div class="placeholder-container">
                        <label for="upload-photo-button" class="placeholder">Upload Photo:</label>
                        <input type="file" id="upload-photo-button" name="post-image" accept="image/*" />
                        <img class="add-post-photo" alt="Uploaded Photo" src="images/camping15.jpg" />
                        <div id="error-text-content" class="error-text <?= isset($errors['post-image'])?'':'hidden' ?>">
                            Post image invalid. Photo must be less than 1MB and be of type JPEG, JPG, PNG, or GIF.
                        </div>
                    </div>
                    <div class="placeholder-container">
                        <input type="submit" class="post-button-style" id="post" name="post-button" value="Post" />
                    </div>
                </form>
            </div>
        </div>
        <script src="js/eventRegisterCreatePost.js" type="text/javascript"></script>
    </body>
</html>