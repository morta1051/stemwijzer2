<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/partij.css">
    <link rel="stylesheet" href="css/style.css">
    <title>partij</title>
</head>
<body>
    <?php

    include_once "dbhandler.php";
    $dbHandler = new dbHandler();

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $partijNaam = $_POST["partijNaam"];

        // Add the party to the database
        $dbHandler->addPartij($partijNaam);
    }
    ?>
    <header>
        <a id="logo" href="index.php">
          <img id="logo" src="img/logo-met-text-rechts.svg" width="200px" alt="Logo">
        </a>
    </header>
    <nav>
        <ul>
            <li><a href="beheerlogin.php">Home</a></li>
            <li><a href="partijenbeheer.php">Partijen</a></li>
            <li><a href="beheernieuws.php">Nieuws</a></li>
            <li><a href="stellingen.php">Stellingen</a></li>
        </ul>
    </nav>

    <div class="verkiezingen-container">
    <?php

    foreach ($dbHandler->selectPartijen() as $partij) {
        echo "<a href='beheerstandpunt.php?id=" . $partij["partijID"] . "' class='verkiezingen'>"; 
        echo "<p>" . $partij["partijen"] . "</p>";
        echo "</a>";
    }   

    ?>
    </div>

    <div class="add-partij-container">
        <h2>Add Party</h2>
        <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <input type="text" name="partijNaam" placeholder="Party Name" required>
            <button type="submit">Add</button>
        </form>
    </div>
    <div class="update-partij-container">
        <h2>Update Party</h2>
        <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <select name="partijID" required>
                <?php
                foreach ($dbHandler->selectPartijen() as $partij) {
                    echo "<option value='" . $partij["partijID"] . "'>" . $partij["partijen"] . "</option>";
                }
                ?>
            </select>
            <input type="text" name="partijNaam" placeholder="New Party Name" required>
            <button type="submit">Update</button>
        </form>
    </div>
    <div class="delete-partij-container">
        <h2>Delete Party</h2>
        <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <select name="partijID" required>
                <?php
                foreach ($dbHandler->selectPartijen() as $partij) {
                    echo "<option value='" . $partij["partijID"] . "'>" . $partij["partijen"] . "</option>";
                }
                ?>
            </select>
            <button type="submit">Delete</button>
        </form>
    </div>
    <?php
    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["partijNaam"])) {
            $partijNaam = $_POST["partijNaam"];

            // Add the party to the database
            $dbHandler->addPartij($partijNaam);
        } elseif (isset($_POST["partijID"]) && isset($_POST["partijNaam"])) {
            $partijID = $_POST["partijID"];
            $partijNaam = $_POST["partijNaam"];

            // Update the party in the database
            $dbHandler->updatePartij($partijID, $partijNaam);
        } elseif (isset($_POST["partijID"])) {
            $partijID = $_POST["partijID"];

            // Delete the party from the database
            $dbHandler->deletePartij($partijID);
        }
    }
    
    ?>

    <footer>
        <p>&copy; 2021 - Project Webdevelopment - Partijen</p>
    </footer>
</body>
</html>
