<?php
session_start();
require_once('dbconnect.php');

// Add data to the books table
if (isset($_POST['add'])) {
    $book_name = $_POST['book_name'];
    $author_name = $_POST['author_name'];
    $genre = $_POST['genre'];
    $publication_date = $_POST['publication_date'];
    $links = $_POST['links']; // New input for Links

    // Check if the entry already exists based on the book name
    $check_query = "SELECT * FROM books WHERE book_name = '$book_name'";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) === 0) {
        // If the entry doesn't exist, insert it into the books table
        $insert_query = "INSERT INTO books (book_name, a_name, genre, links, pub_date) VALUES ('$book_name', '$author_name', '$genre', '$links', '$publication_date')";
        mysqli_query($conn, $insert_query);
    } else {
        // Handle the case where the entry already exists
        echo "Entry already exists for this book name.";
    }
}

// Search functionality for book names
if (isset($_POST['search'])) {
    $search_name = $_POST['search'];
    if (!empty($search_name)) {
        $search_query = "SELECT * FROM books WHERE book_name LIKE '%$search_name%'";
        $result_search = mysqli_query($conn, $search_query);
    }
}


// Fetch all books from the database
$fetch_query = "SELECT * FROM books";
if (isset($result_search)) {
    $result_books = $result_search; // Use search results if available
} else {
    $fetch_query_limit = "SELECT * FROM books LIMIT 10"; // Query to fetch 10 rows
    $result_books = mysqli_query($conn, $fetch_query_limit); // Fetch 10 rows if no search
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Books Page</title>
    <link rel="stylesheet" href="dashboard.css">
	<style type="text/css">
        body {
            background-image: url('picture.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
        }

        .dashboard-section {
            width: 80%;
            margin: auto;
            background: rgba(255, 255, 255, 0.5); /* 50% transparent white background */
            padding: 20px;
            border-radius: 10px; /* Add border-radius for rounded corners */
            margin-top: 20px;
            color: #333; /* Set text color */
        }

        .input-box {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .input-box input {
            width: 48%;
            margin-bottom: 10px;
        }

        .search-bar {
            width: 80%;
            margin-bottom: 10px;
        }

        .add-btn,
        .search-done-btn {
            width: 48%;
            padding: 8px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .data-table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        .data-table th, .data-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        /* Add any additional styles you need */
    </style>
</head>
<body>
    <section class="dashboard-section">
        <h1>Books</h1>

        <!-- Input Box for ID, Book Name, Author Name, Genre, Publication Date, and Links -->
        <form method="POST" action="">
            <div class="input-box">
                <input type="text" name="book_name" placeholder="Book Name">
                <input type="text" name="author_name" placeholder="Author Name">
                <input type="text" name="genre" placeholder="Genre">
                <input type="text" name="links" placeholder="Links">
                <input type="text" name="publication_date" placeholder="Publication Date">
                <button type="submit" name="add" class="add-btn">Add</button>
            </div>
        </form>

        <!-- Search Bar -->
        <form method="POST" action="">
            <input type="text" name="search" class="search-bar" placeholder="Search">
            <button type="submit" class="search-done-btn">Done</button>
        </form>

        <!-- Data Table -->
        <table class="data-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Book Name</th>
                    <th>Author Name</th>
                    <th>Genre</th>
                    <th>Links</th>
                    <th>Publication Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($result_books)) { ?>
                    <tr>
                        <td><?php echo $row['b_id']; ?></td>
                        <td><?php echo $row['book_name']; ?></td>
                        <td><?php echo $row['a_name']; ?></td>
                        <td><?php echo $row['genre']; ?></td>
                        <td>
                            <?php $links = $row['links'];
                            $linkArray = explode(",", $links);
                            foreach ($linkArray as $link) {
                                echo '<a href="' . $link . '">' . $link . '</a><br>';
                            } ?>
                        </td>
                        <td><?php echo $row['pub_date']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </section>
</body>
</html>