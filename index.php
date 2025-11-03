<?php
//including the database connection file
include_once("config.php");

//fetching data in descending order (lastest entry first)
$result = $dbConn->query("SELECT * FROM employees ORDER BY id DESC");
?>

<html>

<head>
    <title>Home Page</title>
</head>
<link rel="stylesheet" href="app.css" />

<body>
    <a href="add.html">Add New Data</a><br /><br />

    <table class="container" width='80%' border=0>

        <tr bgcolor='#CCCCCC'>
            <td>ID</td>
            <td>Name</td>
            <td>Phone</td>
            <td>Designation</td>
            <td>Update</td>
        </tr>
        <?php
		while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
			echo "<tr>";
			echo "<td>" . $row['id'] . "</td>";
			echo "<td>" . $row['name'] . "</td>";
			echo "<td>" . $row['phone'] . "</td>";
			echo "<td>" . $row['designation'] . "</td>";
			echo "<td><a href=\"edit.php?id=$row[id]\">Edit</a> | <a href=\"delete.php?id=$row[id]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";
		}
		?>
    </table>
</body>

</html>