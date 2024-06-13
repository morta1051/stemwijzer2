<?php
session_start();
require_once 'dbhandler.php';

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

$username = $_SESSION['username'];
$dbHandler = new dbHandler();

if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/home.css">
    <title>Stemwijzer</title>
</head>
<body>

<header>
    <a id="logo" href="index.php">
      <img id="logo" src="img/logo-met-text-rechts.svg" width="200px" alt="Logo">
    </a>
</header>
<nav>
    <ul>
        
        <li><a class="active" href="index.php">Home</a></li>
        <li><a href="partijen.php">Partijen</a></li>
        <li><a href="nieuws.php">Nieuws</a></li>
        <li><a href="stellingen.php">Stellingen</a></li>
        <form method="post">
        <button type="submit" class="" name="logout">uitloggen</button>
    </form>
    </ul>
    
</nav>


<main class="container">
    <div class="InfoText">
        <p>Welkom <?php echo ($username); ?> bij StemWijzer.nl!</p>
        <p>We zijn hier om jou te begeleiden bij het maken van een beslissing over wie je wilt steunen tijdens verkiezingen.</p>
        <p>StemWijzer.nl is ontwikkeld door een team van mensen die veel kennis hebben van politiek en technologie.</p>
        <p>We hebben een handige website gemaakt die jouw standpunten vergelijkt met die van verschillende politieke partijen.</p>
        <p>Door een aantal vragen te beantwoorden, krijg je inzicht in welke partij het beste aansluit bij jouw denkwijze en waarden.</p>
        <p>Onze missie is om iedereen te ondersteunen bij het maken van een weloverwogen keuze tijdens het stemmen. Of je nu een expert bent in politieke zaken of er minder van af weet, StemWijzer.nl staat voor je klaar.</p>
        <p>We geloven in de kracht van geïnformeerde beslissingen en willen daarom een betrouwbare en toegankelijke bron van informatie zijn voor alle kiezers.</p>
        <p>Neem gerust een kijkje op onze website en ontdek welke partij het beste bij jou past! Bij StemWijzer.nl gaat het erom dat jouw stem gehoord wordt.</p>
    </div>
    <label class="knopText">Wilt u uw stemwijzer maken? druk dan op deze knop!</label>
    <label class="arrow">↓</label>
    <button class="StemwijzerButton" onclick="window.location.href='Stemwijzer.php';">Stemwijzer</button>
</main>
</body>
</html>
