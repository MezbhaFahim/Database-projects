<?php
session_start();
require_once('DBconnect.php');


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

        /* Body styles */
body {
    display: flex;
    align-items: flex-start;
    justify-content: center;
    min-height: 100vh;
    margin: 0;
    padding: 0;
    background-image: url(https://wallpaperaccess.com/full/2222765.jpg);
    
    background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
    font-family: 'Poppins', sans-serif;
}

.container {
    text-align: center;
    margin-left: 5vw;
    margin-top: 20vh;
    backdrop-filter: blur(10px); /* Glass-like effect */
    background-color: rgba(255, 255, 255, 0.3); /* Slightly transparent background */
    padding: 20px;
    border-radius: 20px;
    box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.1); /* Shadow effect */
}

/* Welcome section styles */
.welcome-section {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-bottom: 50px;
}

.welcome-section h1 {
    font-size: 4rem;
    color: #000; /* Black color */
    margin-bottom: 5px;
}

.welcome-section p {
    font-size: 2rem;
    color: #000; /* Black color */
    margin-bottom: 50px;
}

/* Buttons section styles */
.buttons {
    display: flex;
    justify-content: center;
    gap: 50px;
}

.transparent-btn {
    padding: 15px 30px;
    font-size: 1.5rem;
    color: #fff;
    border: 2px solid rgba(255, 255, 255, 0.5);
    background-color: transparent;
    cursor: pointer;
    transition: all 0.3s ease;
    border-radius: 50px;
}

.transparent-btn:hover {
    background-color: rgba(255, 255, 255, 0.2);
    color: #ff7f50;
    border-color: #ff7f50;
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