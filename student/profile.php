<?php
require_once "../config/auth.php";
checkRole("student");

require_once "../config/db.php";

$user_id = $_SESSION['user_id'];

$message = "";


// Update profile
if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $full_name = trim($_POST['full_name']);
    $email = trim($_POST['email']);


    $stmt = $conn->prepare(
        "UPDATE users 
         SET full_name=?, email=?
         WHERE id=?"
    );


    $stmt->bind_param(
        "ssi",
        $full_name,
        $email,
        $user_id
    );


    if($stmt->execute()) {

        $_SESSION['full_name'] = $full_name;
        $_SESSION['email'] = $email;

        $message = "Profile updated successfully.";

    }


    $stmt->close();

}



// Fetch user data

$stmt = $conn->prepare(
    "SELECT * FROM users WHERE id=?"
);


$stmt->bind_param(
    "i",
    $user_id
);


$stmt->execute();


$result = $stmt->get_result();


$user = $result->fetch_assoc();


$stmt->close();


?>


<!DOCTYPE html>
<html>
<head>

<title>Profile - Student</title>


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



.profile-box {

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



input:disabled {

background:#eee;

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


<div class="profile-box">


<h2>
My Profile
</h2>



<?php

if($message!="") {

echo "<div class='message'>$message</div>";

}

?>



<form method="POST">


<label>
Full Name
</label>


<input 
type="text"
name="full_name"
value="<?php echo $user['full_name']; ?>"
required
>




<label>
Email
</label>


<input 
type="email"
name="email"
value="<?php echo $user['email']; ?>"
required
>



<label>
Role
</label>


<input 
type="text"
value="<?php echo ucfirst($user['role']); ?>"
disabled
>



<button type="submit">
Update Profile
</button>



</form>



<a class="back" href="dashboard.php">
← Back to Dashboard
</a>



</div>


</div>


</body>
</html>