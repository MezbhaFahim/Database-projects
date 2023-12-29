<?php
session_start();
require_once('DBconnect.php');


// Fetch the reader's information from the database
$sql = "SELECT reader_name, reader_email, reader_nid FROM reader";

$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $reader_data = mysqli_fetch_assoc($result);
    $reader_name = isset($reader_data['reader_name']) ? $reader_data['reader_name'] : '';
    $reader_email = isset($reader_data['reader_email']) ? $reader_data['reader_email'] : '';
    $reader_nid = isset($reader_data['reader_nid']) ? $reader_data['reader_nid'] : '';
} else {
    $reader_name = 'N/A';
    $reader_email = 'N/A';
    $reader_nid = 'N/A';
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Online Library</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url(https://img6.thuthuatphanmem.vn/uploads/2022/04/15/anh-nen-ke-sach-anime_022003561.jpg);
            margin: 0;
            padding: 0;
        }

        .container {
            width: 60%;
            margin: 50px auto;
            background-image: url(https://img6.thuthuatphanmem.vn/uploads/2022/04/15/anh-nen-ke-sach-anime_022003561.jpg);
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h2 {
            color: #333;
        }

        .navigation {
            background-image: url(https://img6.thuthuatphanmem.vn/uploads/2022/04/15/anh-nen-ke-sach-anime_022003561.jpg);
            overflow: hidden;
            text-align: center;
        }

        .navigation a {
            display: inline-block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            font-weight: bold;
            margin: 0 10px;
        }

        .navigation a:hover {
            background-image: url(https://img6.thuthuatphanmem.vn/uploads/2022/04/15/anh-nen-ke-sach-anime_022003561.jpg);
            color: black;
        }

        table {
            margin: 20px auto;
        }

        th, td {
            padding: 10px;
            text-align: center;
            border-bottom: 1px solid #ddd;
            font-weight: bold; /* Make text bold */
        }

        th {
            background-image: url(https://img6.thuthuatphanmem.vn/uploads/2022/04/15/anh-nen-ke-sach-anime_022003561.jpg);
        }

        .box {
            background-image: url(https://img6.thuthuatphanmem.vn/uploads/2022/04/15/anh-nen-ke-sach-anime_022003561.jpg);
            margin-top: 20px;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="navigation">
        <a href="#">Heiwa | your New Online Library </a>
        <a href="reader_book.php">Books</a>
        <a href="update.php">Edit Your Profile</a>
        <a href="rating.php">Rating</a>
        <a href="refinal_feedback.php">Feedback</a>
        <a href="logout.php">Logout</a>
    </div>

    <div class="container">
        <h2>Welcome, <?php echo $reader_name; ?></h2>

        <div class="box">
            <!-- Profile Display -->
            <table>
                <tr>
                    <th>Reader Name</th>
                    <td><?php echo $reader_name; ?></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><?php echo $reader_email; ?></td>
                </tr>
                <tr>
                    <th>NID</th>
                    <td><?php echo $reader_nid; ?></td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>
