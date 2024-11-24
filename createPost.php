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
                
                <form id="create-form" class="create-post-form" action="homePage.php" method="post">
                    <!-- Label and Input for the post title-->
                    <div class="placeholder-container">
                        <label for="post-title" class="placeholder">Post Title:</label>           
                        <input type="text" id="post-title" name="post-title" />
                        <div id="error-text-title" class="error-text hidden">
                            Must contain 1 - 100 characters.
                        </div>
                    </div>
                    <!-- Label and Input for the post text-->
                    <div class="placeholder-container">
                        <label for="post-text" class="placeholder">Post Body:</label>           
                        <textarea rows="5" cols="50" id="post-text" name="post-text"> </textarea>
                        <div id="error-text-content" class="error-text hidden">
                            Must contain 1 - 2000 characters.
                        </div>
                    </div>

                    <!-- Label and Input for photo uploading-->
                    <div class="placeholder-container">
                        <label for="upload-photo-button" class="placeholder">Upload Photo:</label>
                        <input type="file" id="upload-photo-button" name="profile-photo" accept="image/*" />
                        <img class="add-post-photo" alt="Uploaded Photo" src="images/camping15.jpg" />
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