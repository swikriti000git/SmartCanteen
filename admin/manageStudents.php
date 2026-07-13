<?php
require_once "../config/auth.php";
checkRole("admin");

require_once "../config/db.php";

$message = "";


// Delete student
if (isset($_GET['delete'])) {

    $id = $_GET['delete'];

    $stmt = $conn->prepare(
        "DELETE FROM users WHERE id=? AND role='student'"
    );

    $stmt->bind_param(
        "i",
        $id
    );


    if ($stmt->execute()) {
        $message = "Student deleted successfully.";
    }

    $stmt->close();

}


// Fetch students
$result = $conn->query(
    "SELECT * FROM users 
     WHERE role='student'
     ORDER BY created_at DESC"
);

?>


<!DOCTYPE html>
<html>
<head>

<title>Manage Students - Admin</title>


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
    max-width:900px;
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



.delete-btn {

    background:#dc3545;
    color:white;
    padding:8px 15px;
    text-decoration:none;
    border-radius:5px;

}



.delete-btn:hover {

    background:#bb2d3b;

}



.back {

    display:block;
    text-align:center;
    margin-top:25px;
    color:#198754;
    font-weight:bold;
    text-decoration:none;

}



</style>


</head>


<body>


<div class="container">


<h2>
Manage Students
</h2>



<?php

if($message != "") {

echo "<div class='message'>$message</div>";

}

?>



<table>


<tr>

<th>ID</th>
<th>Name</th>
<th>Email</th>
<th>Registered Date</th>
<th>Action</th>

</tr>



<?php while($row = $result->fetch_assoc()) { ?>


<tr>


<td>
<?php echo $row['id']; ?>
</td>



<td>
<?php echo $row['full_name']; ?>
</td>



<td>
<?php echo $row['email']; ?>
</td>



<td>
<?php echo $row['created_at']; ?>
</td>



<td>


<a 
class="delete-btn"
href="manageStudents.php?delete=<?php echo $row['id']; ?>"
onclick="return confirm('Delete this student account?');"
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