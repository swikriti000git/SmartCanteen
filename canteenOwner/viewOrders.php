<?php
require_once "../config/auth.php";
checkRole("owner");

require_once "../config/db.php";

$owner_id = $_SESSION['user_id'];
$message = "";


// Update order status
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $order_id = $_POST['order_id'];
    $status = $_POST['status'];

    $stmt = $conn->prepare(
        "UPDATE orders 
         SET order_status=? 
         WHERE id=?"
    );

    $stmt->bind_param(
        "si",
        $status,
        $order_id
    );


    if ($stmt->execute()) {
        $message = "Order status updated.";
    }

    $stmt->close();

}


// Fetch orders
$query = "

SELECT 
orders.id AS order_id,
users.full_name,
orders.total_amount,
orders.order_status,
orders.ordered_at,
menu.food_name,
order_items.quantity

FROM orders

JOIN users 
ON orders.student_id = users.id

JOIN order_items 
ON orders.id = order_items.order_id

JOIN menu 
ON order_items.menu_id = menu.id

WHERE menu.owner_id = ?

ORDER BY orders.id DESC

";


$stmt = $conn->prepare($query);

$stmt->bind_param(
    "i",
    $owner_id
);

$stmt->execute();

$result = $stmt->get_result();

?>


<!DOCTYPE html>
<html>
<head>

<title>View Orders - Smart Canteen</title>


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



.message {

    background:#d1e7dd;
    color:#0f5132;
    padding:12px;
    text-align:center;
    border-radius:6px;
    margin-bottom:20px;

}



table {

    width:100%;
    border-collapse:collapse;
    background:white;
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



select {

    padding:8px;
    border-radius:5px;

}



button {

    background:#198754;
    color:white;
    border:none;
    padding:8px 15px;
    border-radius:5px;
    cursor:pointer;

}



button:hover {

    background:#146c43;

}



.back {

    display:block;
    text-align:center;
    margin-top:25px;
    color:#198754;
    text-decoration:none;
    font-weight:bold;

}


</style>


</head>


<body>


<div class="container">


<h2>
Customer Orders
</h2>



<?php

if($message != "") {

echo "<div class='message'>$message</div>";

}

?>



<table>


<tr>

<th>Student</th>
<th>Food</th>
<th>Qty</th>
<th>Total</th>
<th>Status</th>
<th>Date</th>
<th>Action</th>

</tr>



<?php while($row = $result->fetch_assoc()) { ?>


<tr>


<td>
<?php echo $row['full_name']; ?>
</td>


<td>
<?php echo $row['food_name']; ?>
</td>


<td>
<?php echo $row['quantity']; ?>
</td>


<td>
Rs. <?php echo $row['total_amount']; ?>
</td>


<td>
<?php echo $row['order_status']; ?>
</td>


<td>
<?php echo $row['ordered_at']; ?>
</td>


<td>


<form method="POST">


<input 
type="hidden"
name="order_id"
value="<?php echo $row['order_id']; ?>"
>


<select name="status">


<option value="Pending">
Pending
</option>


<option value="Preparing">
Preparing
</option>


<option value="Ready">
Ready
</option>


<option value="Completed">
Completed
</option>


<option value="Cancelled">
Cancelled
</option>


</select>


<button type="submit">
Update
</button>


</form>


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