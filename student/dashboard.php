<?php
require_once "../config/auth.php";
checkRole("student");
?>

<!DOCTYPE html>
<html>
<head>

    <title>Student Dashboard - Smart Canteen</title>

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
        }

        .header {
            background: #198754;
            color: white;
            padding: 25px;
            text-align: center;
        }

        .header h2 {
            margin-bottom: 10px;
        }

        .dashboard {
            width: 90%;
            max-width: 600px;
            background: white;
            margin: 40px auto;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.15);
            text-align: center;
        }

        .dashboard h3 {
            color: #198754;
            margin-bottom: 25px;
        }

        ul {
            list-style: none;
        }

        ul li {
            margin: 15px 0;
        }

        ul li a {
            display: block;
            padding: 12px;
            background: #198754;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            transition: 0.3s;
        }

        ul li a:hover {
            background: #146c43;
        }

        .logout {
            background: #dc3545 !important;
        }

        .logout:hover {
            background: #bb2d3b !important;
        }

        footer {
            text-align: center;
            margin-top: 30px;
            color: #555;
        }

    </style>

</head>

<body>

<div class="header">

    <h2>
        Welcome, <?php echo $_SESSION['full_name']; ?>
    </h2>

    <p>
        Smart Canteen Student Panel
    </p>

</div>


<div class="dashboard">

    <h3>
        Student Dashboard
    </h3>


    <ul>

        <li>
            <a href="menu.php">
                🍔 View Menu
            </a>
        </li>


        <li>
            <a href="order.php">
                🛒 Place Order
            </a>
        </li>


        <li>
            <a href="myOrders.php">
                📋 My Orders
            </a>
        </li>


        <li>
            <a href="profile.php">
                👤 Profile
            </a>
        </li>


        <li>
            <a class="logout" href="../logout.php">
                🚪 Logout
            </a>
        </li>

    </ul>

</div>


<footer>
    © <?php echo date("Y"); ?> Smart Canteen Management System
</footer>


</body>
</html>