<?php
// including the database connection file
include_once 'config.php';
//getting id from url
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
if ($id <= 0) {
    header('Location: index.php');
    exit;
}
//selecting data associated with this particular id
$sql = 'SELECT * FROM employees WHERE id = :id LIMIT 1';
$query = $dbConn->prepare($sql);
$query->execute([':id' => $id]);
$employee = $query->fetch(PDO::FETCH_ASSOC);
if (!$employee) {
    header('Location: index.php');
    exit;
}
$name = $employee['name'];
$phone = $employee['phone'];
$designation = $employee['designation'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Employee</title>
    <link rel="stylesheet" href="app.css">
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('editForm');
        const errorsContainer = document.getElementById('form-errors');
        form.addEventListener('submit', function(event) {
            const nameInput = form.elements['name'];
            const phoneInput = form.elements['phone'];
            const designationInput = form.elements['designation'];
            const errors = [];
            const name = nameInput.value.trim();
            const phone = phoneInput.value.trim();
            const designation = designationInput.value.trim();
            const phonePattern = /^[0-9+\-\s]{7,20}$/;
            if (!name) {
                errors.push('Name is required.');
            }
            if (!phone) {
                errors.push('Phone number is required.');
            } else if (!phonePattern.test(phone)) {
                errors.push(
                    'Phone number may only contain digits, spaces, plus (+), or hyphen (-) characters and must be between 7 and 20 characters long.'
                );
            }
            if (designation.length > 120) {
                errors.push('Designation must be 120 characters or fewer.');
            }
            if (errors.length > 0) {
                event.preventDefault();
                errorsContainer.innerHTML = '<ul>' + errors.map(function(error) {
                    return '<li>' + error + '</li>';
                }).join('') + '</ul>';
                errorsContainer.hidden = false;
                errorsContainer.focus();
            } else {
                errorsContainer.hidden = true;
                errorsContainer.innerHTML = '';
            }
        });
    });
    </script>
</head>

<body>
    <a href="index.php">Home</a>
    <br /><br />
    <div id="form-errors" class="error" role="alert" hidden tabindex="-1"></div>
    <form id="editForm" name="form1" method="post" action="update.php" novalidate>
        <table border="0">
            <tr>
                <td><label for="name">Name</label></td>
                <td><input type="text" id="name" name="name"
                        value="<?php echo htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?>" required maxlength="120">
                </td>
            </tr>
            <tr>
                <td><label for="phone">Phone</label></td>
                <td><input type="text" id="phone" name="phone"
                        value="<?php echo htmlspecialchars($phone, ENT_QUOTES, 'UTF-8'); ?>" required maxlength="20">
                </td>
            </tr>
            <tr>
                <td><label for="designation">Designation</label></td>
                <td><input type="text" id="designation" name="designation"
                        value="<?php echo htmlspecialchars($designation, ENT_QUOTES, 'UTF-8'); ?>" maxlength="120"></td>
            </tr>
            <tr>
                <td><input type="hidden" name="id" value="<?php echo (int) $employee['id']; ?>"></td>
                <td><input type="submit" name="update" value="Update"></td>
            </tr>
        </table>
    </form>
</body>

</html>