<?php
session_start();
require_once 'dbhandler.php';

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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/style.css">
    <title>beheerder</title>
</head>
<body>

<header>
    <a id="logo" href="beheerindex.php">
      <img id="fortnitelogo" src="img\logo-met-text-rechts.svg" width="200px" alt="Fluitende Fietser Logo">
    </a>
</header>
<nav>
    <ul>
        <li><a class="active" href="beheerlogin.php">Home</a></li>
        <li><a href="partijenbeheer.php">Partijen </a></li>
        <li><a href="beheernieuws.php">Nieuws</a></li>
        <li><a href="beheerstellingen.php">Stellingen</a></li> 
    </ul>
</nav>
<div class="background-image"></div>
<h2>Welcome, <?php echo htmlspecialchars($username); ?>!</h2>

<form method="post">
    <button type="submit" name="logout">uit loggen</button>
</form>

    
</body>
</html>
