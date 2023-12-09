<?php
session_start();
require_once('dbconnect.php');

?>

<!DOCTYPE html>
<html>
<head>
    <title>Welcome Page</title>
    <link rel="stylesheet" href="admin_after_login.css">
    <style>
        /* Centering the content */
        body, html {
            height: 100%;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="welcome-section">
            <h1>Welcome</h1>
            <p>Name</p>
        </div>
        <div class="buttons">
            <a href="dashboard.php" class="transparent-btn">Edit Dashboard</a>
            <a href="books.php" class="transparent-btn">Add/Remove Books</a>
        </div>
    </div>
</body>
</html>
