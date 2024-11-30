
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