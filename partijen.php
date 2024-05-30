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
    <title>Partijen</title>
</head>
<body>
    <?php

    include_once "dbhandler.php";
    $dbHandler = new dbHandler();
    ?>
   <header>
    <a id="logo" href="index.php">
      <img id="fortnitelogo" src="img\logo-met-text-rechts.svg" width="200px" alt="Fluitende Fietser Logo">
    </a>
</header>
<nav>
    <ul>
        <li><a  href="index.php">Home</a></li>
        <li><a class="active" href="partijen.php">Partijen</a></li>
        <li><a href="nieuws.php">Nieuws</a></li>
        <li><a href="stellingen.php">Stellingen</a></li>
    </ul>
</nav>

<div class="partijen-container">
    <?php
    foreach ($dbHandler->selectPartijen() as $partij) {
        echo "<div class='partij'>";
        echo "<h2><a href='partij.php?id=" . $partij["partijID"] . "'>" . $partij["partijID"] . "</a></h2>";
        echo "<p>" . $partij["partijen"] . "</p>";
        echo "</div>";
    }
    ?>
</div>
</body>
</html>