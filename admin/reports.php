<?php
require_once "../config/auth.php";
checkRole("admin");

require_once "../config/db.php";


// Total students
$students = $conn->query(
    "SELECT COUNT(*) AS total FROM users WHERE role='student'"
)->fetch_assoc();


// Total owners
$owners = $conn->query(
    "SELECT COUNT(*) AS total FROM users WHERE role='owner'"
)->fetch_assoc();


// Total menu items
$menu = $conn->query(
    "SELECT COUNT(*) AS total FROM menu"
)->fetch_assoc();


// Total orders
$orders = $conn->query(
    "SELECT COUNT(*) AS total FROM orders"
)->fetch_assoc();


// Total sales
$sales = $conn->query(
    "SELECT SUM(total_amount) AS total FROM orders 
     WHERE order_status='Completed'"
)->fetch_assoc();

?>


<!DOCTYPE html>
<html>
<head>

<title>Reports - Admin</title>


<style>

* {

    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial,sans-serif;

}



body {

    background:#f4f6f8;
    padding:30px;

}



.container {

    width:90%;
    max-width:1000px;
    margin:auto;

}



h2 {

    text-align:center;
    color:#198754;
    margin-bottom:30px;

}



.cards {

    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
    gap:20px;

}



.card {

    background:white;
    padding:30px;
    border-radius:12px;
    text-align:center;
    box-shadow:0 5px 15px rgba(0,0,0,0.15);

}



.card h3 {

    color:#198754;
    margin-bottom:15px;

}



.number {

    font-size:35px;
    font-weight:bold;
    color:#333;

}



.sales {

    color:#0d6efd;

}



.back {

    display:block;
    text-align:center;
    margin-top:35px;
    color:#198754;
    text-decoration:none;
    font-weight:bold;

}



</style>


</head>


<body>


<div class="container">


<h2>
System Reports
</h2>



<div class="cards">



<div class="card">

<h3>
Students
</h3>

<div class="number">

<?php echo $students['total']; ?>

</div>

</div>




<div class="card">

<h3>
Canteen Owners
</h3>

<div class="number">

<?php echo $owners['total']; ?>

</div>

</div>




<div class="card">

<h3>
Menu Items
</h3>

<div class="number">

<?php echo $menu['total']; ?>

</div>

</div>




<div class="card">

<h3>
Total Orders
</h3>

<div class="number">

<?php echo $orders['total']; ?>

</div>

</div>




<div class="card">

<h3>
Total Sales
</h3>

<div class="number sales">

Rs.
<?php echo $sales['total'] ?? 0; ?>

</div>

</div>



</div>



<a class="back" href="dashboard.php">
← Back to Dashboard
</a>



</div>


</body>
</html>