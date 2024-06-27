<?php
session_start();
require_once '../dbhandler.php';

if (!isset($_SESSION['username'])) {
    header("Location: index.php"); 
    exit();
}

$username = $_SESSION['username'];
$dbHandler = new dbHandler();

if (isset($_POST['uitloggen'])) {
    session_unset();
    session_destroy();
    header("Location: index.php"); 
    exit();
}
?>
