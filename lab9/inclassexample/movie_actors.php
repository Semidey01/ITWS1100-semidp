<?php 
include('includes/init.inc.php');
include('includes/functions.inc.php');
?>
<title>PHP &amp; MySQL - ITWS</title>   
<?php include('includes/head.inc.php'); ?>

<h1>PHP &amp; MySQL</h1>
<?php include('includes/menubody.inc.php'); ?>

<?php
$dbOk = false;
@$db = new mysqli('localhost', 'phpmyadmin', 'Antonio00!1074', 'iit');

if ($db->connect_error) {
   echo '<div class="messages">Could not connect to the database. Error: ';
   echo $db->connect_errno . ' - ' . $db->connect_error . '</div>';
} else {
   $dbOk = true;
}

// Process form submission
$havePost = isset($_POST["save"]);
$errors = '';
if ($havePost) {
   $firstNames = htmlspecialchars(trim($_POST["firstNames"]));
   $lastName = htmlspecialchars(trim($_POST["lastName"]));
   $movieTitle = htmlspecialchars(trim($_POST["movieTitle"]));

   $focusId = '';
   if ($firstNames == '') {
      $errors .= '<li>First name may not be blank</li>';
      if ($focusId == '') $focusId = '#firstNames';
   }
   if ($lastName == '') {
      $errors .= '<li>Last name may not be blank</li>';
      if ($focusId == '') $focusId = '#lastName';
   }
   if ($movieTitle == '') {
      $errors .= '<li>Movie title may not be blank</li>';
      if ($focusId == '') $focusId = '#movieTitle';
   }

   if ($errors != '') {
      echo '<div class="messages"><h4>Please correct the following errors:</h4><ul>';
      echo $errors;
      echo '</ul></div>';
      echo '<script type="text/javascript">';
      echo '  $(document).ready(function() {';
      echo '    $("' . $focusId . '").focus();';
      echo '  });';
      echo '</script>';
   } else if ($dbOk) {
      $insQuery = "INSERT INTO movie_actors (first_names, last_name, movie_title) VALUES (?,?,?)";
      $statement = $db->prepare($insQuery);
      $statement->bind_param("sss", $firstNames, $lastName, $movieTitle);
      $statement->execute();
      
      echo '<div class="messages"><h4>Success: ' . $statement->affected_rows . ' relationship added.</h4>';
      echo $firstNames . ' ' . $lastName . ' in ' . $movieTitle . '</div>';
      
      $statement->close();
   }
}
?>

<h3>Add Actor-Movie Relationship</h3>
<form id="addForm" name="addForm" action="movie_actors.php" method="post" onsubmit="return validate(this);">
   <fieldset>
      <div class="formData">
         <label class="field" for="firstNames">First Name(s):</label>
         <div class="value"><input type="text" size="60" value="<?php if ($havePost && $errors != '') {
                                                                     echo $firstNames;
                                                                  } ?>" name="firstNames" id="firstNames" /></div>

         <label class="field" for="lastName">Last Name:</label>
         <div class="value"><input type="text" size="60" value="<?php if ($havePost && $errors != '') {
                                                                     echo $lastName;
                                                                  } ?>" name="lastName" id="lastName" /></div>

         <label class="field" for="movieTitle">Movie Title:</label>
         <div class="value"><input type="text" size="60" value="<?php if ($havePost && $errors != '') {
                                                                     echo $movieTitle;
                                                                  } ?>" name="movieTitle" id="movieTitle" /></div>

         <input type="submit" value="save" id="save" name="save" />
      </div>
   </fieldset>
</form>

<h3>Actor-Movie Relationships</h3>
<table id="actorMovieTable">
   <?php
   if ($dbOk) {
      $query = 'SELECT * FROM movie_actors ORDER BY last_name, first_names';
      $result = $db->query($query);
      $numRecords = $result->num_rows;

      echo '<tr><th>Actor</th><th>Movie</th><th></th></tr>';
      for ($i = 0; $i < $numRecords; $i++) {
         $record = $result->fetch_assoc();
         if ($i % 2 == 0) {
            echo "\n" . '<tr id="relationship-' . $record['id'] . '"><td>';
         } else {
            echo "\n" . '<tr class="odd" id="relationship-' . $record['id'] . '"><td>';
         }
         echo htmlspecialchars($record['last_name']) . ', ';
         echo htmlspecialchars($record['first_names']);
         echo '</td><td>';
         echo htmlspecialchars($record['movie_title']);
         echo '</td><td>';
         echo '<img src="resources/delete.png" class="deleteRelationship" width="16" height="16" alt="delete relationship"/>';
         echo '</td></tr>';
      }

      $result->free();
      $db->close();
   }
   ?>
</table>

<?php include('includes/foot.inc.php'); ?>