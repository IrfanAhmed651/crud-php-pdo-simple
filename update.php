<?php
// including the database connection file
include_once("config.php");

$id = $_REQUEST['id'];
$name = $_REQUEST['name'];
$phone = $_REQUEST['phone'];
$designation = $_REQUEST['designation'];

// checking empty fields
if (empty($name) || empty($phone)) {

	if (empty($name)) {
		echo "<font color='red'>Name field is empty.</font><br/>";
	}

	if (empty($phone)) {
		echo "<font color='red'>Phone field is empty.</font><br/>";
	}

	// if (empty($email)) {
	// 	echo "<font color='red'>Email field is empty.</font><br/>";
	// }
} else {
	//updating the table
	// $sql = "UPDATE employees (name, phone, designation) VALUES ('$name', '$phone', '$designation')";
    $sql ="UPDATE employees 
    SET name ='$name', phone='$phone', designation ='$designation' 
    WHERE id = '$id' " ;
	$stmt = $dbConn->prepare($sql);

    // execute the query
    $stmt->execute();

	//redirectig to the display page. In our case, it is index.php
	header("Location: index.php");
}