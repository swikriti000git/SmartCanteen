<?php
require_once "../config/auth.php";
checkRole("owner");

require_once "../config/db.php";

$owner_id = $_SESSION['user_id'];
$message = "";


if (isset($_GET['id'])) {

    $id = $_GET['id'];

    $stmt = $conn->prepare(
        "DELETE FROM menu WHERE id=? AND owner_id=?"
    );

    $stmt->bind_param(
        "ii",
        $id,
        $owner_id
    );


    if ($stmt->execute()) {
        $message = "Menu item deleted successfully.";
    } else {
        $message = "Failed to delete menu item.";
    }

    $stmt->close();

}


$stmt = $conn->prepare(
    "SELECT * FROM menu WHERE owner_id=?"
);

$stmt->bind_param("i", $owner_id);
$stmt->execute();

$result = $stmt->get_result();

?>


<!DOCTYPE html>
<html>
<head>

<title>Delete Menu - Smart Canteen</title>


<style>

* {
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial, sans-serif;
}


body {

    background:#f4f6f8;
    padding:30px;

}



.container {

    width:90%;
    max-width:800px;
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
    background:white;
    border-collapse:collapse;
    border-radius:10px;
    overflow:hidden;
    box-shadow:0 5px 15px rgba(0,0,0,0.15);

}



th {

    background:#198754;
    color:white;
    padding:15px;

}



td {

    padding:12px;
    text-align:center;
    border-bottom:1px solid #ddd;

}



.delete-btn {

    background:#dc3545;
    color:white;
    padding:8px 15px;
    border-radius:5px;
    text-decoration:none;

}



.delete-btn:hover {

    background:#bb2d3b;

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
Delete Menu Items
</h2>



<?php

if($message != "") {

    echo "<div class='message'>$message</div>";

}

?>



<table>


<tr>

<th>
Food Name
</th>

<th>
Price
</th>

<th>
Status
</th>

<th>
Action
</th>

</tr>



<?php while($row = $result->fetch_assoc()) { ?>


<tr>


<td>
<?php echo $row['food_name']; ?>
</td>



<td>
Rs. <?php echo $row['price']; ?>
</td>



<td>
<?php echo $row['status']; ?>
</td>



<td>

<a 
class="delete-btn"
href="deleteMenu.php?id=<?php echo $row['id']; ?>"
onclick="return confirm('Are you sure you want to delete this item?');"
>
Delete
</a>

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