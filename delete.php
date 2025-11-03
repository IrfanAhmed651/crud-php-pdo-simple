<?php
//including the database connection file
include("config.php");

//getting id of the data from url
$id = $_GET['id'];

//deleting the row from table
$sql = "DELETE FROM employees WHERE id = $id";
$stmt = $dbConn->prepare($sql);

// execute the query
$stmt->execute();

//redirecting to the display page (index.php in our case)
header("Location:index.php");
?>