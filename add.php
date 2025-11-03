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
        $phone = $_POST['phone'] ?? '';
        $designation = $_POST['designation'] ?? '';

        // checking empty fields
        if (empty($name) || empty($phone)) {

                if (empty($name)) {
                        echo "<font color='red'>Name field is empty.</font><br/>";
                }

                if (empty($phone)) {
                        echo "<font color='red'>Phone field is empty.</font><br/>";
                }

                // if (empty($designation)) {
                //      echo "<font color='red'>Designation field is empty.</font><br/>";
                // }

                //link to the previous page
                echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
        } else {
                // if all the fields are filled (not empty)

                // ensure phone number is unique to avoid PDO exceptions on insert
                $checkSql = "SELECT COUNT(*) FROM employees WHERE phone = :phone";
                $checkStmt = $dbConn->prepare($checkSql);
                $checkStmt->bindValue(':phone', $phone, PDO::PARAM_STR);
                $checkStmt->execute();

                if ($checkStmt->fetchColumn() > 0) {
                        echo "<font color='red'>Phone number already exists. Please use a different phone number.</font><br/>";
                        echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
                } else {
                        //insert data to database using prepared statement with placeholders
                        $sql = "INSERT INTO employees (name, phone, designation) VALUES (:name, :phone, :designation)";

                        $stmt = $dbConn->prepare($sql);
                        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
                        $stmt->bindValue(':phone', $phone, PDO::PARAM_STR);
                        $stmt->bindValue(':designation', $designation, PDO::PARAM_STR);

                        // execute the query
                        $stmt->execute();

                        //display success message
                        echo "<font color='green'>Data added successfully.";
                        echo "<br/><a href='index.php'>View Result</a>";
                }
        }
        ?>
</body>

</html>

