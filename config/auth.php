<?php
// config/auth.php

require_once "session.php";

// Usage:
// require_once "../config/auth.php";
// checkRole("student");

function checkRole($role)
{
    if (!isset($_SESSION['role'])) {
        header("Location: ../login.php");
        exit();
    }

    if ($_SESSION['role'] != $role) {
        echo "<h2>Access Denied!</h2>";
        exit();
    }
}

