<?php
include_once "CheckLoginBE.php";
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
    <title>Nieuws</title>
</head>
<body>

    

<header>
    <a id="logo" href="beheerhome.php">
      <img id="logo" src="../img\logo-met-text-rechts.svg" width="200px" alt="Logo">
    </a>
</header>

<nav>
    <ul>
        <li><a href="beheerhome.php">Home</a></li>
        <li><a href="partijenbeheer.php">Partijen</a></li>
        <li><a class="active" href="beheernieuws.php">Nieuws</a></li>
        <li><a href="beheerstellingen.php">Stellingen</a></li>
        <form method="post">
            <button type="submit" name="logout">uitloggen</button>
        </form>
    </ul>
</nav>
<?php     
        include_once "../dbhandler.php";
        $dbHandler = new dbHandler();

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $titel = $_POST['titel'];
            $link = $_POST['link'];
            $inhoud = $_POST['inhoud'];
            $partij = $_POST['partij'];
            $datum = $_POST['datum'];

            if ($dbHandler->addNieuws($titel, $link, $inhoud, $partij, $datum)) {
                echo "<p>Nieuwsbericht toegevoegd.</p>";
            } else {
                echo "<p>Toeveogen van nieuwsbericht is niet gelukt</p>";
            }
        }

        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['delete'])) {
            $id = $_GET['delete'];

            if ($dbHandler->deleteNieuws($id)) {
                echo "<p>Nieuwsbericht succesvol verwijderd.</p>";
            } else {
                echo "<p>Er is een fout opgetreden bij het verwijderen van het nieuwsbericht.</p>";
            }
        }
    ?>
<main class="mainclass">
    <h2 class="titeltext">Nieuwtjes over Politieke Partijen</h2>
    <form action="beheernieuws.php" method="post">
        <h3>Nieuw nieuwsbericht toevoegen</h3>
        <label for="titel">Titel:</label>
        <input type="text" id="titel" name="titel" required>    
        <label for="link">Link:</label>
        <input type="url" id="link" name="link" required>   
        <label for="inhoud">Inhoud:</label>
        <textarea id="inhoud" name="inhoud" required></textarea>
        <label for="partij">Partij:</label>
        <input type="text" id="partij" name="partij" required>
        <label for="datum">Datum:</label>
        <input type="date" id="datum" name="datum" required>
        <button type="submit">Toevoegen</button>
    </form>
    <div class="nieuwsContainer">
    <?php
    foreach ($dbHandler->selectNieuws() as $row) {
        echo "<div class='nieuws-item'>";
        echo "<h3>" . ($row["titel"]) . "</h3>";
        echo "<p><strong>Partij:</strong> " . ($row["partij"]) . "</p>";
        echo "<p><strong>Datum:</strong> " . ($row["datum"]) . "</p>";
        echo "<p>" . ($row["inhoud"]) . "</p>";
        echo  "<form method='get' action='beheernieuws.php'>";
        echo  "<input type='hidden' name='delete' value='" . $row["nieuwsid"] . "'>";
        echo "<button type='submit' class='verwijder-button'>Verwijder</button>";
        echo "</form>";
        echo "</div>";
        
    }
    ?>
    </div>
   
</main>
</body>
</html>
