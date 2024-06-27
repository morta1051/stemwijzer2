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
   <link rel="stylesheet" href="../css/Stemwijzer.css">
   <title>Stemwijzer</title>
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
<div class="Welkomtext">Welkom op de stemwijzer!</div>
<form action="resultaat.php" method="post">
<div class="center-container">
<div class="Stemwijzer">
<?php
foreach ($dbHandler->selectStellingen() as $partij) {
   echo "<p class='StellingenStemwijzer'>" . $partij["stellingen"] . "</p>
   <div class='radiobt'>
      <label><input type='radio' required name='". $partij["stellingID"]."' value='eens'/> eens </label>
      <label><input type='radio' required name='". $partij["stellingID"]."' value='oneens'/> oneens</label>
   </div>";
}
?>
</div>
<button id="ResultaatKnop" class="button1" type="submit">Krijg uw resultaat</button>
</div>
</form>
</body>
</html>