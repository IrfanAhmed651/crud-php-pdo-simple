<?php
// including the database connection file
include_once("config.php");

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['update'])) {
    header('Location: index.php');
    exit;
}

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
$nameInput = filter_input(INPUT_POST, 'name', FILTER_UNSAFE_RAW, FILTER_REQUIRE_SCALAR);
$phoneInput = filter_input(INPUT_POST, 'phone', FILTER_UNSAFE_RAW, FILTER_REQUIRE_SCALAR);
$designationInput = filter_input(INPUT_POST, 'designation', FILTER_UNSAFE_RAW, FILTER_REQUIRE_SCALAR);

$name = is_string($nameInput) ? trim($nameInput) : '';
$phone = is_string($phoneInput) ? trim($phoneInput) : '';
$designation = is_string($designationInput) ? trim($designationInput) : '';

$errors = [];

if (!$id) {
    $errors[] = 'Invalid employee identifier.';
}

if ($name === '') {
    $errors[] = 'Name is required.';
}

if ($phone === '') {
    $errors[] = 'Phone number is required.';
} elseif (!preg_match('/^[0-9+\-\s]{7,20}$/', $phone)) {
    $errors[] = 'Phone number may only contain digits, spaces, plus (+), or hyphen (-) characters and must be between 7 and 20 characters long.';
}

if (mb_strlen($designation) > 120) {
    $errors[] = 'Designation must be 120 characters or fewer.';
}

if (!empty($errors)) {
    echo '<h2>Unable to update employee</h2>';
    echo '<ul>';
    foreach ($errors as $error) {
        echo '<li>' . htmlspecialchars($error, ENT_QUOTES, 'UTF-8') . '</li>';
    }
    echo '</ul>';
    echo '<p><a href="javascript:history.back()">Go back and fix the issues</a></p>';
    exit;
}

$sql = 'UPDATE employees SET name = :name, phone = :phone, designation = :designation WHERE id = :id';
$stmt = $dbConn->prepare($sql);
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':phone', $phone, PDO::PARAM_STR);
$stmt->bindValue(':designation', $designation, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$stmt->execute();

header('Location: index.php');
exit;