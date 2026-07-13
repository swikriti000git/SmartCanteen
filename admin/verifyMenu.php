<?php
require_once "../config/auth.php";
checkRole("admin");

require_once "../config/db.php";

$message = "";


// Update menu status
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $menu_id = $_POST['menu_id'];
    $status = $_POST['status'];


    $stmt = $conn->prepare(
        "UPDATE menu SET status=? WHERE id=?"
    );


    $stmt->bind_param(
        "si",
        $status,
        $menu_id
    );


    if ($stmt->execute()) {
        $message = "Menu status updated successfully.";
    }


    $stmt->close();

}



// Fetch menu items
$result = $conn->query(
    "SELECT 
        menu.*,
        users.full_name AS owner_name
     FROM menu
     JOIN users
     ON menu.owner_id = users.id
     ORDER BY menu.created_at DESC"
);


?>


<!DOCTYPE html>
<html>
<head>

<title>Verify Menu - Admin</title>


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
    max-width:1100px;
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



img {

    width:70px;
    height:70px;
    object-fit:cover;
    border-radius:8px;

}



select {

    padding:8px;
    border-radius:5px;

}



button {

    padding:8px 15px;
    background:#198754;
    color:white;
    border:none;
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
Verify Menu Items
</h2>



<?php

if($message != "") {

echo "<div class='message'>$message</div>";

}

?>



<table>


<tr>

<th>Image</th>
<th>Food Name</th>
<th>Owner</th>
<th>Price</th>
<th>Status</th>
<th>Action</th>

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
<?php echo $row['owner_name']; ?>
</td>



<td>
Rs. <?php echo $row['price']; ?>
</td>



<td>
<?php echo $row['status']; ?>
</td>



<td>


<form method="POST">


<input 
type="hidden"
name="menu_id"
value="<?php echo $row['id']; ?>"
>



<select name="status">


<option value="Approved">
Approved
</option>


<option value="Rejected">
Rejected
</option>


<option value="Pending">
Pending
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