<form action="PHPExcercise2.php" method="GET" id="timeForm">
  <button onclick="<?php time(); ?>" type="submit" form="timeForm" value="Submit">Submit</button>
</form>

<?php
function time() {
   echo "The time is " . date("h:i:s");
}
?>
<pre>
<?php var_dump($_GET);?>
</pre>