<?php
session_start();
require_once "config/db.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $full_name = trim($_POST["full_name"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];
    $role = $_POST["role"];

    if (empty($full_name) || empty($email) || empty($password) || empty($confirm_password) || empty($role)) {
        $message = "All fields are required.";
    } elseif ($password != $confirm_password) {
        $message = "Passwords do not match.";
    } else {

        $check = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $check->bind_param("s", $email);
        $check->execute();

        $result = $check->get_result();

        if ($result->num_rows > 0) {
            $message = "Email already exists.";
        } else {

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $conn->prepare(
                "INSERT INTO users(full_name, email, password, role) VALUES(?, ?, ?, ?)"
            );

            $stmt->bind_param(
                "ssss",
                $full_name,
                $email,
                $hashedPassword,
                $role
            );

            if ($stmt->execute()) {
                header("Location: login.php?registered=1");
                exit();
            } else {
                $message = "Registration failed.";
            }

            $stmt->close();
        }

        $check->close();
    }
}
?>

<!DOCTYPE html>
<html>
<head>

    <title>Register - Smart Canteen</title>

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

        .register-box {
            width: 380px;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.15);
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

        input,
        select {
            width: 100%;
            padding: 12px;
            margin-top: 8px;
            margin-bottom: 18px;
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

        .error {
            color: red;
            text-align: center;
            margin-bottom: 15px;
        }

        .login-link {
            text-align: center;
            margin-top: 20px;
        }

        .login-link a {
            color: #198754;
            text-decoration: none;
            font-weight: bold;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

    </style>

</head>

<body>

<div class="register-box">

<h2>Register</h2>

<?php if (!empty($message)) : ?>
    <p class="error">
        <?php echo $message; ?>
    </p>
<?php endif; ?>


<form method="POST">

    <label>Full Name</label>
    <input type="text" name="full_name" required>


    <label>Email</label>
    <input type="email" name="email" required>


    <label>Password</label>
    <input type="password" name="password" required>


    <label>Confirm Password</label>
    <input type="password" name="confirm_password" required>


    <label>Register As</label>
    <select name="role" required>

        <option value="">
            Select Role
        </option>

        <option value="student">
            Student
        </option>

        <option value="owner">
            Canteen Owner
        </option>

    </select>


    <button type="submit">
        Register
    </button>

</form>


<div class="login-link">

    Already have an account?
    <a href="login.php">
        Login Here
    </a>

</div>


</div>

</body>
</html>