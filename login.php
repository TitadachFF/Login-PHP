<?php
session_start();
require_once "db_config.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = ? AND password = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array($username, $password)); // Use array() constructor

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $token = bin2hex(random_bytes(32));
        $_SESSION['token'] = $token;
        $_SESSION['user_id'] = $user['id'];

        $updateTokenSQL = "UPDATE users SET token = ? WHERE id = ?";
        $stmt = $pdo->prepare($updateTokenSQL);
        $stmt->execute(array($token, $user['id'])); // Use array() constructor

        header('Location: dashboard.php');
        exit();
    } else {
        echo "Invalid credentials";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form method="post" action="login.php">
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <input type="submit" value="Login">
    </form>
</body>
</html>
