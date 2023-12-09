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
            position: relative;
        }

        /* New styles for the logout button */
        .logout-button {
            position: absolute;
            top: 20px;
            right: 20px;
            background-color: red;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="logout.php" class="logout-button">Logout</a>
        <div class="welcome-section">
            <h1>Welcome</h1>
            <p>Admin</p>
        </div>
        <div class="buttons">
            <a href="dashboard.php" class="transparent-btn">Edit Dashboard</a>
            <a href="books.php" class="transparent-btn">Add/Remove Books</a>
        </div>
    </div>
</body>
</html>
