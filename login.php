<?php
session_start();
require_once "config/db.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    if (empty($email) || empty($password)) {
        $message = "Please fill in all fields.";
    } else {

        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows == 1) {

            $user = $result->fetch_assoc();

            if (password_verify($password, $user['password'])) {

                $_SESSION['user_id'] = $user['id'];
                $_SESSION['full_name'] = $user['full_name'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['role'] = $user['role'];

                if ($user['role'] == "student") {
                    header("Location: student/dashboard.php");
                } elseif ($user['role'] == "owner") {
                    header("Location: canteenOwner/dashboard.php");
                } elseif ($user['role'] == "admin") {
                    header("Location: admin/dashboard.php");
                }

                exit();

            } else {
                $message = "Invalid email or password.";
            }

        } else {
            $message = "Invalid email or password.";
        }

        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login - Smart Canteen</title>

    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background: #f4f6f8;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-box {
            background: white;
            width: 350px;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0px 5px 20px rgba(0,0,0,0.15);
        }

        h2 {
            text-align: center;
            color: #198754;
            margin-bottom: 25px;
        }

        label {
            font-weight: bold;
            color: #333;
        }

        input {
            width: 100%;
            padding: 12px;
            margin: 8px 0 18px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        button {
            width: 100%;
            padding: 12px;
            background: #198754;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background: #146c43;
        }

        .success {
            color: green;
            text-align: center;
            margin-bottom: 15px;
        }

        .error {
            color: red;
            text-align: center;
            margin-bottom: 15px;
        }

        .register {
            text-align: center;
            margin-top: 20px;
        }

        .register a {
            color: #198754;
            text-decoration: none;
            font-weight: bold;
        }

        .register a:hover {
            text-decoration: underline;
        }

    </style>

</head>

<body>

<div class="login-box">

    <h2>Login</h2>

    <?php
    if (isset($_GET['registered'])) {
        echo "<p class='success'>Registration successful. Please login.</p>";
    }

    if (!empty($message)) {
        echo "<p class='error'>$message</p>";
    }
    ?>

    <form method="POST">

        <label>Email</label>
        <input type="email" name="email" required>


        <label>Password</label>
        <input type="password" name="password" required>


        <button type="submit">
            Login
        </button>

    </form>


    <div class="register">
        Don't have an account?
        <a href="register.php">Register Here</a>
        <a href="/Smartcanteen/index.php" style="display:block; margin-top:10px; color:#198754;">Back to Home</a>
    </div>

</div>

</body>
</html>