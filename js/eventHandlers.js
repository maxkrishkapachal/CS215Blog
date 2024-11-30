// Max Krishka-Pachal
// 200526378
// October 30 2024
// CS 215
// Assignment 3
// eventHandlers.js

// constants
const TITLE_MAX = 100;
const CONTENT_MAX = 2000;
const COMMENT_MAX = 1000;
const TEXT_MIN = 1;

// validate email
function validateEmail(email){
    let emailRegEx = /^[a-z0-9]+[.]?[!$#%'*+/=?^_`{|}~-]*[a-z0-9]+@[a-z]+[.]?[!$%&'*+/=?^_`{|}~-]*[a-z]+\.[a-z]{2,3}$/;
    
    if(emailRegEx.test(email))
        return true;
    else
        return false;
}

// validate username
function validateUsername(username){
    let unameRegEx = /^[a-zA-Z0-9]+$/;

    if(unameRegEx.test(username))
        return true;
    else   
        return false;
}

// validate password
function validatePassword(pword){
    let pwordRegEx = /^[a-zA-Z]*[^a-zA-Z][a-zA-Z0-9`~!@#$%^&*()_+=<,>./?;:'"[{\]}|\\-]*$/;

    if(pwordRegEx.test(pword) && pword.length >= 6)
        return true;
    else
        return false;
}

//validate confirm password
function validateCPassword(cpword){
    let pword = document.getElementById("p-word");

    if(cpword === pword.value)
        return true;
    else   
        return false;
}

// validate avatar
function validateAvatar(avatar){
    let avatarRegEx = /^[^\n]+\.[a-zA-Z]{3,4}$/;

    if(avatarRegEx.test(avatar))
        return true;
    else
        return false;
}

// validate post title
function validatePostTitle(title){
    if(title.length >= TEXT_MIN && title.length <= TITLE_MAX)
        return true;
    else    
        return false;
}

// validate post content
function validatePostContent(content){
    if(content.length >= TEXT_MIN && content.length <= CONTENT_MAX)
        return true;
    else
        return false;
}

function validatePostImage(image){
    let file = image.files[0];

    let MAX_FILE_SIZE = 1024 * 1024;  // 1MB in bytes

    console.log(file);
    console.log(file.size);
    console.log(MAX_FILE_SIZE);

    if(file && file.size <= MAX_FILE_SIZE)
        return true;
    else   
        return false;
}

function validateComment(comment){
    if(comment.length >= TEXT_MIN && comment.length <= COMMENT_MAX)
        return true;
    else
        return false;
}

// validation of characters count and limit for text of the input
function charCounter(event, limit) {
    const textarea = event.target;
    let counterElement = textarea.nextElementSibling;
  
    if (!counterElement || !counterElement.classList.contains("char-counter")) {
      counterElement = document.createElement("div");
      counterElement.classList.add("char-counter");
      counterElement.style.marginTop = "5px";
      textarea.parentNode.insertBefore(counterElement, textarea.nextSibling);
    }
  
    const charCount = textarea.value.trim().length;
    const charsLeft = limit - charCount;
  
    if (charCount <= limit) {
      counterElement.innerHTML = `${charCount} / ${limit} characters used. (${charsLeft} characters left)`;
      counterElement.style.color = "black";
    } else {
      counterElement.innerHTML = `Character limit exceeded by ${charCount - limit} characters.`;
      counterElement.style.color = "red";
    }
  }

function validateSignup(event){
    // image
    let image = document.getElementById("upload-photo-button");
    // email
    let email = document.getElementById("email");
    // username
    let uname = document.getElementById("u-name");
    // password
    let pword = document.getElementById("p-word");
    // confirm password
    let cpword = document.getElementById("confirm-pword");
    // avatar
    let avatar = document.getElementById("upload-photo-button");

    let formIsValid = true;

    if (!validatePostImage(image)) {
        image.classList.add("error-input");
        let errorMessage = document.getElementById("error-text-image");
        errorMessage.classList.remove("hidden");
        formIsValid = false;
    }
    else {
        image.classList.remove("error-input");
        let errorMessage = document.getElementById("error-text-image");
        errorMessage.classList.add("hidden");
    }

    if(!validateEmail(email.value)){
        email.classList.add("error-input");
        let errorMessage = document.getElementById("error-text-email");
        errorMessage.classList.remove("hidden");
        formIsValid = false;
    }
    else {
        email.classList.remove("error-input");
        let errorMessage = document.getElementById("error-text-email");
        errorMessage.classList.add("hidden");
    } 

    if(!validateUsername(username.value)){
        username.classList.add("error-input");
        let errorMessage = document.getElementById("error-text-uname");
        errorMessage.classList.remove("hidden");
        formIsValid = false;
    }
    else {
        username.classList.remove("error-input");
        let errorMessage = document.getElementById("error-text-uname");
        errorMessage.classList.add("hidden");
    }  

    if(!validatePassword(password.value)){
        password.classList.add("error-input");
        let errorMessage = document.getElementById("error-text-pword");
        errorMessage.classList.remove("hidden");
        formIsValid = false;
    }
    else {
        password.classList.remove("error-input");
        let errorMessage = document.getElementById("error-text-pword");
        errorMessage.classList.add("hidden");
    }  

    if(!validateCPassword(cpword.value)){
        cpword.classList.add("error-input");
        let errorMessage = document.getElementById("error-text-cpword");
        errorMessage.classList.remove("hidden");
        formIsValid = false;
    }
    else {
        cpword.classList.remove("error-input");
        let errorMessage = document.getElementById("error-text-cpword");
        errorMessage.classList.add("hidden");
    }  

    if(!validateAvatar(avatar.value)){
        avatar.classList.add("error-input");
        let errorMessage = document.getElementById("error-text-avatar");
        errorMessage.classList.remove("hidden");
        formIsValid = false;
    }
    else {
        avatar.classList.remove("error-input");
        let errorMessage = document.getElementById("error-text-avatar");
        errorMessage.classList.add("hidden");
    }

    if(!formIsValid)
        event.preventDefault();
}


function validateLogin(event){
    // email
    let email = document.getElementById("email");
    // password
    let pword = document.getElementById("p-word");

    let formIsValid = true;

    if(!validateEmail(email.value)){
        email.classList.add("error-input");
        let errorMessage = document.getElementById("error-text-email");
        errorMessage.classList.remove("hidden");
        formIsValid = false;
    }
    else {
        email.classList.remove("error-input");
        let errorMessage = document.getElementById("error-text-email");
        errorMessage.classList.add("hidden");
    } 

    if(!validatePassword(password.value)){
        password.classList.add("error-input");
        let errorMessage = document.getElementById("error-text-pword");
        errorMessage.classList.remove("hidden");
        formIsValid = false;
    }
    else {
        password.classList.remove("error-input");
        let errorMessage = document.getElementById("error-text-pword");
        errorMessage.classList.add("hidden");
    }  

    if(!formIsValid)
        event.preventDefault();
}

// validate create post
function validatePost(event){
    // title
    let title = document.getElementById("post-title");
    // content
    let content = document.getElementById("post-text");
    // image
    let image = document.getElementById("upload-photo-button");

    let formIsValid = true;

    if(!validatePostTitle(title.value)){
        title.classList.add("error-input");
        let errorMessage = document.getElementById("error-text-title");
        errorMessage.classList.remove("hidden");
        formIsValid = false;
    }
    else {
        title.classList.remove("error-input");
        let errorMessage = document.getElementById("error-text-title");
        errorMessage.classList.add("hidden");
    } 

    if(!validatePostContent(content.value)){
        content.classList.add("error-input");
        let errorMessage = document.getElementById("error-text-content");
        errorMessage.classList.remove("hidden");
        formIsValid = false;
    }
    else {
        content.classList.remove("error-input");
        let errorMessage = document.getElementById("error-text-content");
        errorMessage.classList.add("hidden");
    } 

    if (!validatePostImage(image)) {
        image.classList.add("error-input");
        let errorMessage = document.getElementById("error-text-image");
        errorMessage.classList.remove("hidden");
        formIsValid = false;
    }
    else {
        image.classList.remove("error-input");
        let errorMessage = document.getElementById("error-text-image");
        errorMessage.classList.add("hidden");
    }

    if(!formIsValid)
        event.preventDefault();
}

// validate comment
function validatePostComment(event){
    let comment = document.getElementById("leave-comment");

    let formIsValid = true;

    if(!validateComment(comment.value)){
        comment.classList.add("error-input");
        let errorMessage = document.getElementById("error-text-comment");
        errorMessage.classList.remove("hidden");
        formIsValid = false;
    }
    else {
        comment.classList.remove("error-input");
        let errorMessage = document.getElementById("error-text-comment");
        errorMessage.classList.add("hidden");
    }

    if(!formIsValid)
        event.preventDefault();
}


// email handler
function emailHandler(event){
    let email = event.target;
    let errorMessage = document.getElementById("error-text-email");

    if(!validateEmail(email.value.trim())){
        email.classList.add("error-input");
        errorMessage.classList.remove("hidden");
    }
    else {
        email.classList.remove("error-input");
        errorMessage.classList.add("hidden");
    }   
}

// username handler
function usernameHandler(event){
    let username = event.target;
    let errorMessage = document.getElementById("error-text-uname");

    if(!validateUsername(username.value.trim())){
        username.classList.add("error-input");
        errorMessage.classList.remove("hidden");
    }
    else {
        username.classList.remove("error-input");
        errorMessage.classList.add("hidden");
    }   
}

// password handler
function passwordHandler(event){
    let password = event.target;
    let errorMessage = document.getElementById("error-text-pword");

    if(!validatePassword(password.value.trim())){
        password.classList.add("error-input");
        errorMessage.classList.remove("hidden");
    }
    else {
        password.classList.remove("error-input");
        errorMessage.classList.add("hidden");
    }   
}

// confirm password handler
function cPasswordHandler(event){
    let cpword = event.target;
    let errorMessage = document.getElementById("error-text-cpword");

    if(!validateCPassword(cpword.value.trim())){
        cpword.classList.add("error-input");
        errorMessage.classList.remove("hidden");
    }
    else {
        cpword.classList.remove("error-input");
        errorMessage.classList.add("hidden");
    }   
}

// avatar handler
function avatarHandler(event){
    let avatar = event.target;
    let errorMessage = document.getElementById("error-text-avatar");

    if(!validateAvatar(avatar.value)){
        avatar.classList.add("error-input");
        errorMessage.classList.remove("hidden");
    }
    else {
        avatar.classList.remove("error-input");
        errorMessage.classList.add("hidden");
    }   
}

// post title
function postTitleHandler(event){
    let title = event.target;
    let errorMessage = document.getElementById("error-text-title");

    if(!validatePostTitle(title.value.trim())){
        title.classList.add("error-input");
        errorMessage.classList.remove("hidden");
    }
    else {
        title.classList.remove("error-input");
        errorMessage.classList.add("hidden");
    }
}

// post content
function postContentHandler(event){
    let content = event.target;
    let errorMessage = document.getElementById("error-text-content");

    if(!validatePostContent(content.value.trim())){
        content.classList.add("error-input");
        errorMessage.classList.remove("hidden");
    }
    else {
        content.classList.remove("error-input");
        errorMessage.classList.add("hidden");
    }
}

function postImageHandler(event){
    let fileInput = event.target;
    let errorMessage = document.getElementById("error-text-image");
    
    if (!validatePostImage(fileInput)) {
        fileInput.classList.add("error-input");
        errorMessage.classList.remove("hidden");
    }
    else {
        fileInput.classList.remove("error-input");
        errorMessage.classList.add("hidden");
    }
}

function commentHandler(event){
    let comment = event.target;
    let errorMessage = document.getElementById("error-text-comment");

    if(!validateComment(comment.value.trim())){
        comment.classList.add("error-input");
        errorMessage.classList.remove("hidden");
    }
    else {
        comment.classList.remove("error-input");
        errorMessage.classList.add("hidden");
    }
}


/************************************************************/
/********************* AJAX HANDLERS ************************/
/************************************************************/

function waitForPosts(limit) {
    setInterval(() => getNewPosts(limit), 10000);

}

function getNewPosts(limit){
    let post = parseInt(document.getElementById("front-page-posts").firstElementChild.id);

    if(!isNaN(post)){
        let xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function(){
            if(xhr.readyState == 4 && xhr.status == 200){
                let postArray = null;

                postArray = JSON.parse(xhr.responseText);
                console.log(postArray);

                let frontPagePosts = document.getElementById("front-page-posts");

                if(postArray.length > 0){
                    for(let i = 0; i < postArray.length;  i++){
                        let jsonObject = postArray[i];
                        let newFullPost = document.createElement("div");
                        newFullPost.setAttribute('id', jsonObject.post_id);
                        newFullPost.classList.add('full-post');
                        newFullPost.innerHTML = `
                            <img src="` + jsonObject.profile_photo + `" alt="Profile Picture" class="post-avatar" />
                            <div class="post-username">` + jsonObject.username + `</div>
                            <div class="post-time">` + jsonObject.timestamp + `</div>
                            <div class="post-title-full">
                                <a href="viewPost.php?post_id=` + jsonObject.post_id + `">` + jsonObject.title + `</a>
                            </div>
                            <div class="post-content-full">` + jsonObject.content + `</div>
                            <img src="` + jsonObject.post_image + `" alt="Post Image" class="post-photo-full" />
                        `;

                        frontPagePosts.insertBefore(newFullPost, frontPagePosts.firstChild);
                    }                   

                    if (frontPagePosts.children.length > limit) {
                        while (frontPagePosts.children.length > limit) {
                            frontPagePosts.removeChild(frontPagePosts.lastChild);
                        }
                    }
                }
            }
        }
        xhr.open("GET", "ajaxBackend.php?lastPostId=" + post + "&limit=" + limit, true);
	 	xhr.send();
    }
}
	// if (username.length > 0) {
	// 	let xhr = new XMLHttpRequest();
	// 	xhr.onreadystatechange = function () {
	// 		if (xhr.readyState == 4 && xhr.status == 200) {

	// 			let loginHistoryArray = null;
	// 			// TODO 6a: Parse the response text into JSON format and keep it on the 'loginHistoryArray' variable;
	// 			loginHistoryArray = JSON.parse(xhr.responseText);

	// 			let lastLoginDiv = document.getElementById("last-login");
	// 			lastLoginDiv.innerHTML = '';
	// 			if (loginHistoryArray.length > 0) {
	// 				let usernameFromBackendData = loginHistoryArray[0].username;
	// 				let pTag = document.createElement("p");
	// 				pTag.textContent = username + " last logged in on:";
	// 				lastLoginDiv.append(pTag);

	// 				if (username == usernameFromBackendData) {

	// 					// TODO 6b: Complete the logic in the for loop to iterate all items of the 'loginHistoryArray' array.
	// 					for (let i = 0; i < loginHistoryArray.length;  i++) {
	// 						let jsonObject = loginHistoryArray[i];
	// 						let loginTime = jsonObject.login_time;


	// 						// TODO 6c: create p tag for each loginTime and append that tag as a child of the lastLoginDiv.  
	// 						let newPTag = document.createElement("p");
	// 						newPTag.textContent = loginTime;
	// 						lastLoginDiv.append(newPTag);

	// 						// TODO 6b: Loop Ends
	// 					}
	// 				}
	// 			} else {
	// 				const pTag = document.createElement("p");
	// 				const textnode = document.createTextNode("No previous login found for " + username + ".");
	// 				pTag.appendChild(textnode);
	// 				lastLoginDiv.appendChild(pTag);
	// 			}
	// 		}
	// 	}

	// 	// TODO 4c: Open and send a GET ajax request including the username to the 'ajax_backend.php' file. 
	// 	// ...
	// 	xhr.open("GET", "ajax_backend.php?username=" + username, true);
	// 	xhr.send();
	// } else {
	// 	let lastLoginText = document.getElementById("last-login");
	// 	lastLoginText.innerHTML = "";
	// }