<?php
session_start();
include("../config/db.php");

$student_id=$_SESSION['user_id'];
?>

<!DOCTYPE html>

<html>

<head>

<title>My Orders</title>

<link rel="stylesheet" href="style.css">

</head>

<body>

<a href="dashboard.php" class="back-btn">← Back to Dashboard</a>

<div class="container">

<h1>My Orders</h1>

<?php

$sql="SELECT *
FROM orders
WHERE student_id='$student_id'
ORDER BY id DESC
LIMIT 1";

$result=mysqli_query($conn,$sql);

$row=mysqli_fetch_assoc($result);

?>

<?php

$sql = "SELECT * FROM orders
        WHERE student_id='$student_id'
        ORDER BY id DESC
        LIMIT 1";

$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) > 0){

$row = mysqli_fetch_assoc($result);

?>

<div class="current-order">

<h2>Current Order</h2>

<p><strong>Order ID :</strong> <?php echo $row['id']; ?></p>


<p><strong>Status :</strong> <?php echo $row['order_status']; ?></p>

<p><strong>Total Bill :</strong> Rs. <?php echo $row['total_amount']; ?></p>

</div>

<?php } ?>

<p>

Status :

<b><?php echo $row['order_status']; ?></b>

</p>

<p>

Total Bill :

<b>Rs. <?php echo $row['total_amount']; ?></b>

</p>

</div>

<h2>Bill</h2>

<table>

<tr>

<th>Food</th>

<th>Quantity</th>

<th>Price</th>

</tr>

<?php

$order=$row['id'];

$sql2="SELECT *
FROM order_items
JOIN menu
ON order_items.menu_id=menu.id
WHERE order_id='$order'";

$result2=mysqli_query($conn,$sql2);

while($food=mysqli_fetch_assoc($result2))
{

?>

<tr>

<td><?php echo $food['food_name']; ?></td>

<td><?php echo $food['quantity']; ?></td>

<td>Rs. <?php echo $food['price']; ?></td>

</tr>

<?php } ?>

</table>

<h3>Total : Rs. <?php echo $row['total_amount']; ?></h3>

<h2>Previous Orders</h2>

<table>

<tr>

<th>Order ID</th>

<th>Date</th>

<th>Total</th>

<th>Status</th>

</tr>

<?php

$sql3="SELECT *
FROM orders
WHERE student_id='$student_id'
ORDER BY id DESC";

$result3=mysqli_query($conn,$sql3);

while($history=mysqli_fetch_assoc($result3))
{

?>

<tr>

<td><?php echo $history['id']; ?></td>

<td><?php echo $history['ordered_at']; ?></td>

<td>Rs. <?php echo $history['total_amount']; ?></td>

<td><?php echo $history['order_status']; ?></td>

</tr>

<?php } ?>

</table>

</div>

</body>

</html>