<?php
require 'CheckLoginGB.php';
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
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/nieuws.css">
    <link rel="stylesheet" href="../css/resultaat.css">
    <title>Nieuws</title>
</head>
<body>
<header>
    <a id="logo" href="home.php">
      <img id="fortnitelogo" src="../img/logo-met-text-rechts.svg" width="200px" alt="Fluitende Fietser Logo">
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
    $resultaten =[];
    foreach ($dbHandler->stemwijzerResultaat() as $partijstandpunt) {
        $partijID = $partijstandpunt["partijID"];
        $stellingID = $partijstandpunt["stellingID"];
        $standpunt = $partijstandpunt["standpunt"];

        $found = false;

        foreach ($resultaten as $resultaat) {
            if ($resultaat->partijId == $partijID) {
                $found = true;
                break;
            }
        }
    
        if (!$found) {
            $resultaten[] = (object) ['partijId' => $partijID, "aantalEens" => 0];
        }
        
        $gebruikerEens = FALSE;

        if (isset($_POST[$stellingID]) && $_POST[$stellingID] == 'eens') {
            $gebruikerEens = TRUE;
        }

        if ($standpunt == $gebruikerEens) {
            foreach ($resultaten as $resultaat) {
                if ($resultaat->partijId == $partijID) {
                    $resultaat->aantalEens++;
                }
            }
        }
    }

    usort($resultaten, function($a, $b) {
        return $b->aantalEens - $a->aantalEens;
    });

    $topResultaten = array_slice($resultaten, 0, 3);
?>
<main>
<h2 class="ResultaatText">Hier zijn de resultaten van de stemwijzer</h2>
<?php
foreach ($resultaten as $resultaat) {
   $partij = $dbHandler->getPartyById($resultaat->partijId);
    echo "<p class='ResultaatText'>Partij " . $partij['partijen'] . " is het eens met " . $resultaat->aantalEens . " standpunten</p>";
}
?>
</main>
</body>
</html>
