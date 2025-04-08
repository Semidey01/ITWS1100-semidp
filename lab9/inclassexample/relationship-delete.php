<?php
include('includes/init.inc.php');

$dbOk = false;
@$db = new mysqli('localhost', 'phpmyadmin', 'Antonio00!1074', 'iit');

if ($db->connect_error) {
    $connectErrors = array(
        'errors' => true,
        'errno' => mysqli_connect_errno(),
        'error' => mysqli_connect_error()
    );
    echo json_encode($connectErrors);
} else {
    if (isset($_POST["id"])) {
        $relationshipId = (int) $_POST["id"];
        
        $query = "DELETE FROM movie_actors WHERE id = ?";
        $statement = $db->prepare($query);
        $statement->bind_param("i", $relationshipId);
        $statement->execute();
        
        $success = array('errors'=>false,'message'=>'Delete successful');
        echo json_encode($success);
        
        $statement->close();
        $db->close();
    }
}
?>