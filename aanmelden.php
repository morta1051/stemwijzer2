
<?php
session_start();
require_once 'dbhandler.php';

if (isset($_SESSION['username'])) {
    header("Location: home.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
    $username = $_POST['registerUsername'];
    $password = $_POST['registerPassword'];

    $dbHandler = new dbHandler();

    if ($dbHandler->registerUser($username, $password)) {
        $_SESSION['username'] = $username;
        header("Location: home.php");
        exit();
    } else {
        echo "Failed to register user.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
    <title>Registration</title>
</head>
<body>  
    <form method='post' action='index.php'> 
        <div class="row">
            <div class="form-group col-md-6">
                <label for="registerUsername">Username</label>
                <input id="registerUsername" class="form-control" name="registerUsername" required/>
            </div>
            <div class="form-group col-md-6">
                <label for="registerPassword">Password</label>
                <input type="password" id="registerPassword" class="form-control" name="registerPassword" required/>
            </div>
            <button type="submit" class="btn btn-primary col-md-2" name='register' value="register" style="margin-top: 20px;">
                <i class="fa fa-user-plus"></i> Register
            </button>
            <p>Already have an account? <a href="index.php">Login</a></p>
        </div>
    </form>
</body>
</html>