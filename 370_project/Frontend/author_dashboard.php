<?php
session_start();
require_once('DBconnect.php');

if (!isset($_SESSION['email'])) {
    header('Location: author_login.php');
    exit();
}

$email = $_SESSION['email'];
$sql = "SELECT * FROM author_dashboard WHERE email = '$email'";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $name = $row['name'];
    $biography = $row['biography'];
    $list_of_books = $row['lists_of_books'];
    $social_media = $row['social_media'];
} else {
    echo "Error fetching user data.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Author Profile Dashboard</title>
    <link rel="stylesheet" href="profile_styles.css">
    <!-- Add any other necessary meta tags or scripts -->
</head>
<body>

    <header>
        <!-- Your header content -->
        <div class="button-section">
            <!-- Add Book Button -->
            <a href="author_addbook.php" class="button add-btn">Add Book</a>

            <!-- Update Button -->
            <a href="author_update.php" class="button update-btn">Update</a>
        </div>
    </header>

    <main class="container">
        <div class="profile-section">
            <h1>Welcome, <?php echo $name; ?></h1>
            <div class="user-info">
                <p><strong>Email:</strong> <?php echo $email; ?></p>
                <p><strong>Biography:</strong> <?php echo $biography; ?></p>
                <p><strong>List of Books:</strong> <?php echo $list_of_books; ?></p>
                <p><strong>Social Media:</strong> <?php echo $social_media; ?></p>
                <!-- Add more fields as needed -->
            </div>
        </div>
    </main>

    <footer>
        <!-- Your footer content -->
        <div class="logout-section">
            <a href="logout.php" class="button logout-btn">Logout</a>
        </div>
    </footer>

</body>
</html>

<style>
body {
    background-image: url(https://wallpaperaccess.com/full/2222765.jpg);
    
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
}

.container {
    width: 100%;
    height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
}

.profile-section {
    background-color: rgba(255, 255, 255, 0.5); /* White color with 50% transparency */
    padding: 20px;
    border-radius: 10px;
    text-align: center;
}

.user-info {
    margin-top: 20px;
}

.button-section {
    position: fixed;
    right: 20px;
    top: 20px;
    display: flex;
    flex-direction: column;
}

.button {
    font-size: 18px;
    font-weight: bold;
    padding: 10px;
    margin-bottom: 10px;
    background-color: green;
    color: white;
    text-align: center;
    text-decoration: none;
    border-radius: 5px;
}

.button:hover {
    background-color: darkgreen;
}

.logout-section {
    margin-top: 20px;
}

/* Add more styles as needed */
</style>


