<?php
session_start();

$adminUser = "admin";
$adminPass = "password123"; // Change this!

if (isset($_POST['login'])) {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($username === $adminUser && $password === $adminPass) {
        $_SESSION['admin_logged_in'] = true;
        header("Location: admin.php");
        exit;
    } else {
        $error = "Invalid username or password.";
    }
}

if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: admin_login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login - RK Bookstore</title>
    <style>
        body { font-family: Arial; background:#f4f4f4; padding:50px; }
        form { max-width:300px; margin:auto; background:#fff; padding:20px; border-radius:8px; }
        input { width:100%; padding:10px; margin:10px 0; }
        button { width:100%; padding:10px; background:#3f51b5; color:#fff; border:none; cursor:pointer; }
        .error { color:red; text-align:center; }
    </style>
</head>
<body>

<h2 style="text-align:center;">Admin Login</h2>

<?php if (!empty($error)): ?>
<p class="error"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method="POST">
    <input type="text" name="username" placeholder="Username" required autofocus />
    <input type="password" name="password" placeholder="Password" required />
    <button name="login" type="submit">Login</button>
</form>

</body>
</html>
