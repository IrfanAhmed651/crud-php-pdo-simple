<?php
// including the database connection file
include_once("config.php");
//getting id from url
$id = $_GET['id'];

//selecting data associated with this particular id
$sql = "SELECT * FROM employees WHERE id=:id";
$query = $dbConn->prepare($sql);
$query->execute(array(':id' => $id));

while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
	$name = $row['name'];
	$phone = $row['phone'];
	$designation = $row['designation']??'';
}
?>
<html>

<head>
    <title>Edit Data</title>
</head>

<body>
    <a href="index.php">Home</a>
    <br /><br />

    <form name="form1" method="post" action="update.php">
        <table border="0">
            <tr>
                <td>Name</td>
                <td><input type="text" name="name" value="<?php echo $name; ?>"></td>
            </tr>
            <tr>
                <td>Phone</td>
                <td><input type="text" name="phone" value="<?php echo $phone; ?>"></td>
            </tr>
            <tr>
                <td>Designation</td>
                <td><input type="text" name="designation" value="<?php echo $designation; ?>"></td>
            </tr>
            <tr>
                <td><input type="hidden" name="id" value=<?php echo $_GET['id']; ?>></td>
                <td><input type="submit" name="update" value="Update"></td>
            </tr>
        </table>
    </form>
</body>

</html>