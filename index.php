<?php
session_start();
include('conn.php');
include('quiz3/menu.php');

// Handle login form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    try {
        $stmt = $db->prepare("SELECT * FROM mySiteUsers WHERE username = ?");
        if (!$stmt) {
            throw new Exception("Database error: " . $db->error);
        }
        
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();
            
            // Plain text comparison (INSECURE)
            if ($user['user_password'] === $password) {
                $_SESSION['username'] = $user['username'];
                $_SESSION['user_role'] = $user['user_role'];
                header("Location: index.php");
                exit();
            } else {
                $login_error = "Invalid password";
            }
        }
}

// Handle logout
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="Lab3/css/top.css">
        <link rel="stylesheet" href="Lab3/css/homepage.css">
        <link rel="stylesheet" href="quiz3/resources/footer.css">
        <link rel="stylesheet" href="quiz3/resources/login.css">
        <script src="quiz3/login.js"></script>
        <title>Pablo Semidey Website</title>
    </head>
    <body>
        <?php echo buildMenu(); ?>

        <div class="content">
            <?php if (isset($_SESSION['username'])): ?>
                <h2 class="welcome-message">Welcome <?php echo htmlspecialchars($_SESSION['username']); ?>! 
                    <a href="index.php?logout=1" class="logout-link">(Logout)</a>
                </h2>
            <?php endif; ?>

            <!-- name and background image-->
            <section class="heading">
                <div class="name">
                    <h1>Pablo Semidey</h1>
                </div>
            </section>

            <?php if (!isset($_SESSION['username'])): ?>
                <div class="login-container">
                    <form method="POST" class="login-form">
                        <h3>Login</h3>
                        <input type="text" name="username" placeholder="Username" required>
                        <input type="password" name="password" placeholder="Password" required>
                        <button type="submit" name="login">Login</button>
                        <?php if (isset($login_error)): ?>
                            <p class="login-error"><?php echo $login_error; ?></p>
                        <?php endif; ?>
                    </form>
                </div>
            <?php endif; ?>
        </div>

        <?php include('quiz3/footer.php'); ?>
        
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    </body>
</html>