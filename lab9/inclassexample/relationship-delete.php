<?php
include('includes/init.inc.php');

// Set header for JSON response
header('Content-Type: application/json');

$dbOk = false;
@$db = new mysqli('localhost', 'phpmyadmin', 'Antonio00!1074', 'iit');

if ($db->connect_error) {
    echo json_encode([
        'errors' => true,
        'errno' => mysqli_connect_errno(),
        'error' => mysqli_connect_error(),
        'message' => 'Database connection failed'
    ]);
    exit;
}

if (isset($_POST["id"])) {
    $relationshipId = (int) $_POST["id"];
    
    // Validate ID
    if ($relationshipId <= 0) {
        echo json_encode([
            'errors' => true,
            'message' => 'Invalid ID provided'
        ]);
        exit;
    }
    
    $query = "DELETE FROM movie_actors WHERE id = ?";
    $statement = $db->prepare($query);
    
    if (!$statement) {
        echo json_encode([
            'errors' => true,
            'message' => 'Prepare failed: ' . $db->error
        ]);
        exit;
    }
    
    $statement->bind_param("i", $relationshipId);
    $result = $statement->execute();
    
    if ($result) {
        echo json_encode([
            'errors' => false,
            'message' => 'Delete successful',
            'affected_rows' => $statement->affected_rows
        ]);
    } else {
        echo json_encode([
            'errors' => true,
            'message' => 'Delete failed: ' . $statement->error
        ]);
    }
    
    $statement->close();
} else {
    echo json_encode([
        'errors' => true,
        'message' => 'No ID provided'
    ]);
}

$db->close();
?>