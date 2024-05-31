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
    <header>
        <a id="logo" href="index.php">
          <img id="logo" src="img/logo-met-text-rechts.svg" width="200px" alt="Logo">
        </a>
    </header>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="partijen.php">Partijen</a></li>
            <li><a href="nieuws.php">Nieuws</a></li>
            <li><a href="stellingen.php">Stellingen</a></li>
        </ul>
    </nav>

    <?php
    include_once "dbhandler.php";
    $dbHandler = new dbHandler();

    if (isset($_GET['id'])) {
        $partyId = $_GET['id'];

        $party = $dbHandler->getPartyById($partyId);
        $partijID = $dbHandler->standpuntenpartijen($partyId);

        if ($party) {
            ?>
            <div class="partij-container">

                <div class='partijSelected'>
                    <h2><?php echo $party["partijID"]; ?></h2>
                    <p><?php echo $party["partijen"]; ?></p>
                </div>

                <h3 class="titleStelling" >Standpunten</h3>
                
                <?php
                $stellingen = $dbHandler->selectStellingen($partyId);
                if ($stellingen) {
                    foreach ($stellingen as $stelling) {
                        echo "<div class='stelling'>";
                        echo "<h4>" . $stelling["stellingID"] . "</h4>";
                        echo "<p>" . $stelling["stellingen"] . "</p>";
                        echo "<div class='stemmen'>";
                        // echo "<button class='eens'>Eens</button>";
                        echo "<button class='oneens'>Oneens</button>";
                        echo "</div>";
                        echo "</div>";
                    }
                } else {
                    echo "No stellingen found for this party.";
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