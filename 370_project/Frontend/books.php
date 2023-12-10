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

// Deletion logic for book data
if (isset($_POST['delete'])) {
    $delete_id = $_POST['delete_id']; // Get the unique ID of the row to be deleted
    $delete_query = "DELETE FROM books WHERE b_id = '$delete_id'";
    mysqli_query($conn, $delete_query);
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
                <input type="text" name="links" placeholder="Links"> <!-- New input for Links -->
                <input type="text" name="publication_date" placeholder="Publication Date">
                <!-- Add Button for Inputs -->
                <button type="submit" name="add" class="add-btn">Add</button>
            </div>
        </form>

        <!-- Search Bar -->
        <form method="POST" action="">
            <input type="text" name="search" class="search-bar" placeholder="Search">
            <!-- Done Button for Search -->
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
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- Display all books from the database -->
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
                        <!-- Delete button -->
                        <td>
                            <form method="POST" action="">
                                <input type="hidden" name="delete_id" value="<?php echo $row['b_id']; ?>">
                                <button type="submit" class="delete-btn" name="delete">❌</button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </section>
</body>
</html>
