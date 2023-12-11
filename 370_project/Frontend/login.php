<?php
session_start();
require_once('dbconnect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get user input
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if the email and password match the records in the database
    $sql = "SELECT * FROM author_dashboard WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $sql);

    // Check if the query was successful
    if ($result && mysqli_num_rows($result) > 0) {
        // Authentication successful
        $row = mysqli_fetch_assoc($result);

        // Store user data in session
        $_SESSION['email'] = $row['email'];
        $_SESSION['name'] = $row['name'];

        // Redirect to profile_dashboard.php
        header('Location: profile_dashboard.php');
        exit();
    } else {
        // Authentication failed
        $error_message = "Invalid email or password. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <!-- Add any necessary meta tags or scripts -->
</head>
<body>

    <h2>Login</h2>

    <?php
    // Display error message if authentication failed
    if (isset($error_message)) {
        echo '<p style="color: red;">' . $error_message . '</p>';
    }
    ?>

    <form action="" method="post">
        <label>Email:</label>
        <input type="email" name="email" required>

        <br>

        <label>Password:</label>
        <input type="password" name="password" required>

        <br>

        <button type="submit">Login</button>
    </form>

</body>
</html>
