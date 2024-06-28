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
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/stellingen.css">
    <title>Stellingen</title>
</head>
<body>
    <?php
    include_once "../dbhandler.php";
    $dbHandler = new dbHandler();
    ?>
   <header>
    <a id="logo" href="home.php">
      <img id="fortnitelogo" src="../img\logo-met-text-rechts.svg" width="200px" alt="Fluitende Fietser Logo">
    </a>
</header>
<nav>
    <ul>
        <li><a  href="home.php">Home</a></li>
        <li><a href="partijen.php">Partijen</a></li>
        <li><a  href="nieuws.php">Nieuws</a></li>
        <li><a class="active" href="stellingen.php">Stellingen</a></li>
        <form method="post">
            <button type="submit" class="" name="uitloggen">Uitloggen</button>
        </form>
    </ul>
</nav>
<p class='stelling-container'>Stellingen</p>
<?php
    foreach ($dbHandler->selectStellingen() as $partij ) {   
      
       echo "<p class='stelling-item '>".$partij["stellingen"]. "</p>";
    }
    ?>
</body>
</html>