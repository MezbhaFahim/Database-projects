<?php
session_start();

// Database connection
$servername = "localhost"; // Change this if your database is hosted elsewhere
$username = "root"; // Change this to your database username
$password = ""; // Change this to your database password
$dbname = "heiwa";

// Create connection
$connection = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

$error = ''; // Initialize error message

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Secure the inputs before using in the query to prevent SQL injection
        $email = mysqli_real_escape_string($connection, $email);

        // Query to check the email in the admin_panel table
        $query = "SELECT * FROM admin_panel WHERE admin_email = '$email'";
        $result = mysqli_query($connection, $query);

        if ($result && mysqli_num_rows($result) == 1) {
            // Fetch the row
            $row = mysqli_fetch_assoc($result);

            // Verify the password using password_verify function
            if (password_verify($password, $row['admin_password'])) {
                // Authentication successful
                $_SESSION['loggedin'] = true;
                // Redirect to the desired page
                header("Location: admin_after_login.html"); // Change this to your desired URL
                exit();
            } else {
                // Password does not match
                $error = "Invalid password";
            }
        } else {
            // Email not found in the database
            $error = "Invalid email";
        }
    } else {
        // Fields were not filled
        $error = "Please enter email and password";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Virtual Library Login</title>
    <link rel="stylesheet" href="login_design.css">
</head>
<body>
    <section>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <h1>Admin Login</h1>
            <?php if (!empty($error)) { ?>
                <p style="color: red;"><?php echo $error; ?></p>
            <?php } ?>
            <div class="inputbox">
                <ion-icon name="email"></ion-icon>
                <input type="email" name="email" required>
                <label for="">Email</label>
            </div>
            <div class="inputbox">
                <ion-icon name="password"></ion-icon>
                <input type="password" name="password" required>
                <label for="">Password</label>
            </div>
            <button type="submit">Log in</button>
        </form>
    </section>
</body>
</html>
