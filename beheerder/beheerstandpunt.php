<?php
include_once "CheckLoginBE.php";
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
        <a id="logo" href="beheerhome.php">
          <img id="logo" src="../img/logo-met-text-rechts.svg" width="200px" alt="Logo">
        </a>
    </header>
    <nav>
        <ul>
            <li><a href="beheerhome.php">Home</a></li>
            <li><a href="partijenbeheer.php">Partijen</a></li>
            <li><a href="beheernieuws.php">Nieuws</a></li>
            <li><a href="beheerstellingen.php">Stellingen</a></li>
            <form method="post">
                <button type="submit" name="logout">uitloggen</button>
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
                
                <?php
                $stellingen = $dbHandler->getStandpuntenByPartyIdV1($partyId);
                if ($stellingen) {
                    foreach ($stellingen as $stelling) {
                        echo "<div class='stelling'>";
                        echo "<h4>" . $stelling["stellingID"] . "</h4>";
                        echo "<p>Stelling: " . $stelling["stellingen"] . "</p>";
                        echo "<div class='standpunt'>";
                        echo "<p>Standpunt: " . $stelling["standpunt"] . "</p>";
                        echo "<h4>Argument: " . $stelling["argument"] . "</p>";
                        echo "</div>";
                        echo "</div>";
                    }
                } else {
                    echo "Geen standpunten gevonden voor deze partij";
                }
                ?>
            </div>
            <?php
        } else {
            echo "Geen partije gevonden";
        }
    } else {
        echo "Geen partij id gevonden";
    }
    ?>
    </div>

</body>
</html>
