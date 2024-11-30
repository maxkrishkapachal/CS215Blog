<?php
require_once("db.php");

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data); 
    return $data;
}

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'User not logged in']);
    exit();
}

// Check the request type
$requestType = isset($_GET['req']);

try {
    $db = new PDO($attr, $db_user, $db_pwd, $options);
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
    exit();
}

switch ($requestType) {
    case 'p':    // update post request
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
        break;

    case 'c': // update comment request
        
        break;

    case 'v':   // update vote request

        break;

    default:
        echo json_encode(['error' => 'Invalid request type']);
        break;



}

    $db = null;
?>