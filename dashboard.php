<?php
session_start();
if (!isset($_SESSION['token'])) {
    header('Location: login.php');
    exit();
}
if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header('Location: login.php'); 
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    <h2>Welcome to Dashboard</h2>
    <h2>644259030</h2>
    <h2></h2>
    <form method="post">
        <input type="submit" name="logout" value="Logout">
    </form>
</body>
</html>