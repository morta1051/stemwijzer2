<?php
include_once 'CheckLoginBE.php';
?>
<!DOCTYPE html>
<html lang="nl">
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

    require_once "../dbhandler.php";
    $dbHandler = new dbHandler();
    ?>
    <header>
        <a id="logo" href="beheerhome.php">
          <img id="logo" src="../img/logo-met-text-rechts.svg" width="200px" alt="Logo">
        </a>
    </header>
    <nav>
    <ul>
        <li><a href="beheerhome.php">Home</a></li>
        <li><a class="active" href="partijenbeheer.php">Partijen</a></li>
        <li><a href="beheernieuws.php">Nieuws</a></li>
        <li><a href="beheerstellingen.php">Stellingen</a></li>
        <form method="post">
            <button type="submit" name="logout">uitloggen</button>
        </form>
    </ul>
</nav>
    <?php
        if(isset($_POST["submitAdd"])){
            if (isset($_POST["partijNaam"])) {
                $partijNaam = $_POST["partijNaam"];
                $dbHandler->addPartij($partijNaam);
                header("Location: " . $_SERVER['PHP_SELF']);
                exit;
            }
        } elseif (isset($_POST["submitUpdate"])) {
            if(isset($_POST["partijID"]) && isset($_POST["partijNaam"])){
                $partijID = $_POST["partijID"];
                $partijNaam = $_POST["partijNaam"];
                $dbHandler->updatePartij($partijID, $partijNaam);
                header("Location: " . $_SERVER['PHP_SELF']);
                exit;
            }
        } elseif (isset($_POST["submitDelete"])) {
            if(isset($_POST["partijID"])){
                $partijID = $_POST["partijID"];
                $dbHandler->deletePartij($partijID);
                header("Location: " . $_SERVER['PHP_SELF']);
                exit;
            }
        } elseif (isset($_POST["submitUpdateStandpunt"])) {
            if (isset($_POST["partijID"]) && isset($_POST["stellingID"]) && isset($_POST["standpunt"]) && isset($_POST["argument"])) {
                $partijID = $_POST["partijID"];
                $stellingID = $_POST["stellingID"];
                $standpunt = $_POST["standpunt"];
                $argument = $_POST["argument"];
                $dbHandler->updateStandpunt($stellingID, $partijID, $standpunt, $argument);
                header("Location: " . $_SERVER['PHP_SELF']);
                exit;
            }
        } elseif (isset($_POST["DeleteStandpunt"])) {
            if (isset($_POST["partijID"]) && isset($_POST["stellingID"])) {
                $partijID = $_POST["partijID"];
                $stellingID = $_POST["stellingID"];
                $dbHandler->deleteStandpunt($stellingID, $partijID);
                header("Location: " . $_SERVER['PHP_SELF']);
                exit;
            }
        }
    ?>
</div>

<div id="parrent-functies">
<div class="add-partij-container">
    <h2>partijen toevoegen</h2>
    <form method="POST">
        <input type="text" name="partijNaam" placeholder="Partij naam" required>
        <input type="submit" value="Add" name="submitAdd">
    </form>
</div>
<div class="update-partij-container">
    <h2>partijen updaten</h2>
    <form method="POST">
        <select name="partijID" required>
            <?php
            foreach ($dbHandler->selectPartijen() as $partij) {
                echo "<option value='" . $partij["partijID"] . "'>" . $partij["partijen"] . "</option>";
            }
            ?>
        </select>
        <input type="text" name="partijNaam" placeholder="Nieuwe partij naam" required>
        <input type="submit" value="Update" name="submitUpdate">
    </form>
</div>
<div class="delete-partij-container">
    <h2>partijen verwijderen</h2>
    <form method="POST">
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
<div class="update-standpunt-container">
    <h2>standpunt updaten</h2>
    <form method="POST">
        <select id="updateselect" name="partijID" required>
            <?php foreach ($dbHandler->selectPartijen() as $partij) {
                echo "<option value='" . $partij["partijID"] . "'>" . $partij["partijen"] . "</option>";
            } ?>
        </select>
        <select name="stellingID" required>
            <?php foreach ($dbHandler->selectStellingen() as $stelling) {
                echo "<option value='" . $stelling["stellingID"] . "'>" . $stelling["stellingen"] . "</option>";
            } ?>
        </select>
        <input type="text" name="standpunt" placeholder="Nieuwe Standpunt" required>
        <input type="text" name="argument" placeholder="Argument" required>
        <input type="submit" value="Update" name="submitUpdateStandpunt">
    </form>
</div>
<div class="delete-standpunt-container">
    <h2>standpunt verwijderen</h2>
    <form method="POST">
        <select name="partijID" required>
            <?php foreach ($dbHandler->selectPartijen() as $partij) {
                echo "<option value='" . $partij["partijID"] . "'>" . $partij["partijen"] . "</option>";
            } ?>
        </select>
        <select name="stellingID" required>
            <?php foreach ($dbHandler->selectStellingen() as $stelling) {
                echo "<option value='" . $stelling["stellingID"] . "'>" . $stelling["stellingen"] . "</option>";
            } ?>
        </select>
        <input type="submit" value="Delete" name="DeleteStandpunt">
    </form>
</div>
</div>
<div class="verkiezingen-container">
    <?php
    foreach ($dbHandler->selectPartijen() as $partij) {
        echo "<a href='beheerstandpunt.php?id=" . $partij["partijID"] . "' class='verkiezingen'>"; 
        echo "<p>" . $partij["partijen"] . "</p>";
        echo "</a>";
    }
    ?>
</div>
</body>
</html>
