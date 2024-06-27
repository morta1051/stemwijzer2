    <?php
    session_start();
    require '../dbhandler.php';

    if (isset($_SESSION['username'])) {
        header("Location: beheerhome.php");
        exit();
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
        $username = $_POST['loginUsername'];
        $password = $_POST['loginPassword'];

        $dbHandler = new dbHandler();

        if ($dbHandler->validatebeheer($username, $password)) {
            $_SESSION['username'] = $username;
            header("Location: beheerhome.php");
            exit();
        } else {
            echo "Invalid username or password.";
        }
    }
    ?>

    <!DOCTYPE html>
    <html lang="nl">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="../css/beheerlogin.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"/>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
        <link rel="icon" type="image/x-icon" href="../img/logo-neutraal-kieslab-lichtblauw.svg">
        <title>Login</title>
    </head>
    <body class="bclg">
    <body class="bclg">
        
    <form method='post' action='beheerindex.php'> 
        <div class="row">
        <h1>Beheer login</h1>
            <div class="form-group col-md-6">
                <label for="loginUsername">Gebruikersnaam</label>
                <input id="loginUsername" class="form-control" name="loginUsername" required/>
            </div>
            <div class="form-group col-md-6">
                <label for="loginPassword">Wachtwoord</label>
                <input type="password" id="loginPassword" class="form-control" name="loginPassword" required/>
            </div>
            <button type="submit" class="btnLogin" name='login' value="login" style="margin-top: 20px;">
                <i></i> Inloggen
            </button>
            <p>Heb je nog geen account? <a href="../gebruiker/aanmelden.php">Aanmelden</a></p>

           
        </div>
    </form>
</body>
    </html>
