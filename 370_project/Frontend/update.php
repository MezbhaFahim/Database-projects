<?php
session_start();
require_once('DBconnect.php');


// Check if the form fields are set and not empty
if (isset($_POST['reader_nid'])) {
    $nid = $_POST['reader_nid'];
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Reader Profile</title>
</head>
<body>
    <form action="update_reader_profile.php" method="post">
        <label for="reader_name">Change Name:</label>
        <input type="text" name="nname">
        <br>
        <label for="reader_mail">Change Email:</label>
        <input type="text" name="nmail">
        <br>
        <label for="reader_password">Change Password:</label>
        <input type="password" name="npass">
        <br>
        <input type="hidden" name="reader_nid" value="<?php echo $nid ?>">
        <input type="submit" value="Submit">
    </form>
</body>
</html>

<?php
require_once('dbConnect.php');

// Check if the input in the form textfields are not empty and update the database
if (isset($_POST['reader_name']) && (strlen($_POST['reader_name']) > 1)) {
    $name = $_POST['reader_name'];
    $nsql = "UPDATE reader SET reader_name ='$name' WHERE reader_nid='$nid'";
    $nresult = mysqli_query($conn, $nsql);
    echo "Name Successfully Changed <br>";
}

if (isset($_POST['reader_mail']) && (strlen($_POST['reader_mail']) > 1)) {
    $mail = $_POST['reader_nmail'];
    $msql = "UPDATE reader SET reader_mail ='$mail' WHERE reader_nid='$nid'";
    $mresult = mysqli_query($conn, $msql);
    echo "Email Successfully Changed <br>";
}

if (isset($_POST['reader_password']) && (strlen($_POST['reader_password']) > 1)) {
    if (strlen($_POST['npass']) >= 8) {
        $pass = $_POST['npass'];
        $psql = "UPDATE reader SET reader_password ='$pass' WHERE reader_nid='$nid'";
        $presult = mysqli_query($conn, $psql);
        echo "Password Successfully Changed <br>";
    } else {
        echo "Password must be at least 8 characters<br>";
    }
}
?>
