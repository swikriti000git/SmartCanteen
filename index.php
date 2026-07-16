<?php
session_start();

// Redirect users if already logged in
if (isset($_SESSION['role'])) {
    switch ($_SESSION['role']) {
        case 'student':
            header("Location: student/dashboard.php");
            exit();
        case 'owner':
            header("Location: canteenOwner/dashboard.php");
            exit();
        case 'admin':
            header("Location: admin/dashboard.php");
            exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Canteen Pre-order System</title>

    <link rel="stylesheet" href="assets/css/style.css">

    <!-- Font Awesome -->
    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body>

<!-- Navigation -->

<header>

    <div class="logo">
        🍽 SmartCanteen
    </div>

    <nav>

        <a href="#">Home</a>
        <a href="#about">About</a>
        <a href="student/menu.php">Menu</a>
        <a href="#contact">Contact</a>

        <a href="login.php" class="login-btn">
            Login
        </a>

    </nav>

</header>

<!-- Hero -->

<section class="hero">

<div class="left">

    <span class="tag">
        🍽 Smart Canteen • Order • Collect • Enjoy
    </span>

    <h1>
        <i><b>
        Skip the Queue.<br>
        Not Your Meal.</i></b>
    </h1>

    <p>
        Pre-order your favorite meals from the Smart Canteen before you arrive.
        Save time, avoid long queues, and collect your food when it's ready.
    </p>

    <div class="buttons">

        <a href="register.php" class="btn">
            Get Started
        </a>

        <a href="login.php" class="btn-outline">
            Login
        </a>

    </div>

</div>

<div class="right">

<div class="token-card">

<h3>SMART CANTEEN</h3>

<h2>🎫 TOKEN 047</h2>

<p class="status">
🟢 Ready in 5 Minutes
</p>

<hr>

<div class="item">
<span>🥟 Veg Momo</span>
<span>x1</span>
</div>

<div class="item">
<span>🥟 Samosa</span>
<span>x2</span>
</div>

<div class="item">
<span>🍵 Milk Tea</span>
<span>x1</span>
</div>

<hr>

<p class="thanks">
Thank You!
</p>

</div>

</div>

</section>

<!-- Popular Items -->

<section class="popular">

<h2>🔥 Popular Items</h2>

<div class="foods">

<div class="food">
    <img src="assets/images/momo.png" alt="Momo">
    <p>Chicken Momo</p>
    <p>Rs.150</p>
</div>

<div class="food">
    <img src="assets/images/samosa.png" alt="Samosa">
    <p>Samosa</p>
    <p>Rs.30</p>
</div>

<div class="food">
    <img src="assets/images/coffee.png" alt="Coffee">
    <p>Coffee</p>
    <p>Rs.50</p>
</div>


<div class="food">
    <img src="assets/images/Tea.png" alt="Tea">
    <p>Tea</p>
    <p>Rs.30</p>
</div>

<div class="food">
    <img src="assets/images/burger.png" alt="Burger">
    <p>Burger</p>
    <p>Rs.100</P>
</div>

<div class="food">
    <img src="assets/images/khana.png" alt="Khana Set">
    <p>Khana Set</p>
    <p>Rs.150</p>
</div>
</div>

</div>

</section>

<footer>

<p>

© <?php echo date("Y"); ?>

Smart Canteen Pre-order System

</p>

</footer>
<!-- About Section -->

<section id="about" class="about">

    <div class="container">
        <h2>About Smart Canteen</h2>


    <p>
        Smart Canteen Pre-order System is a web-based college project 
        developed to make the canteen experience faster and easier for students.
        The system allows students to view available food items, place orders 
        online, receive order tokens, and collect their meals without waiting 
        in long queues.
    </p>

    <p>
        This project is designed as a simple and efficient solution for 
        digital canteen management. It provides separate dashboards for 
        students, canteen owners, and administrators to manage orders, menus, 
        and users effectively.
    </p>

    <div class="project-info">

        <div>
            <h3>🎓 College Project</h3>
            <p>
                Developed as a BCA 4th Semester project to demonstrate 
                web development concepts using PHP, MySQL, HTML, CSS and JavaScript.
            </p>
        </div>


        <div>
            <h3>🚀 Our Goal</h3>
            <p>
                To reduce waiting time, improve food ordering efficiency, 
                and provide a convenient digital canteen experience.
            </p>
        </div>


        <div>
            <h3>✨ Features</h3>
            <p>
                Online food ordering, menu management, order tracking,
                token generation and role-based dashboards.
            </p>
        </div>

    </div>


</section>

<!-- Contact Section -->

<section id="contact" class="contact-section">

    <div class="container">

        <h2>Contact Us</h2>

        <p>Have questions? Feel free to contact us.</p>

        <div class="contact-box">

            <p><strong>📍 Address:</strong> Kirtipur, Kathmandu, Nepal</p>

            <p><strong>📞 Phone:</strong> +977 98XXXXXXXX</p>

            <p><strong>📧 Email:</strong> smartcanteen@gmail.com</p>

            <p><strong>🕒 Opening Hours:</strong> Sunday - Friday | 8:00 AM - 5:00 PM</p>

        </div>

    </div>

</section>

</body>
</html>