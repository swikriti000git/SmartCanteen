<?php
require_once "../config/auth.php";
checkRole("student");

require_once "../config/db.php";

$message = "";

$student_id = $_SESSION['user_id'];


// Get selected menu item
if(isset($_GET['id'])) {

    $menu_id = $_GET['id'];

    $stmt = $conn->prepare(
        "SELECT * FROM menu WHERE id=? AND status='Approved'"
    );

    $stmt->bind_param(
        "i",
        $menu_id
    );

    $stmt->execute();

    $result = $stmt->get_result();

    $food = $result->fetch_assoc();

    $stmt->close();

}



// Place order
if($_SERVER["REQUEST_METHOD"]=="POST") {


    $menu_id = $_POST['menu_id'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];


    $total = $price * $quantity;



    // Insert order

    $stmt = $conn->prepare(
        "INSERT INTO orders(student_id,total_amount)
         VALUES(?,?)"
    );


    $stmt->bind_param(
        "id",
        $student_id,
        $total
    );


    if($stmt->execute()) {


        $order_id = $stmt->insert_id;



        // Insert order items

        $item = $conn->prepare(
            "INSERT INTO order_items(order_id,menu_id,quantity,price)
             VALUES(?,?,?,?)"
        );


        $item->bind_param(
            "iiid",
            $order_id,
            $menu_id,
            $quantity,
            $price
        );


        if($item->execute()) {

            $message = "Order placed successfully.";

        }


        $item->close();


    }


    $stmt->close();

}


?>


<!DOCTYPE html>
<html>
<head>

<title>Place Order - Student</title>


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
max-width:500px;
margin:auto;

}



.order-box {

background:white;
padding:30px;
border-radius:12px;
box-shadow:0 5px 15px rgba(0,0,0,0.15);

}



h2 {

text-align:center;
color:#198754;
margin-bottom:25px;

}



.food {

text-align:center;

}



.food img {

width:150px;
height:150px;
object-fit:cover;
border-radius:10px;

}



.food h3 {

color:#198754;
margin:15px;

}



.price {

font-size:20px;
font-weight:bold;
color:#0d6efd;

}



label {

font-weight:bold;

}



input {

width:100%;
padding:12px;
margin:10px 0 20px;
border:1px solid #ccc;
border-radius:6px;

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



.message {

background:#d1e7dd;
color:#0f5132;
padding:12px;
margin-bottom:20px;
text-align:center;
border-radius:6px;

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


<div class="order-box">


<h2>
Place Order
</h2>



<?php

if($message!="") {

echo "<div class='message'>$message</div>";

}

?>



<?php if(isset($food)) { ?>



<div class="food">


<?php if($food['image']!="") { ?>

<img src="../uploads/<?php echo $food['image']; ?>">

<?php } ?>


<h3>

<?php echo $food['food_name']; ?>

</h3>



<p>

<?php echo $food['description']; ?>

</p>



<p class="price">

Rs. <?php echo $food['price']; ?>

</p>



</div>




<form method="POST">


<input 
type="hidden"
name="menu_id"
value="<?php echo $food['id']; ?>"
>


<input 
type="hidden"
name="price"
value="<?php echo $food['price']; ?>"
>



<label>
Quantity
</label>


<input 
type="number"
name="quantity"
value="1"
min="1"
required
>



<button type="submit">
Confirm Order
</button>


</form>



<?php } else { ?>


<p>
Food item not found.
</p>


<?php } ?>



<a class="back" href="menu.php">
← Back to Menu
</a>



</div>


</div>


</body>
</html>