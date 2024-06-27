<?php
require 'CheckLoginGB.php';
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
            <button type="submit" class="" name="logout">Uitloggen</button>
        </form>
        </ul>
    </nav>

    <?php
    include_once "../dbhandler.php";
    $dbHandler = new dbHandler();

    if (isset($_GET['id'])) {
        $partyId = $_GET['id'];

        $party = $dbHandler->getPartyById($partyId);

        if ($party) {
            ?>
            <div class="partij-container">

                <div class='partijSelected'>
                    <p><?php echo $party["partijen"]; ?></p>
                </div>

                <h3 class="titleStelling" >Standpunten</h3>
                <h4 class="titleStelling" > 1 is Eens, 0 is Oneens</h4>
                
                <?php
                $stellingen = $dbHandler->getStandpuntenByPartyIdV1($partyId);
                if ($stellingen) {
                    foreach ($stellingen as $stelling) {
                        echo "<div class='stelling'>";
                        // echo "<h1>verkiezing: " . $stelling["naam"] . "</p\h1s>";
                        echo "<h4>" . $stelling["stellingID"] . "</h4>";
                        echo "<p>Stelling: " . $stelling["stellingen"] . "</p>";
                        echo "<div class='standpunt'>";
                        echo "<p>Standpunt: " . $stelling["standpunt"] . "</p>";
                        echo "<h4>Argument: " . $stelling["argument"] . "</p>";
                        echo "</div>";
                        echo "</div>";
                    }
                } else {
                    echo "No standpunten found for this party.";
                }
                ?>
            </div>
            <?php
        } else {
            echo "Party not found.";
        }
    } else {
        echo "No party ID provided.";
    }
    ?>
    </div>

</body>
</html>
