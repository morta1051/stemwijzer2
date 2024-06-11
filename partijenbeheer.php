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
    ?>
    <header>
        <a id="logo" href="beheerindex.php">
        <a id="logo" href="beheerindex.php">
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
    <?php
    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["partijNaam"])) {
            $partijNaam = $_POST["partijNaam"];

            // Add the party to the database
            $dbHandler->addPartij($partijNaam);

                $_POST["submitAdd"] = false;
            }
        } elseif (isset($_POST["submitUpdate"])) {
            if(isset($_POST["partijID"]) && isset($_POST["partijNaam"])){
                $partijID = $_POST["partijID"];
                $partijNaam = $_POST["partijNaam"];
    
                // Update the party in the database
                $_POST["submitUpdate"] = false;
                $dbHandler->updatePartij($partijID, $partijNaam);
            }
        } elseif (isset($_POST["submitDelete"])) {
            if(isset($_POST["partijID"])){
                $partijID = $_POST["partijID"];

                // Delete the party from the database
                $_POST["submitDelete"] = false;
                $dbHandler->deletePartij($partijID);
            }
        }
    
    
    ?>

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
        <form method="POST">
            <input type="text" name="partijNaam" placeholder="Party Name" required>
            <input type="submit" value="Add" name="submitAdd">
            <input type="submit" value="Add" name="submitAdd">
        </form>
    </div>
    <div class="update-partij-container">
        <h2>Update partij</h2>
        <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <select name="partijID" required>
                <?php
                foreach ($dbHandler->selectPartijen() as $partij) {
                    echo "<option value='" . $partij["partijID"] . "'>" . $partij["partijen"] . "</option>";
                }
                ?>
            </select>
            <input type="text" name="partijNaam" placeholder="New Party Name" required>
            <input type="submit" value="Update" name="submitUpdate">
        </form>
    </div>
    <div class="delete-partij-container">
        <h2>Delete partij</h2>
        <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <select name="partijID" required>
                <?php
                foreach ($dbHandler->selectPartijen() as $partij) {
                    echo "<option value='" . $partij["partijID"] . "'>" . $partij["partijen"] . "</option>";
                }
                ?>
            </select>
            <input type="submit" value="Delete" name="submitDelete">
        </form>
    </div>
   

    <footer>
        <p>&copy; 2021 -    Partijen</p>
    </footer>
</body>
</html>