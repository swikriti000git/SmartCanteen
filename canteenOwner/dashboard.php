<?php
require_once "../config/auth.php";
checkRole("owner");
?>

<!DOCTYPE html>
<html>
<head>

<title>Canteen Owner Dashboard - Smart Canteen</title>

<style>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Segoe UI',Tahoma,Geneva,Verdana,sans-serif;
}


body{
    background:linear-gradient(135deg,#e3f2fd,#e0f7fa);
    min-height:100vh;
}


/* Header */

.header{
    background:#0d6efd;
    color:#fff;
    text-align:center;
    padding:30px;
    box-shadow:0 4px 10px rgba(0,0,0,.2);
}


.header h2{
    font-size:30px;
    margin-bottom:8px;
}


.header p{
    font-size:17px;
}



/* Dashboard Container */

.dashboard{

    width:90%;
    max-width:1000px;
    margin:40px auto;
    background:#ffffff;
    padding:35px;
    border-radius:18px;
    box-shadow:0 10px 25px rgba(0,0,0,.15);

}


.dashboard h3{

    text-align:center;
    color:#0d6efd;
    font-size:30px;
    margin-bottom:35px;

}



/* Grid */

ul{

    list-style:none;
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
    gap:25px;

}



/* Dashboard Boxes */

ul li a{

    height:190px;
    border-radius:16px;

    display:flex;
    flex-direction:column;
    justify-content:center;
    align-items:center;

    text-align:center;

    text-decoration:none;

    color:#2c3e50;

    padding:20px;

    box-shadow:0 8px 20px rgba(0,0,0,.08);

    transition:.3s;

}



/* Same Student Dashboard Card Colors */

ul li:nth-child(1) a{
    background:#E3F2FD;
}


ul li:nth-child(2) a{
    background:#E8F5E9;
}


ul li:nth-child(3) a{
    background:#FFF3E0;
}


ul li:nth-child(4) a{
    background:#F3E5F5;
}


ul li:nth-child(5) a{
    background:#FFFDE7;
}


ul li:nth-child(6) a{
    background:#FDECEC;
}



/* Icons */

ul li a span{

    font-size:55px;
    margin-bottom:15px;

}



/* Same Blue Hover as Student Dashboard */

ul li a:hover{

    background:#0d6efd;

    color:white;

    transform:translateY(-8px);

    box-shadow:0 15px 30px rgba(13,110,253,.35);

}


ul li a:hover span{

    transform:scale(1.1);
    transition:.3s;

}


ul li a:hover,
ul li a:hover span{

    color:white;

}



/* Logout Same as Student Dashboard */

.logout{

    background:#dbeafe !important;
    color:#0d6efd !important;

}


.logout:hover{

    background:#0d6efd !important;
    color:white !important;

}


.logout:hover span{

    color:white;

}



/* Footer */

footer{

    text-align:center;
    margin:30px 0;
    color:#555;
    font-weight:bold;

}

</style>
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

<span>➕</span>
Add Menu

</a>
</li>



<li>
<a href="editMenu.php">

<span>✏️</span>
Edit Menu

</a>
</li>




<li>
<a href="deleteMenu.php">

<span>🗑️</span>
Delete Menu

</a>
</li>




<li>
<a href="viewOrders.php">

<span>📦</span>
View Orders

</a>
</li>




<li>
<a href="menuHistory.php">

<span>📜</span>
Menu History

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