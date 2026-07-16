<?php
require_once "../config/auth.php";
checkRole("admin");
?>

<!DOCTYPE html>
<html>
<head>

<title>Admin Dashboard - Smart Canteen</title>

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

body{
    background:linear-gradient(135deg,#e8f5e9,#d4edda);
    min-height:100vh;
}

.header{
    background:#198754;
    color:#fff;
    text-align:center;
    padding:30px;
    box-shadow:0 4px 10px rgba(0,0,0,0.2);
}

.header h2{
    margin-bottom:8px;
    font-size:30px;
}

.header p{
    font-size:17px;
}

.dashboard{
    width:90%;
    max-width:900px;
    margin:40px auto;
    background:#fff;
    padding:35px;
    border-radius:15px;
    box-shadow:0 10px 25px rgba(0,0,0,0.15);
}

.dashboard h3{
    text-align:center;
    color:#198754;
    margin-bottom:30px;
    font-size:28px;
}

ul{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(180px,1fr));
    gap:25px;
    list-style:none;
}

ul{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(180px,1fr));
    gap:25px;
    list-style:none;
}

ul li a{
    height:170px;
    border-radius:15px;
    display:flex;
    flex-direction:column;
    justify-content:center;
    align-items:center;
    text-decoration:none;
    color:#2c3e50;
    font-size:20px;
    font-weight:600;
    box-shadow:0 8px 20px rgba(0,0,0,0.08);
    transition:0.3s;
    border:1px solid #e5e7eb;
}

ul li:nth-child(1) a{
    background:#E8F5E9;   /* Light Green */
}

ul li:nth-child(2) a{
    background:#E3F2FD;   /* Light Blue */
}

ul li:nth-child(3) a{
    background:#FFF8E1;   /* Light Yellow */
}

ul li:nth-child(4) a{
    background:#F3E5F5;   /* Light Purple */
}

ul li:nth-child(5) a{
    background:#E0F7FA;   /* Light Cyan */
}

ul li:nth-child(6) a{
    background:#FDECEC;   /* Light Red */
}

.logout{
    color:#c62828 !important;
}

ul li a span{
    font-size:48px;
    margin-bottom:15px;
}

ul li a:hover{
    transform:translateY(-8px);
    box-shadow:0 15px 25px rgba(0,0,0,0.15);
}

ul li a span{
    font-size:50px;
    margin-bottom:15px;
}

ul li a:hover{
    background:#146c43;
    transform:translateY(-8px);
    box-shadow:0 15px 30px rgba(0,0,0,.25);
}

/* Logout */

.logout{
    background:#dbeafe !important;
    color:#0d6efd !important;
}

.logout:hover{
    background:#0d6efd !important;
    color:#fff !important;
}

footer{
    text-align:center;
    margin:30px 0;
    color:#555;
    font-weight:bold;
}
</style>

</head>


<body>


<div class="header">


<h2>
Welcome, <?php echo $_SESSION['full_name']; ?>
</h2>


<p>
Smart Canteen Admin Panel
</p>


</div>



<div class="dashboard">


<h3>
Admin Dashboard
</h3>




<ul>

    <li>
        <a href="verifyMenu.php">
            <span>🍽️</span>
            Verify Menu
        </a>
    </li>

    <li>
        <a href="manageStudents.php">
            <span>👨‍🎓</span>
            Students
        </a>
    </li>

    <li>
        <a href="manageOwner.php">
            <span>🏪</span>
            Owners
        </a>
    </li>

    <li>
        <a href="reports.php">
            <span>📊</span>
            Reports
        </a>
    </li>

    <li>
        <a href="settings.php">
            <span>⚙️</span>
            Settings
        </a>
    </li>

    <li>
        <a href="../logout.php" class="logout">
            <span>🚪</span>
            Logout
        </a>
    </li>

</ul>

</div>



<footer>

© <?php echo date("Y"); ?> Smart Canteen Management System

</footer>



</body>
</html>