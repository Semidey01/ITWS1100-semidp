<?php 
  include('includes/init.inc.php'); // include the DOCTYPE and opening tags
  include('includes/functions.inc.php'); // functions
  error_reporting(E_ALL);
  ini_set('display_errors', '1');
?>
<title>PHP &amp; MySQL - ITWS</title>   

<?php include('includes/head.inc.php'); ?>

<h1>PHP &amp; MySQL</h1>
      
<?php include('includes/menubody.inc.php'); ?>
<?php
  // We'll need a database connection both for retrieving records and for
  // inserting them.  Let's get it up front and use it for both processes
  // to avoid opening the connection twice.  If we make a good connection,
  // we'll change the $dbOk flag.
  $dbOk = false;
  
  /* Create a new database connection object, passing in the host, username,
  password, and database to use. The "@" suppresses errors. */
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
    $query = 'SELECT m.movieid, m.title, m.year, a.actorid, a.first_names, a.last_name, a.dob
              FROM movies m
              JOIN movie_actors ma ON m.movieid = ma.movieid
              JOIN actors a ON ma.actorid = a.actorid
              ORDER BY m.title, a.last_name';
    
    $result = $db->query($query);
    $numRecords = $result->num_rows;

    echo '<tr><th>Title:</th><th>Year:</th><th>Actor First Name:</th><th>Actor Last Name:</th><th>Date of Birth:</th></tr>';

    for ($i = 0; $i < $numRecords; $i++) {
      $record = $result->fetch_assoc();
      $rowClass = $i % 2 == 0 ? '' : 'odd';
      echo "\n<tr class=\"$rowClass\" id=\"movie-{$record['movieid']}\">";
      echo '<td>' . htmlspecialchars($record['title']) . '</td>';
      echo '<td>' . htmlspecialchars($record['year']) . '</td>';
      echo '<td>' . htmlspecialchars($record['first_names']) . '</td>';
      echo '<td>' . htmlspecialchars($record['last_name']) . '</td>';
      echo '<td>' . htmlspecialchars($record['dob']) . '</td>';
      echo '</tr>';
    }

    $result->free();

    // Finally, let's close the database
    $db->close();
  }
?>
</table>
<?php include('includes/foot.inc.php'); 
  // footer info and closing tags
?>