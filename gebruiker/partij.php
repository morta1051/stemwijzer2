<?php
include 'ChackLogin.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="../img/logo-neutraal-kieslab-lichtblauw.svg">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/partij.css">
    <link rel="stylesheet" href="../css/style.css">
    <title>partij</title>
</head>
<body>
    <?php

    include_once "../dbhandler.php";
    $dbHandler = new dbHandler();
    ?>
    <header>
        <a id="logo" href="index.php">
          <img id="logo" src="../img/logo-met-text-rechts.svg" width="200px" alt="Logo">
        </a>
    </header>
    <nav>
        <ul>
            <li><a href="home.php">Home</a></li>
            <li><a href="partijen.php">Partijen</a></li>
            <li><a href="nieuws.php">Nieuws</a></li>
            <li><a href="stellingen.php">Stellingen</a></li>
            <form method="post">
                <button type="submit" class="" name="logout">uitloggen</button>
            </form>
          
        </ul>
    </nav>

    <div class="verkiezingen-container">
    <?php

    foreach ($dbHandler->selectPartijen() as $partij) {
        echo "<a href='standpunt.php?id=" . $partij["partijID"] . "' class='verkiezingen'>"; 
        echo "<p>" . $partij["partijen"] . "</p>";
        echo "</a>";
    }   

    ?>
    </div>

</body>
</html>
