<?php
session_start();
require_once('dbconnect.php');

// Search functionality for both admin_dashboard and author_dashboard
if (isset($_POST['search'])) {
    $search_name = $_POST['search'];
    if (!empty($search_name)) {
        $search_query_admin = "SELECT * FROM admin_dashboard WHERE name LIKE '%$search_name%'";
        $search_query_author = "SELECT * FROM author_dashboard WHERE name LIKE '%$search_name%'";
        $result_admin = mysqli_query($conn, $search_query_admin);
        $result_author = mysqli_query($conn, $search_query_author);
    } else {
        $fetch_query_admin = "SELECT * FROM admin_dashboard";
        $fetch_query_author = "SELECT * FROM author_dashboard";
        $result_admin = mysqli_query($conn, $fetch_query_admin);
        $result_author = mysqli_query($conn, $fetch_query_author);
    }
} else {
    // Fetch all data from both tables by default
    $fetch_query_admin = "SELECT * FROM admin_dashboard";
    $fetch_query_author = "SELECT * FROM author_dashboard";
    $result_admin = mysqli_query($conn, $fetch_query_admin);
    $result_author = mysqli_query($conn, $fetch_query_author);
}

// Adding data functionality
if (isset($_POST['add_data'])) {
    $name = $_POST['name'];
    $biography = $_POST['biography'];
    $list_of_books = $_POST['list_of_books'];
    $list_of_social_media = $_POST['social_media'];

    // Check if the entry already exists based on the name
    $check_query = "SELECT * FROM admin_dashboard WHERE name = '$name'";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) === 0) {
        // If the entry doesn't exist, insert it into the admin_dashboard table
        $insert_query_admin = "INSERT INTO admin_dashboard (name, biography, list_of_books, list_of_social_media) VALUES ('$name', '$biography', '$list_of_books', '$list_of_social_media')";
        mysqli_query($conn, $insert_query_admin);
    } else {
        // Handle the case where the entry already exists (you can show a message or perform any other action)
        echo "Entry already exists for this name.";
    }
}

// Deletion logic for admin data
if (isset($_POST['delete_admin'])) {
    $delete_name = $_POST['delete_admin_name']; // Get the unique name of the row to be deleted
    $delete_query_admin = "DELETE FROM admin_dashboard WHERE name = '$delete_name'";
    mysqli_query($conn, $delete_query_admin);
}

// Deletion logic for author data
if (isset($_POST['delete_author'])) {
    $delete_name = $_POST['delete_author_name']; // Get the unique name of the row to be deleted
    $delete_query_author = "DELETE FROM author_dashboard WHERE name = '$delete_name'";
    mysqli_query($conn, $delete_query_author);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Page</title>
    <style>
        /* Add your CSS styles here */
body {
    font-family: 'Poppins', sans-serif;
    margin: 0;
    padding: 0;
    background-image: url(https://wallpaperaccess.com/full/2222765.jpg);
    background-size: cover;
    background-position: center;
    min-height: 100vh;
}

.dashboard-section {
    max-width: 800px;
    margin: 20px auto;
    padding: 20px;
    background-color: rgba(255, 255, 255, 0.5); /* Adjust opacity here */
    border: 1px solid #ddd;
    font-family: 'Poppins', sans-serif;
    position: relative;
    backdrop-filter: blur(10px); /* Glass-like effect */
    border-radius: 20px;
    text-align: center;
}

h1 {
    text-align: center;
    color: black;
    font-size: 3rem; /* Larger size for "Dashboard" */
    margin-bottom: 20px;
}

.input-box {
    margin-bottom: 20px;
}

.input-box input,
.input-box textarea {
    display: block;
    width: 100%;
    margin-bottom: 10px;
    padding: 8px;
    font-family: 'Poppins', sans-serif;
}

.done-btn {
    display: inline-block;
    padding: 5px 15px; /* Smaller button */
    background-color: #4CAF50;
    color: white;
    border: none;
    cursor: pointer;
    font-family: 'Poppins', sans-serif;
    margin-top: 20px;
}

.search-bar {
    width: 50%;
    padding: 10px;
    box-sizing: border-box;
    margin-bottom: 20px;
    font-family: 'Poppins', sans-serif;
}

.data-table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 50px;
}

.data-table th {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
    color: white;
    background-color: #007bff; /* Blue color for table header */
    font-family: 'Poppins', sans-serif;
}

.data-table td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
    color: black; /* Black font color for table body */
    font-family: 'Poppins', sans-serif;
}

.delete-btn {
    background: none;
    border: none;
    color: red;
    cursor: pointer;
    font-family: 'Poppins', sans-serif;
}

    </style>
</head>

<body>
    <section class="dashboard-section">
        <h1>Dashboard</h1>

        <!-- Input Box for Name, Biography, List of Books, Social Media -->
        <form method="POST" action="">
            <div class="input-box">
                <input type="text" name="name" placeholder="Name">
                <textarea name="biography" placeholder="Biography"></textarea>
                <input type="text" name="list_of_books" placeholder="List of Books">
                <input type="text" name="social_media" placeholder="Social Media">
                <!-- Done Button for Inputs -->
                <button type="submit" name="add_data" class="done-btn">Add Data</button>
            </div>
        </form>

        <!-- Search Bar -->
        <form method="POST" action="">
            <input type="text" name="search" class="search-bar" placeholder="Search by Name">
            <!-- Done Button for Search -->
            <button type="submit" name="search_btn" class="search-done-btn">Go</button>
        </form>

        <!-- Combined Data Table -->
        <h2>Combined Dashboard</h2>
        <table class="data-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Biography</th>
                    <th>List of Books</th>
                    <th>Social Media</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- Display data from admin_dashboard -->
                <?php while ($row = mysqli_fetch_assoc($result_admin)) { ?>
                    <tr>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['biography']; ?></td>
                        <td><?php echo $row['list_of_books']; ?></td>
                        <td><?php echo $row['list_of_social_media']; ?></td>
                        <td>
                            <form method="POST" action="">
                                <input type="hidden" name="delete_admin_name" value="<?php echo $row['name']; ?>">
                                <button type="submit" class="delete-btn" name="delete_admin">❌</button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>

                <!-- Display data from author_dashboard -->
                <?php while ($row = mysqli_fetch_assoc($result_author)) { ?>
                    <tr>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['biography']; ?></td>
                        <td><?php echo $row['lists_of_books']; ?></td>
                        <td><?php echo $row['social_media']; ?></td>
                        <td>
                            <form method="POST" action="">
                                <input type="hidden" name="delete_author_name" value="<?php echo $row['name']; ?>">
                                <button type="submit" class="delete-btn" name="delete_author">❌</button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </section>
</body>

</html>
