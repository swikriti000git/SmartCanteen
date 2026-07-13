<?php
require_once "../config/auth.php";
checkRole("owner");

require_once "../config/db.php";

$owner_id = $_SESSION['user_id'];


$stmt = $conn->prepare(
    "SELECT * FROM menu 
     WHERE owner_id=? 
     ORDER BY created_at DESC"
);

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

<title>Menu History - Smart Canteen</title>


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



img {

    width:80px;
    height:80px;
    object-fit:cover;
    border-radius:8px;

}



.status {

    padding:6px 10px;
    border-radius:5px;
    color:white;
    font-size:14px;

}



.Pending {

    background:#ffc107;
    color:#333;

}



.Approved {

    background:#198754;

}



.Rejected {

    background:#dc3545;

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
Menu History
</h2>



<table>


<tr>

<th>Image</th>
<th>Food Name</th>
<th>Description</th>
<th>Price</th>
<th>Status</th>
<th>Date</th>

</tr>



<?php while($row = $result->fetch_assoc()) { ?>


<tr>


<td>

<?php if($row['image'] != "") { ?>

<img src="../uploads/<?php echo $row['image']; ?>">

<?php } else { ?>

No Image

<?php } ?>

</td>



<td>
<?php echo $row['food_name']; ?>
</td>



<td>
<?php echo $row['description']; ?>
</td>



<td>
Rs. <?php echo $row['price']; ?>
</td>



<td>

<span class="status <?php echo $row['status']; ?>">

<?php echo $row['status']; ?>

</span>

</td>



<td>
<?php echo $row['created_at']; ?>
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