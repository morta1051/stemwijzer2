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
    <link rel="stylesheet" href="css/nieuws.css">
    <title>Nieuws</title>
</head>
<body>
<?php

include_once "dbhandler.php";
$dbHandler = new dbHandler();
?>
<header>
    <a id="logo" href="home.php">
      <img id="fortnitelogo" src="img\logo-met-text-rechts.svg" width="200px" alt="Fluitende Fietser Logo">
    </a>
</header>
<nav>
    <ul>
        <li><a href="home.php">Home</a></li>
        <li><a href="partijen.php">Partijen</a></li>
        <li><a class="active" href="nieuws.php">Nieuws</a></li>
        <li><a href="stellingen.php">Stellingen</a></li>
    </ul>
</nav>
<main class="mainclass">
<div class="nieuwsContainer">
    <?php
    foreach ($dbHandler->selectNieuws() as $row) {
            echo "<a href='" . ($row['link']) . "' class='Linktext'>";
            echo "<div class='nieuws-item'>";
            echo "<h3>" . ($row["titel"]) . "</h3>";
            echo "<p><strong>Partij:</strong> " . ($row["partij"]) . "</p>";
            echo "<p><strong>Datum:</strong> " . ($row["datum"]) . "</p>";
            echo "<p>" . ($row["inhoud"]) . "</p>";
            echo "</div>";
            echo "</a>";
        }
    ?>
    </div>
    </main>
</body>
</html>
