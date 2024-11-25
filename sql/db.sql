
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

CREATE TABLE IF NOT EXISTS vote (
    vote_id         INT             NOT NULL AUTO_INCREMENT,
    comment_id      INT             NOT NULL,
    user_id         INT             NOT NULL,
    updown          BOOLEAN         NOT NULL,
    PRIMARY KEY     (vote_id),
    FOREIGN KEY     (user_id) REFERENCES users (user_id),
    FOREIGN KEY     (comment_id) REFERENCES comment (comment_id)
);
