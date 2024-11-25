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

        // Connect to the database and verify the connection
        try {
            $db = new PDO($attr, $db_user, $db_pwd, $options);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }

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
                <!-- holds top five current posts. unable to read rest of posts without logging in first -->
                <!-- these are placeholder posts -->
                <div class="individual-post">
                    <img src="images/blue-netflix-profile.jpg" alt="blue netflix profile picture" class="post-avatar" />
                    <div class="post-username">CAMPFIRECRAFTER</div>
                    <div class="post-time">MARCH 22 2024 23:31</div>
                    <div class="post-title">The Art of Campfire Cooking</div>
                    <div class="post-content-preview">
                        There's something magical about cooking over an open fire 
                        while camping. The crackling sound of burning wood, the 
                        warmth of the flames, and the aroma of food wafting through 
                        the air create a unique culinary experience. From classic 
                        s'mores to gourmet meals like grilled vegetables and 
                        marinated meats, campfire cooking invites creativity. 
                        With the right tools—think cast iron skillets or 
                        skewers—you can transform simple ingredients into delicious
                        meals under the stars. Don't forget to share your favorite 
                        recipes with fellow campers to elevate everyone's outdoor 
                        dining experience!
                    </div>
                    <img src="images/camping1.jpg" alt="camping photo one" class="post-photo" />
                    <div class="post-stats">
                        <div class="post-likes">3.5K Likes</div>
                        <div class="post-comments">203 Comments</div>
                    </div> 
                </div>
                <div class="individual-post">
                    <img src="images/red-netflix-profile.jpg" alt="red netflix profile picture" class="post-avatar" />
                    <div class="post-username">TRAILBLAZER_ADVENTURES</div>
                    <div class="post-time">SEPTEMBER 26 2024 12:47</div>
                    <div class="post-title">Campfire Stories</div>
                    <div class="post-content-preview">
                        Hey everyone! I just got back from a fantastic weekend 
                        camping trip, and I’m still buzzing from all the fun we 
                        had. Each night, we gathered around the campfire, 
                        roasting marshmallows and sharing our wildest camping 
                        stories. It’s amazing how a campfire can bring people 
                        together, right? One of my friends told a hilarious story 
                        about the time he mistook a raccoon for his dog in the 
                        middle of the night—he swore he was just trying to play 
                        fetch! What’s your favorite campfire tale? I’d love to 
                        hear about the craziest or funniest thing that’s happened 
                        to you while camping. Let’s swap stories!
                    </div>
                    <img src="images/camping2.jpg" alt="camping photo two" class="post-photo" />
                    <div class="post-stats">
                        <div class="post-likes">2.7k Likes</div>
                        <div class="post-comments">345 Comments</div>
                    </div> 
                </div>
                <div class="individual-post">
                    <img src="images/green-netflix-profile.jpg" alt="green netflix profile picture" class="post-avatar" />
                    <div class="post-username">TENT_TALES</div>
                    <div class="post-time">SEPTEMBER 28 2024 11:45</div>
                    <div class="post-title">campfire snacks</div>
                    <div class="post-content-preview">
                        Hey fellow campers! I just got back from a camping trip, 
                        and I realized that snacks can really make or break the 
                        experience. Of course, I always bring marshmallows for 
                        roasting, but I’m looking to mix things up this season. 
                        I’ve heard great things about homemade trail mix, and I’m 
                        tempted to try grilled fruit over the campfire—who knew 
                        that could be a thing? I also brought along some 
                        chocolate-covered pretzels, which were a hit around the 
                        campfire. What are your go-to snacks for camping? I’d love 
                        to hear any delicious camping snack ideas you all swear by! 
                        Share your favorites, and let’s create the ultimate camping 
                        snack list!
                    </div>
                    <img src="images/camping3.jpg" alt="camping photo three" class="post-photo" />
                    <div class="post-stats">
                        <div class="post-likes">2.7k Likes</div>
                        <div class="post-comments">345 Comments</div>
                    </div> 
                </div>
                <div class="individual-post">
                    <img src="images/teal-netflix-profile.png" alt="teal netflix profile picture" class="post-avatar" />
                    <div class="post-username">IFRICKINGLOVECAMPING</div>
                    <div class="post-time">SEPTEMBER 28 2024 14:08</div>
                    <div class="post-title">Camping with pets?</div>
                    <div class="post-content-preview">
                        Has anyone here gone camping with their furry friends? 
                        I took my dog along on my last trip, and it was an absolute 
                        blast! He loved running around the campsite, and he even 
                        jumped into the lake to cool off—definitely the highlight 
                        of his trip! I’m curious about any tips you have for camping
                        with pets, like how to keep them safe and comfortable. 
                        For instance, I found that bringing his favorite blanket 
                        made him feel right at home in the tent. Would love to 
                        hear your experiences and any advice you have for making 
                        camping with pets a smooth and enjoyable adventure!
                    </div>
                    <img src="images/camping4.jpg" alt="camping photo four" class="post-photo" />
                    <div class="post-stats">
                        <div class="post-likes">2.7k Likes</div>
                        <div class="post-comments">345 Comments</div>
                    </div> 
                </div>
                <div class="individual-post">
                    <img src="images/yellow-netflix-profile.jpg" alt="yellow netflix profile picture" class="post-avatar" />
                    <div class="post-username">FORESTEXPLORER22</div>
                    <div class="post-time">SEPTEMBER 30 2024 9:32</div>
                    <div class="post-title">Best Camping Locations!</div>
                    <div class="post-content-preview">
                        I’m looking for new camping spots to explore! 
                        I usually stick to state parks because they’re 
                        nearby and convenient, but I’m ready for a new 
                        adventure. Recently, I’ve been hearing amazing 
                        things about national forests and remote 
                        campgrounds that are less crowded. Do you have 
                        any favorite camping locations that you’d 
                        recommend? I’m open to suggestions, whether they’re 
                        close to home or a bit of a drive away. I love 
                        discovering hidden gems where I can disconnect 
                        from the hustle and bustle and enjoy nature. Let’s 
                        share our favorite spots and inspire each other 
                        to explore new places!
                    </div>
                    <img src="images/camping5.jpg" alt="camping photo five" class="post-photo" />
                    <div class="post-stats">
                        <div class="post-likes">2.7k Likes</div>
                        <div class="post-comments">345 Comments</div>
                    </div> 
                </div>
            </div>
        </div>
        <script src="js/eventRegisterLogin.js" type="text/javascript"></script>
    </body>
</html>