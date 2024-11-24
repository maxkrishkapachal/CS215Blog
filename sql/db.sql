
CREATE TABLE IF NOT EXISTS users (
    user_id         INT             NOT NULL AUTO_INCREMENT,
    first_name      VARCHAR(50),    
    last_name       VARCHAR(50),  
    email           VARCHAR(50)     NOT NULL,  
    username        VARCHAR(50)     NOT NULL,
    password        VARCHAR(50)     NOT NULL,
    dob             DATE            NOT NULL,
    profile_photo   VARCHAR(255)    NOT NULL,
    PRIMARY KEY     (user_id)
);

CREATE TABLE IF NOT EXISTS post (
    post_id         INT             NOT NULL AUTO_INCREMENT,
    user_id         INT             NOT NULL,
    timestamp       TIMESTAMP       NOT NULL,
    title           VARCHAR(100)    NOT NULL,
    content         VARCHAR(2000)   NOT NULL,
    post_image      VARCHAR(255)    NOT NULL,
    PRIMARY KEY     (post_id),
    FOREIGN KEY     (user_id) REFERENCES users (user_id)
);

CREATE TABLE IF NOT EXISTS comment (
    comment_id      INT             NOT NULL AUTO_INCREMENT,
    post_id         INT             NOT NULL,
    user_id         INT             NOT NULL,
    timestamp       TIMESTAMP       NOT NULL,
    content         VARCHAR(1000)   NOT NULL,
    PRIMARY KEY     (comment_id),
    FOREIGN KEY     (user_id) REFERENCES users (user_id),
    FOREIGN KEY     (post_id) REFERENCES post (post_id)
);

CREATE TABLE IF NOT EXISTS postvote (
    post_vote_id    INT             NOT NULL AUTO_INCREMENT,
    post_id         INT             NOT NULL,
    user_id         INT             NOT NULL,
    updown          BOOLEAN         NOT NULL,
    PRIMARY KEY     (post_vote_id),
    FOREIGN KEY     (user_id) REFERENCES users (user_id),
    FOREIGN KEY     (post_id) REFERENCES post (post_id)
);

CREATE TABLE IF NOT EXISTS commentvote (
    comment_vote_id INT             NOT NULL AUTO_INCREMENT,
    comment_id      INT             NOT NULL,
    user_id         INT             NOT NULL,
    updown          BOOLEAN         NOT NULL,
    PRIMARY KEY     (comment_vote_id),
    FOREIGN KEY     (user_id) REFERENCES users (user_id),
    FOREIGN KEY     (comment_id) REFERENCES comment (comment_id)
);


-- 1. INSERT INTO users (email, first_name, last_name, username, password, dob, profile_photo)
-- VALUES
-- ("mjk991@uregina.ca", "Max", "Krishka-Pachal", "mjk991", "goodPassword", "2000-01-01", "maxphoto.jpg"),
-- ("dsj361@uregina.ca", "Dmytro", "Stepaniuk", "dsj361", "passwordThatIsGood", "2000-01-01", "dmytrophoto.jpg"); 


-- 2. INSERT INTO post (user_id, timestamp, title, content, post_image)
-- VALUES
-- (1, "2022-06-10 8:30:00", "Camping is my favourite", "It's the best! Everyone should try camping!", "coolCampingPhoto.jpg"),
-- (2, "2024-07-24 2:47:35", "Camping snacks??", "I need a good snack that I can fit in my backpack. There's already no room in there!", "defaultPhoto.jpg");


-- 3. INSERT INTO comment (post_id, user_id, timestamp, content)
-- VALUES
-- (1, 2, "2023-01-03 10:02:50", "I totally agree."),
-- (2, 1, "2024-11-23 15:22:01", "That's such a good idea! I'll have to try that next time.");


-- 4. INSERT INTO postvote (post_id, user_id, updown)
-- VALUES
-- (1, 2, TRUE),
-- (1, 1, FALSE);


-- INSERT INTO commentvote (comment_id, user_id, updown)
-- VALUES
-- (2, 1, TRUE),
-- (2, 1, FALSE);

-- SELECT * FROM users;

-- SELECT * FROM post;

-- SELECT * FROM comment;

-- SELECT * FROM postvote;

-- SELECT * FROM commentvote;


-- // Part C
-- 1. SELECT user_id, first_name, last_name, username, email, profile_photo
-- FROM users
-- WHERE email = 'dsj361@uregina.ca' AND password = 'passwordThatIsGood';  //replace with actual email and password

-- 2. SELECT p.post_id, p.title, p.content, p.timestamp, p.post_image, COUNT(c.comment_id) AS comment_count
-- FROM post p
-- LEFT JOIN comment c ON p.post_id = c.post_id
-- GROUP BY p.post_id
-- ORDER BY p.timestamp DESC
-- LIMIT 5;

-- SELECT post_id, title, content, timestamp, post_image
-- FROM post
-- ORDER BY timestamp DESC
-- LIMIT 20;

-- 3. SELECT p.post_id, p.timestamp, p.content, p.post_image,
--        c.comment_id, c.content AS comment_content, u.username AS commenter_name, u.profile_photo AS commenter_avatar,
--        c.timestamp AS comment_timestamp,
--        COALESCE(SUM(CASE WHEN cv.updown = TRUE THEN 1 ELSE 0 END), 0) AS up_votes,
--        COALESCE(SUM(CASE WHEN cv.updown = FALSE THEN 1 ELSE 0 END), 0) AS down_votes
-- FROM post p
-- LEFT JOIN comment c ON p.post_id = c.post_id
-- LEFT JOIN users u ON c.user_id = u.user_id
-- LEFT JOIN commentvote cv ON c.comment_id = cv.comment_id
-- WHERE p.user_id = '2'
-- GROUP BY p.post_id, c.comment_id
-- ORDER BY p.timestamp DESC;

-- 4. SELECT p.post_id, p.title, p.content, p.timestamp, p.post_image,
--        c.comment_id, c.content AS comment_content, u.username AS commenter_name, u.profile_photo AS commenter_avatar,
--        c.timestamp AS comment_timestamp,
--        COALESCE(SUM(CASE WHEN cv.updown = TRUE THEN 1 ELSE 0 END), 0) AS up_votes,
--        COALESCE(SUM(CASE WHEN cv.updown = FALSE THEN 1 ELSE 0 END), 0) AS down_votes,
--        (COALESCE(SUM(CASE WHEN cv.updown = TRUE THEN 1 ELSE 0 END), 0) - COALESCE(SUM(CASE WHEN cv.updown = FALSE THEN 1 ELSE 0 END), 0)) AS voting_score
-- FROM post p
-- LEFT JOIN comment c ON p.post_id = c.post_id
-- LEFT JOIN users u ON c.user_id = u.user_id
-- LEFT JOIN commentvote cv ON c.comment_id = cv.comment_id
-- WHERE p.post_id = '2'
-- GROUP BY p.post_id, c.comment_id
-- ORDER BY voting_score DESC;



