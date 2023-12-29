<?php
session_start();
require_once('DBconnect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $name = $_POST["reader_name"];
    $email = $_POST["reader_email"];
    $password = $_POST["reader_password"];
    $confirmPassword = $_POST["confirmPassword"];

    if ($password !== $confirmPassword) {
        $error_message = "Error: Password and Confirm Password do not match.";
    } else {
        $email_query = "SELECT * FROM author_dashboard WHERE email = '$email'";
        $email_result = $conn->query($email_query);

        if ($email_result->num_rows > 0) {
            $error_message = "Error: Email already exists. Please use a different one.";
        } else {
            $insert_author_sql = "INSERT INTO author_dashboard (name, email, password) 
                                  VALUES ('$name', '$email', '$password')";
            if ($conn->query($insert_author_sql) === TRUE) {
                // Redirect 
                header("Location: author_dashboard.php");
                exit();
            } else {
                $error_message = "Error inserting user info: " . $conn->error;
            }
        }
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Welcome</title>
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap');

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'poppins',sans-serif;
}

body {
  display: flex;
  align-items: center;
  justify-content: center;
  min-height: 100vh;
  background-image: url(https://r4.wallpaperflare.com/wallpaper/599/667/668/anime-landscape-library-nature-hd-wallpaper-f8964df890800c28607c410ea802a41a.jpg);
  
  background-repeat: no-repeat;
  background-position: center;
  background-size: cover;
}

section {
    position: relative;
    max-width: 400px;
    background-color: transparent;
    border: 2px solid rgba(255, 255, 255, 0.5);
    border-radius: 20px;
    backdrop-filter: blur(55px);
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 2rem 3rem;
}

h1 {
    font-size: 2rem;
    color: #fff;
    text-align: center;
}

.inputbox {
    position: relative;
    margin: 30px 0;
    max-width: 310px;
    border-bottom: 2px solid #fff;
}

.inputbox label {
    position: absolute;
    top: 50%;
    left: 5px;
    transform: translateY(-50%);
    color: #fff;
    font-size: 1rem;
    pointer-events: none;
    transition: all 0.5s ease-in-out;
}

input:focus ~ label, 
input:valid ~ label {
    top: -5px;
}

.inputbox input {
    width: 100%;
    height: 60px;
    background: transparent;
    border: none;
    outline: none;
    font-size: 1rem;
    padding: 0 35px 0 5px;
    color: #fff;
}

.inputbox ion-icon {
    position: absolute;
    right: 8px;
    color: #fff;
    font-size: 1.2rem;
    top: 20px;
}

.forget {
    margin: 35px 0;
    font-size: 0.85rem;
    color: #fff;
    display: flex;
    justify-content: space-between;
 
}

.forget label {
    display: flex;
    align-items: center;
}

.forget label input {
    margin-right: 3px;
}

.forget a {
    color: #fff;
    text-decoration: none;
    font-weight: 600;
}

.forget a:hover {
    text-decoration: underline;
}

button {
    width: 100%;
    height: 40px;
    border-radius: 40px;
    background-color: rgb(255, 255,255, 1);
    border: none;
    outline: none;
    cursor: pointer;
    font-size: 1rem;
    font-weight: 600;
    transition: all 0.4s ease;
}

button:hover {
  background-color: rgb(255, 255,255, 0.5);
}

.register {
    font-size: 0.9rem;
    color: #fff;
    text-align: center;
    margin: 25px 0 10px;
}

.register p a {
    text-decoration: none;
    color: #fff;
    font-weight: 600;
}

.register p a:hover {
    text-decoration: underline;
}
        </style>
        
       
    </head>

    <body>
<section>
    <form method="post" action="author_signup.php">
        <h1>Author Sign Up</h1>

        
        <?php
                // Display error message if set
                if (isset($error_message)) {
                    echo '<div style="color: red;">' . $error_message . '</div>';
                }
                ?>

                <div class="inputbox">
                    <ion-icon name="mail-outline"></ion-icon>
                    <input type="text" name="reader_name" required>
                    <label for="">Name</label>
                </div>

                <div class="inputbox">
                    <ion-icon name="mail-outline"></ion-icon>
                    <input type="email" name="reader_email" required>
                    <label for="">Email</label>
                </div>

                <div class="inputbox">
                    <ion-icon name="lock-closed-outline"></ion-icon>
                    <input type="password" name="reader_password" required>
                    <label for="">Password</label>
                </div>

                <div class="inputbox">
                    <ion-icon name="lock-closed-outline"></ion-icon>
                    <input type="password" name="confirmPassword" required>
                    <label for="">Confirm Password</label>
                </div>

                <button type="submit">Sign Up</button>

                <div class="register">
                    <p>Already have an Account? <a href="http://localhost/HEIWA/author_login.php">Log In</a></p>
                </div>
            </form>
        </section>
    </body>
</html>