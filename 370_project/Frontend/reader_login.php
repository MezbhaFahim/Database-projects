
<?php
session_start();
require_once('DBconnect.php');

//http://localhost:8080/CSE370_PROJECT/admin_login.php

// to check if the input are not empty
if(isset($_POST['email']) && isset($_POST['password'])){
    echo "LET HIM ENTER";
	//to check  username and password exists
	$e = $_POST['email'];
	$p = $_POST['password'];
	$sql = "SELECT * FROM reader WHERE reader_email = '$e' AND reader_password = '$p'";
	
	//Execute the query 
	$result = mysqli_query($conn, $sql);
	//$row = mysqli_fetch_array($result,MYSQL_ASSOC);
	//check if it returns an empty set
	if(mysqli_num_rows($result) !=0 ){
        if (!isset($_SESSION['email'])) {
            // Redirect 
            
            header("Location: reader_login.php");
        }
        
        // Retrieve information
        $email = $_SESSION['email'];
        
	
		//echo "LET HIM ENTER";
		header("Location: reader_profile1.php");
	}
	else{
		//echo "Username or Password is wrong";
		header("Location: reader_login.php");
	}
	
}


?>



<!DOCTYPE html>
<html>
    <head>
        <title>Virtual Library Login</title>
        
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
        <form action="reader_login.php" method="post">
            <h1>Reader Login</h1>
            <div class="inputbox">
                <ion-icon name="email"></ion-icon>
                <input type="email" name="email" required>
                <label>Email</label>
            </div>
            <div class="inputbox">
                <ion-icon name="password"></ion-icon>
                <input type="password" name="password" required>
                <label>Password</label>
            </div>
            <button type="submit">Log in</button>
            <div class="register">
              <p>Create new account <a href="http://localhost/HEIWA/reader_signup.php">Sign Up</a></p>
          </div>
        </form>
    </section>
</body>
</html>