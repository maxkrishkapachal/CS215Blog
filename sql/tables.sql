CREATE TABLE users (
    user_id         INT             NOT NULL, AUTO_INCREMENT,
    email           VARCHAR(255)    NOT NULL,
    first_name      VARCHAR(255)    NOT NULL,
    last_name       VARCHAR(255)    NOT NULL,
    username        VARCHAR(255)    NOT NULL,
    password        VARCHAR(255)    NOT NULL,
    dob             VARCHAR(255)    NOT NULL,
    profile_photo   VARCHAR(255)    NOT NULL,
    PRIMARY KEY     (user_id)
);

CREATE TABLE post (
    post_id         INT             NOT NULL, AUTO_INCREMENT,
    user_id         INT             NOT NULL,
    timestamp       TIMESTAMP       NOT NULL,
    title           VARCHAR(255)    NOT NULL,
    content         VARCHAR(255)    NOT NULL,
    post_image      VARCHAR(255)    NOT NULL,
    PRIMARY KEY     (post_id),
    FOREIGN KEY     (user_id) REFERENCES users (user_id)
);

CREATE TABLE comment (
    comment_id      INT             NOT NULL, AUTO_INCREMENT,
    post_id         INT             NOT NULL,
    user_id         INT             NOT NULL,
    timestamp       TIMESTAMP       NOT NULL,
    content         VARCHAR(255)    NOT NULL,
    PRIMARY KEY     (comment_id),
    FOREIGN KEY     (user_id) REFERENCES users (user_id),
    FOREIGN KEY     (post_id) REFERENCES post (post_id)
);

CREATE TABLE post_vote (
    post_vote_id    INT             NOT NULL, AUTO_INCREMENT,
    post_id         INT             NOT NULL,
    user_id         INT             NOT NULL,
    updown          BOOLEAN         NOT NULL,
    PRIMARY KEY     (post_vote_id),
    FOREIGN KEY     (user_id) REFERENCES users (user_id),
    FOREIGN KEY     (post_id) REFERENCES post (post_id)
);

CREATE TABLE comment_vote (
    comment_vote_id INT             NOT NULL, AUTO_INCREMENT,
    comment_id      INT             NOT NULL,
    user_id         INT             NOT NULL,
    updown          BOOLEAN         NOT NULL,
    PRIMARY KEY     (post_vote_id),
    FOREIGN KEY     (user_id) REFERENCES users (user_id),
    FOREIGN KEY     (comment_id) REFERENCES comment (comment_id)
);

