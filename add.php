<html>

<head>
    <title>Add Data</title>
</head>

<body>
    <?php
	//including the database connection file
	include_once("config.php");

	$name = $_POST['name'] ?? '';
	// $name = $_REQUEST['name'];
	$phone = $_POST['phone']?? '';
	$designation = $_POST['designation']?? '';

	// checking empty fields
	if (empty($name) || empty($phone)) {

		if (empty($name)) {
			echo "<font color='red'>Name field is empty.</font><br/>";
		}

		if (empty($phone)) {
			echo "<font color='red'>Phone field is empty.</font><br/>";
		}

		// if (empty($designation)) {
		// 	echo "<font color='red'>Designation field is empty.</font><br/>";
		// }

		//link to the previous page
		echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
	} else {
		// if all the fields are filled (not empty) 

		//insert data to database		
		$sql = "INSERT INTO employees (name, phone, designation) VALUES ('$name', '$phone', '$designation')";

		$stmt = $dbConn->prepare($sql);

  		// execute the query
  		$stmt->execute();

		//display success message
		echo "<font color='green'>Data added successfully.";
		echo "<br/><a href='index.php'>View Result</a>";
	}
	?>
</body>

</html>