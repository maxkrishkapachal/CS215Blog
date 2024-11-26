<?php
require_once("db.php");

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
$firstName = "";
$lastName = "";
$email = "";
$username = "";
$password = "";
$dob = "";

    // Check whether the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // If we got here through a POST submitted form, process the form

    // Collect and validate form inputs
    $firstName = test_input($_POST["f-name"]);
    $lastName = test_input($_POST["l-name"]);
    $email = test_input($_POST["email"]);
    $username = test_input($_POST["u-name"]);
    $password = test_input($_POST["p-word"]);
    $dob = test_input($_POST["dob"]);
    
    // Form Field Regular Expressions
    $nameRegex = "/^[a-zA-Z]+$/";
    $unameRegex = "/^[a-zA-Z0-9_]+$/";
    $emailRegex = "/^[a-z0-9]+[.]?[!$#%'*+\/=?^_`{|}~-]*[a-z0-9]+@[a-z]+[.]?[!$%&'*+\/=?^_`{|}~-]*[a-z]+\.[a-z]{2,3}$/";
    $passwordRegex = "/^.{8}$/";
    $dobRegex = "/^\d{4}[-]\d{2}[-]\d{2}$/";
    
    // Validate the form inputs against their Regexes 
    if (!preg_match($nameRegex, $firstName)) {
        $errors["f-name"] = "Invalid First Name";
    }
    if (!preg_match($nameRegex, $lastName)) {
        $errors["l-name"] = "Invalid Last Name";
    }
    if(!preg_match($emailRegex, $email)){
        $errors["email"] = "Invalid Email";
    }
    if (!preg_match($unameRegex, $username)) {
        $errors["u-name"] = "Invalid Username";
    }
    if (!preg_match($passwordRegex, $password)) {
        $errors["p-word"] = "Invalid Password";
    }
    if (!preg_match($dobRegex, $dob)) {
        $errors["dob"] = "Invalid DOB";
    }

    // Declare $target_file here so we can use it later
    $target_file = "";

    try {
        $db = new PDO($attr, $db_user, $db_pwd, $options);
    } catch (PDOException $e) {
        die("PDO Error >> " . $e->getMessage() . "\n<br />");
    }

    $query = "SELECT username FROM users WHERE username='$username'";
    $result = $db->query($query, PDO::FETCH_ASSOC);
    $match = $result->fetch();

    if ($match) {
        $errors["Account Username Taken"] = "A user with that username already exists.";
    }

    $query = "SELECT email FROM users WHERE email='$email'";
    $result = $db->query($query, PDO::FETCH_ASSOC);
    $match = $result->fetch();

    if($match){
        $errors["Account Email Taken"] = "A user with that email already exists.";
    }
    
    //If there are no errors so far we can try inserting a user
    if (empty($errors)) {

        $dateformat = date("Y-m-d", strtotime($dob));
        $query = "INSERT INTO users (first_name, last_name, email, username, password, dob, profile_photo) VALUES ('$firstName', '$lastName', '$email', '$username', '$password', '$dateformat', 'avatar_stub')";
        
        $result = $db->exec($query);

        if (!$result) {
            $errors["Database Error:"] = "Failed to insert user";
        } else {
            $target_dir = "uploads/profile/";
            $uploadOk = TRUE;
        
            // Fetch the image filetype
            $imageFileType = strtolower(pathinfo($_FILES["profile-photo"]["name"],PATHINFO_EXTENSION));
            $userid = $db->lastInsertId();            
            $target_file = $target_dir . $userid . "." . $imageFileType;

            // Check whether the file exists in the uploads directory
            if (file_exists($target_file)) {
                $errors["profile-photo"] = "Sorry, file already exists. ";
                $uploadOk = FALSE;
            }
                
            // Check whether the file is not too large
            if ($_FILES["profile-photo"]["size"] > 1000000) {
                $errors["profile-photo"] = "File is too large. Maximum 1MB. ";
                $uploadOk = FALSE;
            }

            // Check image file type
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
                $errors["profile-photo"] = "Bad image type. Only JPG, JPEG, PNG & GIF files are allowed. ";
                $uploadOk = FALSE;
            }
                            
            // Check if $uploadOk still TRUE after validations
            if ($uploadOk) {
                // Move the user's avatar to the uploads directory and capture the result as $fileStatus.
                $fileStatus = move_uploaded_file($_FILES["profile-photo"]["tmp_name"], $target_file);

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
                $query = "DELETE FROM users WHERE profile_photo='avatar_stub'";
                $result = $db->exec($query);

                if (!$result) {
                    $errors["Database Error"] = "could not delete user when avatar upload failed";
                }
                $db = null;
            } else {
                $userid = $db->lastInsertId();
                $query =  "UPDATE users SET profile_photo='$target_file' WHERE user_id=$userid";
                $result = $db->exec($query);

                if (!$result) {
                    $errors["Database Error:"] = "could not update profile photo";
                } else {
                    $db = null;
                    header("Location: index.php");
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
        <title>BASECAMP - Signup</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="description" content="The page to sign up for the forum" />
        <link rel="stylesheet" type="text/css" href="css/styles.css" />
        <script src="js/eventHandlers.js" type="text/javascript"></script>
    </head>

    <body>
        <div id="signup-container">
            <header id="header">
                <div id="logo">
                    <img src="images/LogoNoWordsNoLineTransparent.png" alt="Logo" id="logo-image" />
                    <div id="company-name">BASECAMP</div>
                </div>
                <div id="header-button-container">
                    <a href="signup.php" class="button-style">Signup</a>
                    <a href="index.php" class="button-style">Login</a>
                </div>
            </header>
            <form id="signup-form" class="signup-form-container" action="" enctype="multipart/form-data" method="post">
                <div id="profile" class="profile-signup">
                    <!-- where the user can login or sign up - becomes the profile when logged in -->
                    <div class="title-text">PROFILE PICTURE</div>
                    <div class="profile-picture-container">
                        <div class="form-input-grid">
                            <div class="placeholder-container">
                                <label for="upload-photo-button" class="placeholder">Upload Profile Photo</label>
                                <input type="file" id="upload-photo-button" name="profile-photo" accept="image/*" />
                                <div id="error-text-image" class="error-text hidden">
                                    Profile picture invalid. Photo must be less than 1MB and be of type JPEG, JPG, PNG, or GIF.
                                </div>
                                <img class="add-profile-photo" alt="Uploaded Photo" src="images/blank-profile-picture.png" />
                            </div>
                        </div>
                    </div>
                </div>

                <div id="signup-title">
                    <div class="title-text">ENTER THE FOLLOWING INFORMATION:</div>
                </div>
                <div class="front-page-posts signup-input">
                    <div class="form-signup-grid">
                        <!-- Label and Input for the first name-->
                        <div class="placeholder-container">
                            <label for="f-name" class="placeholder">First Name</label>           
                            <input type="text" id="f-name" name="f-name" />
                            <div id="error-text-f-name" class="error-text <?= isset($errors['f-name'])?'':'hidden' ?>">
                                First name invalid.
                            </div>
                        </div>
                        <!-- Label and Input for the last name-->
                        <div class="placeholder-container">
                            <label for="l-name" class="placeholder">Last Name</label>           
                            <input type="text" id="l-name" name="l-name" />
                            <div id="error-text-l-name" class="error-text <?= isset($errors['l-name'])?'':'hidden' ?>">
                                Last name invalid.
                            </div>
                        </div>
                        <!-- Label and Input for the username-->
                        <div class="placeholder-container">
                            <label for="u-name" class="placeholder">Username</label>
                            <input type="text" id="u-name" name="u-name" />
                            <div id="error-text-uname" class="error-text <?= isset($errors['u-name'])?'':'hidden' ?>">
                                Username invalid.
                            </div>
                        </div>
                        <!-- Label and Input for the date of birth-->
                        <div class="placeholder-container">
                            <label for="dob" class="placeholder">Date of Birth</label>
                            <input type="date" id="dob" name="dob" />
                            <div id="error-text-dob" class="error-text <?= isset($errors['dob'])?'':'hidden' ?>">
                                Date of birth invalid.
                            </div>
                        </div>
                        <!-- Label and Input for the email-->
                        <div class="placeholder-container">
                            <label for="email" class="placeholder">Email</label>
                            <input type="email" id="email" name="email" />
                            <div id="error-text-email" class="error-text <?= isset($errors['email'])?'':'hidden' ?>">
                                Email invalid.
                            </div>
                        </div>
                        <!-- Label and Input for the password-->
                        <div class="placeholder-container">
                            <label for="p-word" class="placeholder">Password</label>
                            <input type="password" id="p-word" name="p-word" />
                            <div id="error-text-pword" class="error-text <?= isset($errors['p-word'])?'':'hidden' ?>">
                                Password invalid. Must be at least 6 characters long and contain at least one non-letter character.
                            </div>
                        </div>
                        <!-- Label and Input for re-enter password-->
                        <div class="placeholder-container">
                            <label for="confirm-pword" class="placeholder">Re-enter Password</label>
                            <input type="password" id="confirm-pword" name="confirm-pword" />
                            <div id="error-text-cpword" class="error-text hidden">
                                Passwords do not match.
                            </div>
                        </div>
                        <div class="placeholder-container">
                            <input type="submit" id="signup" class="button-style" name="signup" value="Signup" />
                        </div>
                    </div>
                </div> 
            </form>
        </div>
        <script src="js/eventRegisterSignup.js" type="text/javascript"></script>
    </body>
</html>