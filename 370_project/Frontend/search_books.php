<?php
session_start();
require_once('dbconnect.php');



if (isset($_POST['search'])) {
    $search_name = $_POST['search'];
    if (!empty($search_name)) {
        $search_query = "SELECT * FROM books WHERE book_name LIKE '%$search_name%'";
        $result_search = mysqli_query($conn, $search_query);
    }
}


// Fetch 
$fetch_query = "SELECT * FROM books";
if (isset($result_search)) {
    $result_books = $result_search; 
} else {
    $fetch_query_limit = "SELECT * FROM books LIMIT 10"; 
    $result_books = mysqli_query($conn, $fetch_query_limit); 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Books Page</title>
    <style>
         @import 'https://fonts.googleapis.com/css?family=Montserrat:300, 400, 700&display=swap';
       /* Add your CSS styles here */
body {
    font-family: 'Poppins', sans-serif;
    margin: 0;
    padding: 0;
    background-image: url(https://wallpaperaccess.com/full/3407952.png);
    background-size: cover;
    background-position: center;
    min-height: 100vh;
}

.dashboard-section {
    max-width: 800px;
    margin: 20px auto;
    padding: 20px;
    background-image: url(https://wallpaperaccess.com/full/3407952.png);
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
    background-image: url(https://wallpaperaccess.com/full/2222785.jpg);
    color: white
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
    
    background-image: url(https://wallpaperaccess.com/full/3407952.png);
    
}

.data-table td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
    background-image: url(https://wallpaperaccess.com/full/2222785.jpg);
    color: black; /* Black font color for table body */
   
}


    </style>
</head>
<body>
    <section class="dashboard-section">
        <h1>Books</h1>

        

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
                    <th>Publication Date</th>
                    
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
                        <td><?php echo $row['pub_date']; ?></td>
                        
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </section>
</body>
</html>
