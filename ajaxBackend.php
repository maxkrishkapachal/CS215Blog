<?php
require_once("db.php");

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data); 
    return $data;
}

session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'User not logged in']);
    exit();
}

// Check the request type
$userId = $_SESSION['user_id'];
$requestType = isset($_GET['req']) ? $_GET['req'] : null;

try {
    $db = new PDO($attr, $db_user, $db_pwd, $options);
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
    exit();
}

if ($requestType == 'p') {
    $lastPostId = isset($_GET['lastPostId']) ? (int)$_GET['lastPostId'] : null;
    $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : null;


    if ($lastPostId != null && $limit != null) {

        // Connect to the database and verify the connection
        try {
            $db = new PDO($attr, $db_user, $db_pwd, $options);

            // Query to get the last login detail for the user
            $query = "SELECT p.*, u.username, u.profile_photo FROM post p JOIN users u ON p.user_id = u.user_id AND post_id > $lastPostId ORDER BY post_id ASC LIMIT $limit";
            $result = $db->query($query);

            // Create an empty array
            $jsonArray = array();

            foreach($result as $row){
                $jsonArray[] = $row;
            }

            echo json_encode($jsonArray);

            // Close the database connection
            $db = null;
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }
    else {
        // If parameters are invalid, return an error response
        echo json_encode(["error" => "Invalid parameters"]);
    }
}
else if ($requestType == 'c'){
    $lastCommentId = isset($_GET['lastCommentId']) ? (int)$_GET['lastCommentId'] : null;
    $postId = isset($_GET['postId']) ? (int)$_GET['postId'] : null;

    if ($lastCommentId !== null && $postId !== null) {

        // Connect to the database and verify the connection
        try {
            // Query to get comments for a specific post
            $commentQuery = "SELECT c.*, u.username, u.profile_photo, 
                    SUM(CASE WHEN v.updown = 1 THEN 1 ELSE 0 END) AS upvotes, 
                    SUM(CASE WHEN v.updown = 0 THEN 1 ELSE 0 END) AS downvotes,
                    MAX(CASE WHEN v.user_id = $userId THEN v.updown ELSE NULL END) AS user_vote
                FROM comment c 
                JOIN users u ON c.user_id = u.user_id 
                LEFT JOIN vote v ON c.comment_id = v.comment_id
                WHERE c.post_id = $postId AND c.comment_id > $lastCommentId
                GROUP BY c.comment_id
                ORDER BY c.timestamp DESC";
            $comments = $db->query($commentQuery);

            // Return the comments as JSON
            $jsonArray = array();

            foreach($comments as $row){
                $jsonArray[] = $row;
            }

            echo json_encode($jsonArray);

            // Close the database connection
            $db = null;
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }
    else {
        // If parameters are invalid, return an error response
        echo json_encode(["error" => "Invalid parameters"]);
    }
}
else if($requestType == 'v'){
    $vote = isset($_GET['vote']) ? (int)$_GET['vote'] : null;
    $commentId = isset($_GET['commentId']) ? (int)$_GET['commentId'] : null;


    if ($vote !== null && $commentId !== null) {

        // Connect to the database and verify the connection
        try {
            $db = new PDO($attr, $db_user, $db_pwd, $options);

            // Query to get the last login detail for the user
            $query = "SELECT updown FROM vote WHERE user_id='$userId' AND comment_id='$commentId'";
            $result = $db->query($query, PDO::FETCH_ASSOC);
            $match = $result->fetch();

            if (!$match) {
                $query = "INSERT INTO vote (comment_id, user_id, updown) VALUES ('$commentId', '$userId', '$vote')";
                $result = $db->exec($query);                    
            }
            else if($match['updown'] !== $vote){
                $query = "UPDATE vote SET updown='$vote' WHERE user_id=$userId AND comment_id='$commentId'";
                $result = $db->exec($query);
            }

            $query = "SELECT 
                    SUM(CASE WHEN v.updown = 1 THEN 1 ELSE 0 END) AS upvotes,
                    SUM(CASE WHEN v.updown = 0 THEN 1 ELSE 0 END) AS downvotes
                FROM vote v
                WHERE comment_id = '$commentId'";
            $result = $db->query($query);
            $row = $result->fetch(PDO::FETCH_ASSOC);

            // Prepare response array
            $jsonArray = array();
            if ($row) {
                $jsonArray = [
                    'upvotes' => (int)$row['upvotes'],
                    'downvotes' => (int)$row['downvotes']
                ];
            }

            echo json_encode($jsonArray);

            // Close the database connection
            $db = null;
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }
    else {
        echo json_encode(['status' => 'error']);
    }
}
else {
    echo json_encode(['error' => 'Invalid request type']);
}

    $db = null;
?>