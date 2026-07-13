<?php
require_once "../config/auth.php";
checkRole("student");

require_once "../config/db.php";

$student_id = $_SESSION['user_id'];



$query = "

SELECT 

orders.id AS order_id,
orders.total_amount,
orders.order_status,
orders.ordered_at,

menu.food_name,
order_items.quantity,
order_items.price


FROM orders


JOIN order_items

ON orders.id = order_items.order_id


JOIN menu

ON order_items.menu_id = menu.id


WHERE orders.student_id = ?


ORDER BY orders.id DESC

";



$stmt = $conn->prepare($query);


$stmt->bind_param(
    "i",
    $student_id
);


$stmt->execute();


$result = $stmt->get_result();


?>


<!DOCTYPE html>
<html>
<head>

<title>My Orders - Student</title>


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

width:95%;
max-width:1000px;
margin:auto;

}



h2 {

text-align:center;
color:#198754;
margin-bottom:25px;

}



table {

width:100%;
background:white;
border-collapse:collapse;
box-shadow:0 5px 15px rgba(0,0,0,0.15);

}



th {

background:#198754;
color:white;
padding:12px;

}



td {

padding:12px;
text-align:center;
border-bottom:1px solid #ddd;

}



.status {

padding:6px 12px;
border-radius:5px;
font-weight:bold;

}



.Pending {

background:#ffc107;
color:#333;

}



.Preparing {

background:#0d6efd;
color:white;

}



.Ready {

background:#20c997;
color:white;

}



.Completed {

background:#198754;
color:white;

}



.Cancelled {

background:#dc3545;
color:white;

}



.back {

display:block;
text-align:center;
margin-top:30px;
color:#198754;
text-decoration:none;
font-weight:bold;

}



</style>


</head>


<body>


<div class="container">


<h2>
My Orders
</h2>



<table>


<tr>

<th>Order ID</th>
<th>Food</th>
<th>Quantity</th>
<th>Price</th>
<th>Total</th>
<th>Status</th>
<th>Date</th>

</tr>



<?php while($row=$result->fetch_assoc()) { ?>


<tr>


<td>

#<?php echo $row['order_id']; ?>

</td>



<td>

<?php echo $row['food_name']; ?>

</td>



<td>

<?php echo $row['quantity']; ?>

</td>



<td>

Rs. <?php echo $row['price']; ?>

</td>



<td>

Rs. <?php echo $row['total_amount']; ?>

</td>



<td>


<span class="status <?php echo $row['order_status']; ?>">

<?php echo $row['order_status']; ?>

</span>


</td>



<td>

<?php echo $row['ordered_at']; ?>

</td>



</tr>


<?php } ?>


</table>



<a class="back" href="dashboard.php">
← Back to Dashboard
</a>



</div>


</body>
</html>