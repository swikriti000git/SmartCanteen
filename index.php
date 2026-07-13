<?php
session_start();

// Redirect users if already logged in
if (isset($_SESSION['role'])) {
    switch ($_SESSION['role']) {
        case 'student':
            header("Location: student/dashboard.php");
            exit();
        case 'owner':
            header("Location: canteenOwner/dashboard.php");
            exit();
        case 'admin':
            header("Location: admin/dashboard.php");
            exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Canteen Management System</title>

    <!-- Main CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <header>
        <h1>🍽️ Smart Canteen Management System</h1>
        <p>Fast • Easy • Smart Food Ordering</p>
    </header>

    <main class="container">

        <section class="hero">
            <h2>Welcome!</h2>
            <p>
                Order food online, manage menus, and reduce waiting time
                with our Smart Canteen Management System.
            </p>

            <div class="buttons">
                <a href="login.php" class="btn">Login</a>
                <a href="register.php" class="btn btn-secondary">Register</a>
            </div>
        </section>

    </main>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> Smart Canteen Management System</p>
    </footer>

</body>
</html>