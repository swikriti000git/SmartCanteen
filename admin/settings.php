<?php
require_once "../config/auth.php";
checkRole("admin");

require_once "../config/db.php";

$message = "";


// Update settings
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $canteen_name = $_POST['canteen_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];


    $stmt = $conn->prepare(
        "UPDATE settings 
         SET canteen_name=?, email=?, phone=? 
         WHERE id=1"
    );


    $stmt->bind_param(
        "sss",
        $canteen_name,
        $email,
        $phone
    );


    if($stmt->execute()) {

        $message = "Settings updated successfully.";

    }

    $stmt->close();

}


// Get settings
$result = $conn->query(
    "SELECT * FROM settings WHERE id=1"
);


$settings = $result->fetch_assoc();


?>


<!DOCTYPE html>
<html>
<head>

<title>Settings - Admin</title>


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



h2 {

text-align:center;
color:#198754;
margin-bottom:25px;

}



.form-box {

background:white;
padding:30px;
border-radius:12px;
box-shadow:0 5px 15px rgba(0,0,0,0.15);

}



.message {

background:#d1e7dd;
color:#0f5132;
padding:12px;
text-align:center;
border-radius:6px;
margin-bottom:20px;

}



label {

font-weight:bold;

}



input {

width:100%;
padding:12px;
margin:8px 0 20px;
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
System Settings
</h2>



<div class="form-box">



<?php

if($message != "") {

echo "<p class='message'>$message</p>";

}

?>



<form method="POST">


<label>
Canteen Name
</label>


<input 
type="text"
name="canteen_name"
value="<?php echo $settings['canteen_name']; ?>"
required
>



<label>
Email
</label>


<input 
type="email"
name="email"
value="<?php echo $settings['email']; ?>"
required
>



<label>
Phone
</label>


<input 
type="text"
name="phone"
value="<?php echo $settings['phone']; ?>"
required
>



<button type="submit">
Save Settings
</button>



</form>



</div>



<a class="back" href="dashboard.php">
← Back to Dashboard
</a>



</div>



</body>
</html>