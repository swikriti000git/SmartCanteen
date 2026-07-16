<?php
require_once "../config/auth.php";
checkRole("student");

require_once "../config/db.php";


// Fetch approved menu
$result = $conn->query(
    "SELECT * FROM menu 
     WHERE status='Approved'
     ORDER BY created_at DESC"
);

?>


<!DOCTYPE html>
<html>
<head>

<title>Food Menu - Student</title>


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
    max-width:1100px;
    margin:auto;

}



h2 {

    text-align:center;
    color:#198754;
    margin-bottom:30px;

}



.menu-container {

    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
    gap:25px;

}



.card {

    background:white;
    padding:20px;
    border-radius:12px;
    box-shadow:0 5px 15px rgba(0,0,0,0.15);
    text-align:center;

}



.card img {

    width:150px;
    height:150px;
    object-fit:cover;
    border-radius:10px;

}



.card h3 {

    margin:15px 0;
    color:#198754;

}



.price {

    font-size:20px;
    font-weight:bold;
    color:#0d6efd;
    margin:10px;

}



.description {

    color:#555;
    margin-bottom:15px;

}



.order-btn {

    display:inline-block;
    background:#198754;
    color:white;
    padding:10px 20px;
    border-radius:6px;
    text-decoration:none;

}



.order-btn:hover {

    background:#146c43;

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
<link rel="stylesheet" href="style.css">


</head>


<body>

<a href="dashboard.php" class="back-btn">← Back to Dashboard</a>


<div class="container">


<h2>
Today's Menu
</h2>



<div class="menu-container">



<?php while($row = $result->fetch_assoc()) { ?>



<div class="card">



<?php if($row['image'] != "") { ?>


<img src="../uploads/<?php echo $row['image']; ?>">


<?php } else { ?>


<img src="../assets/images/no-image.png">


<?php } ?>



<h3>
<?php echo $row['food_name']; ?>
</h3>



<p class="description">

<?php echo $row['description']; ?>

</p>



<p class="price">

Rs. <?php echo $row['price']; ?>

</p>



<a 
class="order-btn"
href="order.php?id=<?php echo $row['id']; ?>"
>
Order Now
</a>



</div>



<?php } ?>




</body>
</html>