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
    <link rel="stylesheet" href="../css/beheerhome.css">
    <title>beheerder</title>
</head>
<body>

<header>
    <a id="logo" href="beheerhome.php">
      <img id="logo" src="../img\logo-met-text-rechts.svg" width="200px" alt=" Logo">
    </a>
</header>
<nav>
    <ul>
        <li><a class="active" href="beheerhome.php">Home</a></li>
        <li><a href="partijenbeheer.php">Partijen </a></li>
        <li><a href="beheernieuws.php">Nieuws</a></li>
        <li><a href="beheerstellingen.php">Stellingen</a></li> 
        <form method="post">
            <button type="submit" name="logout">uitloggen</button>
        </form>
    </ul>
    

</nav>
<div class="BeheerContainer">
<h2 id="WelcomeBeheer" >Welcome, <?php echo ($username); ?>!</h2>
<img src >
</div>


</body>
</html>
