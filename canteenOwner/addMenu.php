<?php
require_once "../config/auth.php";
checkRole("owner");

require_once "../config/db.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $owner_id = $_SESSION['user_id'];
    $food_name = trim($_POST['food_name']);
    $description = trim($_POST['description']);
    $price = $_POST['price'];

    $image = "";

    if (!empty($_FILES['image']['name'])) {

        $image_name = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];

        $extension = pathinfo($image_name, PATHINFO_EXTENSION);
        $new_image_name = time() . "." . $extension;

        $upload_path = "../uploads/" . $new_image_name;

        if (move_uploaded_file($image_tmp, $upload_path)) {
            $image = $new_image_name;
        }
    }


    $stmt = $conn->prepare(
        "INSERT INTO menu(owner_id, food_name, description, price, image)
         VALUES (?, ?, ?, ?, ?)"
    );

    $stmt->bind_param(
        "issds",
        $owner_id,
        $food_name,
        $description,
        $price,
        $image
    );


    if ($stmt->execute()) {
        $message = "Menu item added successfully. Waiting for admin approval.";
    } else {
        $message = "Failed to add menu item.";
    }

    $stmt->close();
}

?>

<!DOCTYPE html>
<html>
<head>

<title>Add Menu - Smart Canteen</title>

<style>

* {
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial, sans-serif;
}

body {
    background:#f4f6f8;
    min-height:100vh;
}


.container {

    width:90%;
    max-width:500px;
    background:white;
    margin:40px auto;
    padding:30px;
    border-radius:12px;
    box-shadow:0 5px 20px rgba(0,0,0,0.15);

}


h2 {

    text-align:center;
    color:#198754;
    margin-bottom:25px;

}


label {

    font-weight:bold;
    color:#333;

}


input,
textarea {

    width:100%;
    padding:12px;
    margin:8px 0 20px;
    border:1px solid #ccc;
    border-radius:6px;

}


textarea {

    height:100px;
    resize:none;

}


input[type="file"] {

    background:#f8f9fa;

}


button {

    width:100%;
    padding:12px;
    background:#198754;
    color:white;
    border:none;
    border-radius:6px;
    cursor:pointer;
    font-size:16px;

}


button:hover {

    background:#146c43;

}


.message {

    text-align:center;
    color:green;
    margin-bottom:20px;

}


.back {

    display:block;
    text-align:center;
    margin-top:20px;
    color:#198754;
    text-decoration:none;
    font-weight:bold;

}


.back:hover {

    text-decoration:underline;

}

</style>

</head>


<body>


<div class="container">

<h2>Add New Food Item</h2>


<?php
if ($message != "") {
    echo "<p class='message'>$message</p>";
}
?>


<form method="POST" enctype="multipart/form-data">


<label>
Food Name
</label>

<input 
type="text" 
name="food_name" 
required
>


<label>
Description
</label>

<textarea name="description"></textarea>


<label>
Price
</label>

<input 
type="number" 
name="price" 
step="0.01" 
required
>


<label>
Food Image
</label>

<input 
type="file" 
name="image" 
accept="image/*"
>


<button type="submit">
Add Menu
</button>


</form>


<a class="back" href="dashboard.php">
← Back to Dashboard
</a>


</div>


</body>
</html>