<?php
// Assuming you have a database connection established
require_once('dbConnect.php');

// Initialize variable
$books = [];

// Check if book name is provided in the URL
if (isset($_GET['book_query'])) {
    $search_query = $_GET['book_query'];
    // Fetch book by name (using LIKE for partial matches)
    $query = "SELECT * FROM books WHERE book_name LIKE '%$search_query%'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $books[] = $row;
        }
    }
} else {
    $query = "SELECT * FROM books"; // Update 'books' with your actual table name
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $books[] = $row;
        }
    }
}

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Book List</title>
    <style>
        /* Your existing CSS styles */
        /* ... */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="navigation">
        <!-- Navigation links -->
        <!-- ... -->
    </div>

    <div class="container">
        <!-- Search Bar -->
        <div class="search-bar">
            <form action="book.php" method="GET">
                <input type="text" name="book_query" placeholder="Search Books">
                <input type="submit" value="Search">
            </form>
        </div>

        <!-- Book List Table -->
        <div class="box">
            <?php if (!empty($books)) : ?>
                <h2>Book List</h2>
                <table>
                    <tr>
                        <th>Book ID</th>
                        <th>Book Name</th>
                        <th>Author</th>
                        <th>Genre</th>
                        <th>Links</th>
                        <th>Publication Date</th>
                        <th>Feedback</th> <!-- New column for Feedback link -->
                    </tr>
                    <?php foreach ($books as $book) : ?>
                        <tr>
                            <td><?php echo $book['b_id']; ?></td>
                            <td><?php echo $book['book_name']; ?></td>
                            <td><?php echo $book['a_name']; ?></td>
                            <td><?php echo $book['genre']; ?></td>
                            <td><a href="<?php echo $book['links']; ?>">Drive Link</a></td>
                            <td><?php echo $book['pub_date']; ?></td>
                            <!-- Link to feedback page for each book -->
                            <td><a href="refinal_feedback.php?book_id=<?php echo $book['b_id']; ?>">Leave Feedback</a></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php else : ?>
                <p>No books found.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
Write to Sabrina Riya
