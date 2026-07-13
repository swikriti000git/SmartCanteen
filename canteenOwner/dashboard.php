<?php
require_once "../config/auth.php";
checkRole("owner");
?>

<!DOCTYPE html>
<html>
<head>

    <title>Canteen Owner Dashboard - Smart Canteen</title>

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
            max-width: 700px;
            background: white;
            margin: 40px auto;
            padding: 35px;
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
            padding: 13px;
            background: #198754;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-size: 16px;
            transition: 0.3s;
        }

        ul li a:hover {
            background: #146c43;
            transform: scale(1.02);
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
        Smart Canteen Owner Panel
    </p>

</div>



<div class="dashboard">

    <h3>
        Canteen Owner Dashboard
    </h3>


    <ul>

        <li>
            <a href="addMenu.php">
                ➕ Add Menu Item
            </a>
        </li>


        <li>
            <a href="editMenu.php">
                ✏️ Edit Menu
            </a>
        </li>


        <li>
            <a href="deleteMenu.php">
                🗑️ Delete Menu
            </a>
        </li>


        <li>
            <a href="viewOrders.php">
                📦 View Orders
            </a>
        </li>


        <li>
            <a href="menuHistory.php">
                📜 Menu History
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