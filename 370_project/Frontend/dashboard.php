<?php
session_start();
require_once('dbconnect.php');

// Delete functionality for admin_dashboard
if (isset($_POST['delete_admin'])) {
    $id_to_delete_admin = $_POST['delete_id_admin'];
    $delete_query_admin = "DELETE FROM admin_dashboard WHERE id = $id_to_delete_admin";
    mysqli_query($conn, $delete_query_admin);
}

// Delete functionality for author_dashboard
if (isset($_POST['delete_author'])) {
    $id_to_delete_author = $_POST['delete_id_author'];
    $delete_query_author = "DELETE FROM author_dashboard WHERE id = $id_to_delete_author";
    mysqli_query($conn, $delete_query_author);
}

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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Page</title>
    <link rel="stylesheet" href="dashboard.css">
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
                <?php
                while ($row = mysqli_fetch_assoc($result_admin)) {
                    ?>
                    <tr>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['biography']; ?></td>
                        <td><?php echo $row['list_of_books']; ?></td>
                        <td><?php echo $row['list_of_social_media']; ?></td>
                        <td>
                            <form method="POST" action="">
                                
                                <button type="submit" class="delete-btn" name="delete_admin">❌</button>
                            </form>
                        </td>
                    </tr>
                <?php
                }
                while ($row = mysqli_fetch_assoc($result_author)) {
                    ?>
                    <tr>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['biography']; ?></td>
                        <td><?php echo $row['list_of_books']; ?></td>
                        <td><?php echo $row['list_of_social_media']; ?></td>
                        <td>
                            <form method="POST" action="">
                                
                                <button type="submit" class="delete-btn" name="delete_author">❌</button>
                            </form>
                        </td>
                    </tr>
                <?php }
