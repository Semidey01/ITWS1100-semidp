<?php
session_start();
include('conn.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    
    $stmt = $db->prepare("SELECT * FROM mySiteUsers WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['user_password'])) {
            $_SESSION['username'] = $user['username'];
            $_SESSION['user_role'] = $user['user_role'];
            header("Location: index.php");
            exit();
        }
    }
    
    $_SESSION['login_error'] = "Invalid username or password";
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="../Lab3/css/top.css">
    <link rel="stylesheet" href="resources/login.css">
</head>
<body>
    <?php echo buildMenu(); ?>
    
    <div class="login-form">
        <h2>Login</h2>
        <?php if (isset($_SESSION['login_error'])): ?>
            <div class="error"><?php echo $_SESSION['login_error']; unset($_SESSION['login_error']); ?></div>
        <?php endif; ?>
        <form method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>