<?php
require_once("db.php");

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data); 
    return $data;
}

$lastPostId = (int)$_GET["lastPostId"] ?? NAN;
$limit = (int)$_GET["limit"] ?? NAN;


if (!is_nan($lastPostId) && !is_nan($limit)) {

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
