<?php
include 'connection.inc';

$query = "SELECT name FROM subjects WHERE id = 1";
$result = $con->query($query) or die('Invalid query: ' . mysql_error());
$result = mysqli_fetch_assoc($result);

echo $result['name'];