<?php
session_start();
require_once 'dbHandler.php';


if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

$username = $_SESSION['username'];
$dbHandler = new dbHandler();



if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>beheerder</title>
</head>
<body>

<form method="post">
        <button type="submit" name="logout">Logout</button>
</form>
    
</body>
</html>