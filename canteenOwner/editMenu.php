<?php
require_once "../config/auth.php";
checkRole("owner");

require_once "../config/db.php";

$owner_id = $_SESSION['user_id'];
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST['id'];
    $food_name = trim($_POST['food_name']);
    $description = trim($_POST['description']);
    $price = $_POST['price'];

    $stmt = $conn->prepare(
        "UPDATE menu 
         SET food_name=?, description=?, price=?, status='Pending'
         WHERE id=? AND owner_id=?"
    );

    $stmt->bind_param(
        "ssdii",
        $food_name,
        $description,
        $price,
        $id,
        $owner_id
    );


    if ($stmt->execute()) {
        $message = "Menu updated successfully.";
    } else {
        $message = "Update failed.";
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

<title>Edit Menu - Smart Canteen</title>

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
    max-width:700px;
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


.menu-card {

    background:white;
    padding:25px;
    margin-bottom:25px;
    border-radius:12px;
    box-shadow:0 5px 15px rgba(0,0,0,0.15);

}


label {

    font-weight:bold;

}


input,
textarea {

    width:100%;
    padding:10px;
    margin:8px 0 15px;
    border:1px solid #ccc;
    border-radius:5px;

}


textarea {

    height:90px;

}


.status {

    color:#666;
    margin-bottom:15px;

}


button {

    width:100%;
    padding:12px;
    background:#198754;
    color:white;
    border:none;
    border-radius:6px;
    cursor:pointer;

}


button:hover {

    background:#146c43;

}


.back {

    display:block;
    text-align:center;
    margin-top:20px;
    color:#198754;
    text-decoration:none;
    font-weight:bold;

}

</style>

</head>


<body>


<div class="container">


<h2>
Edit Menu Items
</h2>


<?php

if($message != "") {
    echo "<div class='message'>$message</div>";
}

?>


<?php while($row = $result->fetch_assoc()) { ?>


<div class="menu-card">


<form method="POST">


<input 
type="hidden" 
name="id" 
value="<?php echo $row['id']; ?>"
>


<label>
Food Name
</label>

<input 
type="text"
name="food_name"
value="<?php echo $row['food_name']; ?>"
required
>



<label>
Description
</label>

<textarea name="description"><?php echo $row['description']; ?></textarea>



<label>
Price
</label>

<input 
type="number"
step="0.01"
name="price"
value="<?php echo $row['price']; ?>"
required
>



<p class="status">
Status:
<?php echo $row['status']; ?>
</p>



<button type="submit">
Update Menu
</button>


</form>


</div>


<?php } ?>


<a class="back" href="dashboard.php">
← Back to Dashboard
</a>


</div>


</body>
</html>