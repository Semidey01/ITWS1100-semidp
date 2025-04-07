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
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['lastName']) && isset($_POST['movieTitle'])) {
   $lastName = $db->real_escape_string(trim($_POST['lastName']));
   $movieTitle = $db->real_escape_string(trim($_POST['movieTitle']));
   
   if (!empty($lastName) && !empty($movieTitle)) {
      $insQuery = "INSERT INTO movie_actors (last_name, title) VALUES (?,?)";
      $statement = $db->prepare($insQuery);
      $statement->bind_param("ss", $lastName, $movieTitle);
      
      if ($statement->execute()) {
         echo '<div class="messages"><h4>Success: Relationship added.</h4></div>';
      } else {
         echo '<div class="messages"><h4>Error: '.$db->error.'</h4></div>';
      }
      $statement->close();
   }
}
?>

<h3>Add Actor-Movie Relationship</h3>
<form id="relationshipForm">
   <fieldset>
      <div class="formData">
         <label class="field" for="actorSelect">Last Name:</label>
         <div class="value">
            <select id="actorSelect" name="lastName" required>
               <option value="">Select an actor</option>
               <?php
               if ($dbOk) {
                  $actorQuery = "SELECT DISTINCT last_name FROM actors ORDER BY last_name";
                  $actorResult = $db->query($actorQuery);
                  while ($actor = $actorResult->fetch_assoc()) {
                     echo '<option value="'.htmlspecialchars($actor['last_name']).'">'
                         .htmlspecialchars($actor['last_name']).'</option>';
                  }
                  $actorResult->free();
               }
               ?>
            </select>
         </div>

         <label class="field" for="movieSelect">Movie Title:</label>
         <div class="value">
            <select id="movieSelect" name="movieTitle" required>
               <option value="">Select a movie</option>
               <?php
               if ($dbOk) {
                  $movieQuery = "SELECT DISTINCT title FROM movies ORDER BY title";
                  $movieResult = $db->query($movieQuery);
                  while ($movie = $movieResult->fetch_assoc()) {
                     echo '<option value="'.htmlspecialchars($movie['title']).'">'
                         .htmlspecialchars($movie['title']).'</option>';
                  }
                  $movieResult->free();
               }
               ?>
            </select>
         </div>

         <button type="submit" id="saveBtn">Save Relationship</button>
      </div>
   </fieldset>
</form>

<h3>Actor-Movie Relationships</h3>
<table id="relationshipTable">
   <thead>
      <tr>
         <th>Actor Last Name</th>
         <th>Movie Title</th>
         <th>Actions</th>
      </tr>
   </thead>
   <tbody>
      <?php
      if ($dbOk) {
         $query = 'SELECT * FROM movie_actors ORDER BY last_name, title';
         $result = $db->query($query);
         
         while ($record = $result->fetch_assoc()) {
            echo '<tr id="row-'.$record['id'].'">';
            echo '<td>'.htmlspecialchars($record['last_name']).'</td>';
            echo '<td>'.htmlspecialchars($record['title']).'</td>';
            echo '<td><button class="deleteBtn" data-id="'.$record['id'].'">Delete</button></td>';
            echo '</tr>';
         }
         $result->free();
      }
      ?>
   </tbody>
</table>

<script>
$(document).ready(function() {
   // Handle form submission with AJAX
   $('#relationshipForm').submit(function(e) {
      e.preventDefault();
      
      $.ajax({
         type: 'POST',
         url: 'movie_actors.php',
         data: $(this).serialize(),
         success: function(response) {
            // Reload the relationships table
            $('#relationshipTable tbody').load('movie_actors.php #relationshipTable tbody > *');
            // Clear the form
            $('#relationshipForm')[0].reset();
         },
         error: function() {
            alert('Error saving relationship');
         }
      });
   });

   // Handle delete actions
   $(document).on('click', '.deleteBtn', function() {
      if (confirm('Are you sure you want to delete this relationship?')) {
         var id = $(this).data('id');
         
         $.ajax({
            type: 'POST',
            url: 'delete_relationship.php',
            data: { id: id },
            success: function() {
               $('#row-'+id).remove();
            },
            error: function() {
               alert('Error deleting relationship');
            }
         });
      }
   });
});
</script>

<?php 
if ($dbOk) $db->close();
include('includes/foot.inc.php'); 
?>