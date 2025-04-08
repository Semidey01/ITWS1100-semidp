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
   $lastName = trim($_POST['lastName']);
   $movieTitle = trim($_POST['movieTitle']);
   
   if (!empty($lastName) && !empty($movieTitle)) {
      $insQuery = "INSERT INTO movie_actors (last_name, movie_title) VALUES (?,?)";
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
<form id="relationshipForm" method="post">
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

         <input type="submit" name="save" value="Save Relationship" />
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
         $query = 'SELECT * FROM movie_actors ORDER BY last_name, movie_title';
         $result = $db->query($query);
         $i = 0;
         
         while ($record = $result->fetch_assoc()) {
            $rowClass = ($i++ % 2 == 0) ? '' : 'odd';
            echo '<tr class="'.$rowClass.'" id="row-'.$record['id'].'">';
            echo '<td>'.htmlspecialchars($record['last_name']).'</td>';
            echo '<td>'.htmlspecialchars($record['movie_title']).'</td>';
            echo '<td><img src="resources/delete.png" class="deleteRelationship" width="16" height="16" alt="delete relationship" data-id="'.$record['id'].'"></td>';
            echo '</tr>';
         }
         $result->free();
      }
      ?>
   </tbody>
</table>

<script>
$(document).ready(function() {
   // Handle delete actions
   $(document).on('click', '.deleteRelationship', function() {
      if (confirm('Are you sure you want to delete this relationship?')) {
         var id = $(this).data('id');
         var row = $(this).closest('tr');
         
         $.ajax({
            type: 'POST',
            url: 'relationship-delete.php',
            data: { id: id },
            dataType: 'json',
            success: function(response) {
               if (!response.errors) {
                  row.fadeOut(300, function() {
                     $(this).remove();
                     // Reapply odd/even styling after deletion
                     $('#relationshipTable tbody tr').removeClass('odd');
                     $('#relationshipTable tbody tr:odd').addClass('odd');
                  });
               } else {
                  alert('Error deleting relationship: ' + response.error);
               }
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