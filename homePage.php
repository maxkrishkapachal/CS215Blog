<!-- 
Max Krishka-Pachal
200526378
October 1 2024
CS 215
Assignment 2
homePage.html
-->

<!DOCTYPE html>
<html>

    <head>
        <title>Main Page After Login</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="description" content="the front page of basecamp before the user has logged in" />
        <link rel="stylesheet" type="text/css" href="css/styles.css" />
    </head>

    <body>
        <div id="container">
            <header id="header">
                <div id="logo">
                    <!-- header logo -->
                    <img src="images/LogoNoWordsNoLineTransparent.png" alt="Logo" id="logo-image" />
                    <div id="company-name">BASECAMP</div>
                </div>
                <div id="header-button-container">
                    <!-- logout button -->
                    <a href="index.php" class="button-style">Logout</a>
                </div>
            </header>

            <div id="profile" class="profile-else">
                <!-- profile username -->
                <div class="title-text">USERNAME</div>
                
                <!-- profile options -->
                <div class="button-grid"> 
                    <img src="images/red-netflix-profile.jpg" alt="red netflix profile picture" id="profile-picture" />
                    <a href="homePage.php" class="button-style">DISCOVER</a>
                    <a href="createPost.php" class="button-style">CREATE</a>
                    <a href="managePost.php" class="button-style">MANAGE</a>
                </div>
            </div>

            <div id="announcement-bar">
                <div class="title-text">CHECK OUT THE NEWEST POSTS:</div>
            </div>

            <div id="front-page-posts">
                <!-- shows the top 20 posts, placeholders for now -->
                <div class="individual-post">
                    <img src="images/blue-netflix-profile.jpg" alt="blue netflix profile picture" class="post-avatar" />
                    <div class="post-username">CAMPFIRECRAFTER</div>
                    <div class="post-time">MARCH 22 2024 23:31</div>
                    <div class="post-title">
                        <a href="viewPost.php">The Art of Campfire Cooking</a>
                    </div>
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
                    <div class="post-title">
                        <a href="viewPost.php">Campfire Stories</a>
                    </div>
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
                    <div class="post-title">
                        <a href="viewPost.php">camping snacks</a>
                    </div>
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
                    <div class="post-title">
                        <a href="viewPost.php">Camping with pets?</a>
                    </div>
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
                    <div class="post-title">
                        <a href="viewPost.php">Best Camping Locations!</a>
                    </div>
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
                <div class="individual-post">
                    <img src="images/blue-netflix-profile.jpg" alt="blue netflix profile picture" class="post-avatar" />
                    <div class="post-username">CAMPCHASER</div>
                    <div class="post-time">OCTOBER 1 2024 8:32</div>
                    <div class="post-title">
                        <a href="viewPost.php">Share your scariest campfire story</a>
                    </div>
                    <div class="post-content-preview">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                        Nulla tempor, metus ut elementum aliquam, nisi 
                        turpis imperdiet dui, in scelerisque quam ipsum 
                        nec nunc. Sed quis quam nisi. Class aptent taciti 
                        sociosqu ad litora torquent per conubia nostra, 
                        per inceptos himenaeos. Sed dolor mi, suscipit sit 
                        amet quam eget, finibus hendrerit arcu. Sed eu 
                        purus nibh. Vivamus at quam in risus volutpat 
                        elementum. Maecenas magna leo, luctus in orci sit 
                        amet, molestie faucibus augue. Mauris varius, 
                        nibh eu gravida scelerisque, augue sem fermentum 
                        ante, et accumsan est est eu nulla.
                    </div>
                    <img src="images/camping6.jpg" alt="camping photo six" class="post-photo" />
                    <div class="post-stats">
                        <div class="post-likes">124 Likes</div>
                        <div class="post-comments">45 Comments</div>
                    </div> 
                </div>
                <div class="individual-post">
                    <img src="images/red-netflix-profile.jpg" alt="red netflix profile picture" class="post-avatar" />
                    <div class="post-username">FORESTFOOTPRINTS</div>
                    <div class="post-time">OCTOBER 1 16:22</div>
                    <div class="post-title">
                        <a href="viewPost.php">My tent just collapsed. what now?</a>
                    </div>
                    <div class="post-content-preview">
                        Curabitur eget pretium tellus. Pellentesque vulputate 
                        diam at odio sodales, at scelerisque eros pellentesque. 
                        Nam suscipit porta dictum. Fusce hendrerit eros et
                        elit elementum viverra. Ut egestas tellus gravida 
                        erat mollis consectetur vulputate ac nibh. Nunc 
                        sit amet eros aliquam, hendrerit risus sed, tempus 
                        metus. Vestibulum eu interdum purus. 
                    </div>
                    <img src="images/camping7.jpg" alt="camping photo seven" class="post-photo" />
                    <div class="post-stats">
                        <div class="post-likes">2.6k Likes</div>
                        <div class="post-comments">180 Comments</div>
                    </div> 
                </div>
                <div class="individual-post">
                    <img src="images/green-netflix-profile.jpg" alt="gree netflix profile picture" class="post-avatar" />
                    <div class="post-username">BACKPACK_ADVENTURER_35</div>
                    <div class="post-time">OCTOBER 1 2024 19:20</div>
                    <div class="post-title">
                        <a href="viewPost.php">accidentally started a fire in my tent!</a>
                    </div>
                    <div class="post-content-preview">
                        Aenean augue diam, aliquet sit amet convallis ut, 
                        auctor et lorem. Aenean eleifend augue eget tellus
                        hendrerit, non cursus risus porta. Integer in 
                        massa nisl. Vestibulum ante ipsum primis in 
                        faucibus orci luctus et ultrices posuere cubilia 
                        curae; Nullam porttitor dolor quis lorem bibendum, 
                        ut rutrum neque elementum. Phasellus at condimentum 
                        dolor. Vestibulum quis lorem vel metus lacinia 
                        ornare. Etiam sed eros tincidunt, auctor erat vel, 
                        vehicula ex. Phasellus convallis tellus nec metus 
                        aliquam dictum. Vivamus lacus mauris, venenatis in 
                        justo in, tristique sodales lectus. 
                    </div>
                    <img src="images/camping8.jpg" alt="camping photo eight" class="post-photo" />
                    <div class="post-stats">
                        <div class="post-likes">4.8k Likes</div>
                        <div class="post-comments">1.0k Comments</div>
                    </div> 
                </div>
                <div class="individual-post">
                    <img src="images/teal-netflix-profile.png" alt="teal netflix profile picture" class="post-avatar" />
                    <div class="post-username">TRAIL_BLAZE</div>
                    <div class="post-time">OCTOBER 1 2024 21:58</div>
                    <div class="post-title">
                        <a href="viewPost.php">I think I just saw a ghost on the trail...</a>
                    </div>
                    <div class="post-content-preview">
                        Sed feugiat ipsum ut neque posuere mattis ut viverra 
                        turpis. Praesent viverra nisi in velit porttitor 
                        sodales. Donec interdum, orci at sagittis malesuada, 
                        enim ipsum blandit erat, ac sodales massa nulla in 
                        justo. Vestibulum ullamcorper libero id quam dictum 
                        gravida. Etiam tempor suscipit dolor, nec condimentum 
                        ante mattis at. Quisque bibendum placerat nisl. 
                        Cras et commodo turpis. Etiam vel ante id velit 
                        tempor laoreet eget a leo. Pellentesque ullamcorper 
                        blandit lectus sit amet commodo. 
                    </div>
                    <img src="images/camping9.jpg" alt="camping photo nine" class="post-photo" />
                    <div class="post-stats">
                        <div class="post-likes">2.6k Likes</div>
                        <div class="post-comments">1.3k Comments</div>
                    </div> 
                </div>
                <div class="individual-post">
                    <img src="images/yellow-netflix-profile.jpg" alt="yellow netflix profile picture" class="post-avatar" />
                    <div class="post-username">STARGAZERSAM</div>
                    <div class="post-time">OCTOBER 2 2024 2:34</div>
                    <div class="post-title">
                        <a href="viewPost.php">Do I need a sleeping pad?</a>
                    </div>
                    <div class="post-content-preview">
                        Lorem ipsum dolor sit amet, consectetur adipiscing 
                        elit. Vivamus ac tellus eget ligula lobortis 
                        placerat vel in quam. Proin porttitor maximus elit, 
                        id blandit nisi egestas faucibus. Aliquam euismod 
                        tellus nec augue bibendum vestibulum. Nunc convallis 
                        nisi at mi suscipit tincidunt. Morbi fringilla ligula 
                        sem, eu elementum risus facilisis at. Pellentesque 
                        maximus ullamcorper tortor, at commodo metus. Sed 
                        dignissim feugiat sapien vitae condimentum. Maecenas 
                        consectetur hendrerit orci nec tincidunt. 
                    </div>
                    <img src="images/camping10.jpg" alt="camping photo ten" class="post-photo" />
                    <div class="post-stats">
                        <div class="post-likes">920 Likes</div>
                        <div class="post-comments">140 Comments</div>
                    </div> 
                </div>
                <div class="individual-post">
                    <img src="images/blue-netflix-profile.jpg" alt="blue netflix profile picture" class="post-avatar" />
                    <div class="post-username">TENTGURU</div>
                    <div class="post-time">OCTOBER 2 2024 4:55</div>
                    <div class="post-title">
                        <a href="viewPost.php">Why do marshmallows always burn on me?</a>
                    </div>
                    <div class="post-content-preview">
                        Sed tempus neque quam, ut bibendum dui maximus nec. 
                        Nunc leo est, dignissim id laoreet eu, feugiat at 
                        erat. Vestibulum at mauris eros. Pellentesque nec 
                        mauris lobortis, placerat nunc at, tincidunt elit. 
                        Sed posuere bibendum nibh, in congue sem. Quisque 
                        nec odio a mi efficitur vulputate in porta mauris. 
                        Integer diam nisl, sollicitudin rhoncus nibh vel, 
                        maximus bibendum quam. Donec suscipit tincidunt 
                        tortor eu aliquam. Nunc venenatis, lorem ac venenatis 
                        egestas, orci justo aliquet erat, et rhoncus neque 
                        ligula ut lorem. 
                    </div>
                    <img src="images/camping11.jpg" alt="camping photo eleven" class="post-photo" />
                    <div class="post-stats">
                        <div class="post-likes">1.4k Likes</div>
                        <div class="post-comments">380 Comments</div>
                    </div> 
                </div>
                <div class="individual-post">
                    <img src="images/red-netflix-profile.jpg" alt="red netflix profile picture" class="post-avatar" />
                    <div class="post-username">PATHSEEKER23</div>
                    <div class="post-time">OCTOBER 2 2024 12:12</div>
                    <div class="post-title">
                        <a href="viewPost.php">First time camper - tips for staying warm?</a>
                    </div>
                    <div class="post-content-preview">
                        Morbi sed elementum risus. Sed fermentum commodo 
                        dolor at convallis. Nulla id ornare dui. Maecenas 
                        non sem placerat, molestie urna eget, tempor sem. 
                        Nam sit amet aliquet purus. Pellentesque posuere 
                        molestie risus quis venenatis. Cras eu ipsum in 
                        eros hendrerit tristique eu in ipsum. Sed mollis 
                        odio quis ultrices tempor. 
                    </div>
                    <img src="images/camping12.jpg" alt="camping photo twelve" class="post-photo" />
                    <div class="post-stats">
                        <div class="post-likes">207 Likes</div>
                        <div class="post-comments">55 Comments</div>
                    </div> 
                </div>
                <div class="individual-post">
                    <img src="images/green-netflix-profile.jpg" alt="green netflix profile picture" class="post-avatar" />
                    <div class="post-username">WOODS_WANDERER</div>
                    <div class="post-time">OCTOBER 2 2024 13:15</div>
                    <div class="post-title">
                        <a href="viewPost.php">Made a new contraption to keep bears out of my food!</a>
                    </div>
                    <div class="post-content-preview">
                        Nam varius urna vel dignissim ultricies. 
                        Suspendisse tristique lacus ac iaculis aliquet. 
                        Aenean et nunc pharetra, convallis ligula nec, 
                        consequat enim. Maecenas tempor dolor nec tortor 
                        lacinia porta. Vivamus magna nibh, viverra in 
                        ligula vitae, tempus volutpat orci. Etiam 
                        condimentum accumsan neque, id sodales justo 
                        commodo eget. Maecenas dapibus tortor diam, at 
                        rutrum dolor luctus ut. Mauris eu tortor hendrerit, 
                        euismod massa vel, tristique sem. Vivamus pretium 
                        magna at lectus cursus bibendum. Vivamus eu congue 
                        elit, at rhoncus nunc. Nullam eu dapibus ante. 
                        Vestibulum euismod commodo nisi sit amet vehicula. 
                    </div>
                    <img src="images/camping13.jpg" alt="camping photo thirteen" class="post-photo" />
                    <div class="post-stats">
                        <div class="post-likes">760 Likes</div>
                        <div class="post-comments">169 Comments</div>
                    </div> 
                </div>
                <div class="individual-post">
                    <img src="images/teal-netflix-profile.png" alt="teal netflix profile picture" class="post-avatar" />
                    <div class="post-username">FIREWOOD_FANATIC</div>
                    <div class="post-time">OCTOBER 2 2024 15:35</div>
                    <div class="post-title">
                        <a href="viewPost.php">Is glamping real camping? Discussion:</a>
                    </div>
                    <div class="post-content-preview">
                        Vivamus quis nibh vel mauris pharetra commodo a nec 
                        lorem. Fusce eu commodo ex. Nunc sed augue mattis 
                        ligula euismod ullamcorper non ut dui. Curabitur 
                        eu sapien blandit, aliquet nibh quis, ullamcorper
                        erat. Aenean pretium ipsum arcu, sed sodales orci 
                        aliquam ac. Fusce feugiat pretium nulla et posuere. 
                        Integer pretium metus eget justo efficitur semper. 
                        Duis dictum sem dolor, sed porttitor quam cursus 
                        feugiat. Quisque volutpat sapien pulvinar est 
                        egestas hendrerit.
                    </div>
                    <img src="images/camping14.jpg" alt="camping photo fourteen" class="post-photo" />
                    <div class="post-stats">
                        <div class="post-likes">1.5 Likes</div>
                        <div class="post-comments">723 Comments</div>
                    </div> 
                </div>
                <div class="individual-post">
                    <img src="images/yellow-netflix-profile.jpg" alt="yellow netflix profile picture" class="post-avatar" />
                    <div class="post-username">CAMP_SITE_CRAZE</div>
                    <div class="post-time">OCTOBER 2 2024 16:01</div>
                    <div class="post-title">
                        <a href="viewPost.php">How I make full meals in the middle of the woods!</a>
                    </div>
                    <div class="post-content-preview">
                        Aliquam tincidunt neque pretium dui semper, et dictum quam 
                        malesuada. Nulla facilisi. In hac habitasse platea dictumst. 
                        Donec ac mauris non tellus maximus venenatis ut in eros. Sed 
                        magna lorem, efficitur et tempus at, sagittis et neque. 
                        Vestibulum commodo enim at urna commodo, et mattis nisi tempor. 
                        Phasellus dictum justo ut fringilla ultrices. Aliquam ac 
                        purus lectus.
                    </div>
                    <img src="images/camping15.jpg" alt="camping photo fifteen" class="post-photo" />
                    <div class="post-stats">
                        <div class="post-likes">402 Likes</div>
                        <div class="post-comments">235 Comments</div>
                    </div> 
                </div>
                <div class="individual-post">
                    <img src="images/blue-netflix-profile.jpg" alt="blue netflix profile picture" class="post-avatar" />
                    <div class="post-username">PACKITPRO</div>
                    <div class="post-time">OCTOBER 2 2024 23:53</div>
                    <div class="post-title">
                        <a href="viewPost.php">Forgot to pack socks. Had to improvise.</a>
                    </div>
                    <div class="post-content-preview">
                        Donec egestas, erat et rutrum dictum, est ante ornare odio, 
                        at aliquam risus odio vel quam. Sed ac sem elit. Nullam 
                        tempor felis eu enim faucibus eleifend. Praesent rhoncus 
                        accumsan libero vel pellentesque. Suspendisse aliquet risus 
                        sed lorem cursus, in faucibus sapien tempor. Maecenas nec 
                        dapibus eros. Proin congue velit odio. 
                    </div>
                    <img src="images/camping16.jpg" alt="camping photo sixteen" class="post-photo" />
                    <div class="post-stats">
                        <div class="post-likes">890 Likes</div>
                        <div class="post-comments">532 Comments</div>
                    </div> 
                </div>
                <div class="individual-post">
                    <img src="images/red-netflix-profile.jpg" alt="red netflix profile picture" class="post-avatar" />
                    <div class="post-username">HAMMOCK_HANNAH</div>
                    <div class="post-time">OCTOBER 3 2024 6:16</div>
                    <div class="post-title">
                        <a href="viewPost.php">Should I get walking sticks?</a>
                    </div>
                    <div class="post-content-preview">
                        Cras euismod sollicitudin nibh in euismod. Sed tincidunt elit 
                        vel dolor pharetra, eget ullamcorper massa dapibus. Pellentesque 
                        habitant morbi tristique senectus et netus et malesuada fames 
                        ac turpis egestas. Donec eu nunc velit. Aenean facilisis sed 
                        orci at semper. Nulla in nunc aliquet, rutrum neque elementum, 
                        tincidunt ligula. Aenean tristique dolor vitae efficitur 
                        fermentum.
                    </div>
                    <img src="images/camping17.jpg" alt="camping photo seventeen" class="post-photo" />
                    <div class="post-stats">
                        <div class="post-likes">1.3k Likes</div>
                        <div class="post-comments">673 Comments</div>
                    </div> 
                </div>
                <div class="individual-post">
                    <img src="images/green-netflix-profile.jpg" alt="green netflix profile picture" class="post-avatar" />
                    <div class="post-username">OUTDOOR_CHEF</div>
                    <div class="post-time">OCTOBER 3 2024 10:22</div>
                    <div class="post-title">
                        <a href="viewPost.php">Check out my fun campfire recipes!</a>
                    </div>
                    <div class="post-content-preview">
                        Nullam ac maximus ipsum, at pharetra lacus. Phasellus aliquam 
                        massa quis euismod tincidunt. Donec augue lectus, ullamcorper 
                        in dolor in, elementum aliquet massa. Suspendisse potenti. 
                        Class aptent taciti sociosqu ad litora torquent per conubia 
                        nostra, per inceptos himenaeos. Sed ante libero, maximus 
                        scelerisque egestas non, aliquet in diam. Donec eros mi, 
                        ultricies vitae suscipit fringilla, elementum quis ex. Donec 
                        at libero tellus. 
                    </div>
                    <img src="images/camping18.jpg" alt="camping photo eighteen" class="post-photo" />
                    <div class="post-stats">
                        <div class="post-likes">578 Likes</div>
                        <div class="post-comments">345 Comments</div>
                    </div> 
                </div>
                <div class="individual-post">
                    <img src="images/teal-netflix-profile.png" alt="teal netflix profile picture" class="post-avatar" />
                    <div class="post-username">WILDFLOWER_GIRL</div>
                    <div class="post-time">OCTOBER 3 2024 16:45</div>
                    <div class="post-title">
                        <a href="viewPost.php">First time camping in the rockies! Totally worth it.</a>
                    </div>
                    <div class="post-content-preview">
                        Donec imperdiet tortor non dictum interdum. Maecenas dignissim 
                        accumsan luctus. Mauris justo felis, laoreet et ultrices id, 
                        convallis id est. Mauris viverra, orci vel rutrum fermentum, 
                        orci ipsum malesuada lacus, a ultrices arcu velit in tellus. 
                        Nam commodo arcu dolor, non blandit tortor dignissim vel. 
                        Mauris eget orci vestibulum, mattis nulla sed, congue tellus. 
                        Suspendisse turpis purus, condimentum eget tempus non, dapibus 
                        at nisi. 
                    </div>
                    <img src="images/camping19.jpg" alt="camping photo nineteen" class="post-photo" />
                    <div class="post-stats">
                        <div class="post-likes">431 Likes</div>
                        <div class="post-comments">133 Comments</div>
                    </div> 
                </div>
                <div class="individual-post">
                    <img src="images/yellow-netflix-profile.jpg" alt="yellow netflix profile picture" class="post-avatar" />
                    <div class="post-username">SMORE_MASTER</div>
                    <div class="post-time">OCTOBER 3 2024 22:54</div>
                    <div class="post-title">
                        <a href="viewPost.php">Anyone got an extra flashlight?</a>
                    </div>
                    <div class="post-content-preview">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                        Nulla eleifend tincidunt sagittis. Suspendisse lobortis 
                        ipsum vel ipsum tempor, non eleifend justo vulputate. 
                        Suspendisse sodales tellus vel lorem posuere, sit amet viverra 
                        nibh dignissim. Nullam sagittis erat vitae leo blandit varius. 
                        Proin ut dui non mauris pharetra maximus. Quisque id massa 
                        mauris. 
                    </div>
                    <img src="images/camping20.jpg" alt="camping photo twenty" class="post-photo" />
                    <div class="post-stats">
                        <div class="post-likes">553 Likes</div>
                        <div class="post-comments">243 Comments</div>
                    </div> 
                </div>
            </div>
        </div>
    </body>
</html>