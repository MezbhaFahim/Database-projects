<!DOCTYPE html>
<html>
<head>
    <title>Edit Profile</title>
    <style type="text/css">
        .form-control {
            width: 250px;
            height: 38px;
            margin-bottom: 10px; /* Add space between input boxes */
        }

        .form {
            text-align: center;
        }

        .form1 {
            margin: 0 auto;
            width: 300px;
            padding-top: 20px;
        }

        label {
            color: black;
        }

        body {
            background-image: url(https://wallpaperaccess.com/full/2222765.jpg);
            
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            color: black;
        }

        .save-btn {
            width: 80px; /* Adjust the width as needed */
            padding: 8px; /* Adjust the padding as needed */
            background-color: #4CAF50; /* Green color */
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <?php
    // Include the database connection file
    require_once('DBconnect.php');

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $email = $_POST['email']; // Add this line to get the email
        $name = $_POST['name'];
        $biography = $_POST['biography'];
        $list_of_books = $_POST['list_of_books'];
        $social_media = $_POST['social_media'];

        // Prepare the update statement
        $update_query = $conn->prepare("UPDATE author_dashboard SET 
                             name = ?, 
                             biography = ?, 
                             lists_of_books = ?, 
                             social_media = ?
                             WHERE email = ?");

        // Bind parameters
        $update_query->bind_param("sssss", $name, $biography, $list_of_books, $social_media, $email);

        // Execute the update statement
        if ($update_query->execute()) {
            echo "Record updated successfully!";
        } else {
            echo "Error updating record: " . $update_query->error;
        }

        // Close the statement
        $update_query->close();
    }
    ?>
    <h2 style="text-align: center; color: black;">Edit Information</h2>
    <div class="form1">
        <form action="" method="post" enctype="multipart/form-data">
		    <label><h4><b>Email: </b></h4></label>
		    <input class="form-control" type="text" name="email">

            <label><h4><b>Name: </b></h4></label>
            <input class="form-control" type="text" name="name">

            <label><h4><b>Biography: </b></h4></label>
            <input class="form-control" type="text" name="biography">

            <label><h4><b>List of Books: </b></h4></label>
            <input class="form-control" type="text" name="list_of_books">

            <label><h4><b>Social Media: </b></h4></label>
            <input class="form-control" type="text" name="social_media">

            <br>
            <div>
                <button class="save-btn" type="submit" name="submit">Save</button>
            </div>
        </form>
    </div>
</body>
</html>
