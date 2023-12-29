<?php
session_start();
require_once('dbConnect.php');

$user_id = isset($_SESSION['login_user']) ? $_SESSION['login_user'] : '';
$feedbackSubmitted = false;
$errorMsg = "";

function generateRandomCode2() {
    $randomNumber = mt_rand(0, 9999999);
    $paddedNumber = str_pad($randomNumber, 5, '0', STR_PAD_LEFT);
    $code = $paddedNumber;
    return $code;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fdbk = $_POST["comment"];
    $feedback = mysqli_real_escape_string($conn, $fdbk);

    // Check if 'login_user' key exists in the $_SESSION array
    if ($user_id !== '') {
        $maxAttempts = 10; // Limit the number of attempts to avoid an infinite loop
        $feedbackID = null;

        for ($i = 0; $i < $maxAttempts; $i++) {
            $feedbackID = generateRandomCode2(); // Assuming generateRandomCode2() returns a 7-digit number

            $checkUniqueSql = "SELECT feedback_id FROM feedback WHERE feedback_id = '$feedbackID'";
            $checkResult = mysqli_query($conn, $checkUniqueSql);

            if (mysqli_num_rows($checkResult) === 0) {
                break; // Exit the loop if the feedback ID is unique
            }
        }

        if ($feedbackID !== null) {
            $sql = "INSERT INTO feedback (feedback_id, feedback, user_id) VALUES ('$feedbackID', '$feedback', '$user_id')";

            if (mysqli_query($conn, $sql)) {
                $feedbackSubmitted = true;
            } else {
                $errorMsg = "Error submitting your feedback.";
            }
        } else {
            $errorMsg = "Error generating a unique feedback ID.";
        }
    } else {
        $errorMsg = "User not logged in.";
        // Redirect the user to the login page or handle the situation accordingly
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Feedback Page</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="description" content="Feedback Page"/>
    <meta name="author" content="Your Name"/>
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    
    <style>
        /* Add custom styles here */
        body {
            padding-top: 70px;
            background-color: #f7f7f7;
        }
        
        .feedback-form {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: lightcoral;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-top: 80px;
        }
        
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            resize: vertical;
        }
        
        input[type="submit"] {
            display: block;
            margin-top: 10px;
            padding: 10px 20px;
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="feedback-form">
            <h1>Submit Feedback</h1>
            <?php if ($feedbackSubmitted): ?>
                <p>Thank you for your feedback!</p>
            <?php endif; ?>
            <?php if (!empty($errorMsg)): ?>
                <p class="error-msg"><?php echo $errorMsg; ?></p>
            <?php endif; ?>
            <form action="" method="post">
                <textarea name="comment" rows="5" placeholder="Enter your feedback here"></textarea><br>
                <input type="submit" name="submit" value="Submit">
            </form>
        </div>
    </div>
</body>
</html>
