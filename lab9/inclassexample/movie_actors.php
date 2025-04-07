<?php 
  include('includes/init.inc.php');
  include('includes/functions.inc.php');
  error_reporting(E_ALL);
  ini_set('display_errors', '1');
?>
<title>PHP &amp; MySQL - ITWS</title>   
<?php include('includes/head.inc.php'); ?>

<h1>PHP &amp; MySQL</h1>
<?php include('includes/menubody.inc.php'); ?>

<?php
  $dbOk = false;
  @ $db = new mysqli('localhost', 'phpmyadmin', 'Antonio00!1074', 'iit');
  
  if ($db->connect_error) {
    echo '<div class="messages">Could not connect to the database. Error: ';
    echo $db->connect_errno . ' - ' . $db->connect_error . '</div>';
  } else {
    $dbOk = true;
  }
?>

<h3>Movies &amp; Actors</h3>
<table id="movieTable">
<?php
  if ($dbOk) {
    // Check if movie_actors table exists
    $tableCheck = $db->query("SHOW TABLES LIKE 'movie_actors'");
    
    if ($tableCheck->num_rows > 0) {
      $query = 'SELECT first_names, last_name, movie_title, year 
                FROM movie_actors 
                ORDER BY movie_title, last_name, first_names';
      
      $result = $db->query($query);
      
      if ($result && $result->num_rows > 0) {
        echo '<tr><th>Actor First Name</th><th>Actor Last Name</th><th>Movie Title</th><th>Year</th></tr>';
        
        while ($record = $result->fetch_assoc()) {
          echo '<tr>';
          echo '<td>' . htmlspecialchars($record['first_names']) . '</td>';
          echo '<td>' . htmlspecialchars($record['last_name']) . '</td>';
          echo '<td>' . htmlspecialchars($record['movie_title']) . '</td>';
          echo '<td>' . htmlspecialchars($record['year']) . '</td>';
          echo '</tr>';
        }
      } else {
        echo '<tr><td colspan="4">No actor-movie relationships found.</td></tr>';
      }
    } else {
      echo '<tr><td colspan="4">The movie_actors table does not exist. Please create it first.</td></tr>';
    }
    
    if (isset($result)) $result->free();
    $db->close();
  }
?>
</table>

<h3>Add Movie-Actor Relationship</h3>
<form id="addRelationshipForm" action="movie_actors.php" method="post">
  <fieldset>
    <div class="formData">
      <label class="field" for="first_names">Actor First Name:</label>
      <input type="text" name="first_names" id="first_names" required>
      
      <label class="field" for="last_name">Actor Last Name:</label>
      <input type="text" name="last_name" id="last_name" required>
      
      <label class="field" for="movie_title">Movie Title:</label>
      <input type="text" name="movie_title" id="movie_title" required>
      
      <label class="field" for="year">Year:</label>
      <input type="number" name="year" id="year">
      
      <input type="submit" value="Add Relationship" name="add_relationship">
    </div>
  </fieldset>
</form>

<?php include('includes/foot.inc.php'); ?>