<?php

    $showError = false;
    $signIn = false;
    // echo $_SERVER["REQUEST_METHOD"];
    if($_SERVER["REQUEST_METHOD"]=="POST"){
      
      require 'partials/_dbconnect.php';

            $email = $_POST['email'];
            $password = $_POST['password'];

            // $sql = "SELECT * FROM users_data WHERE Email='$email' AND Password='$password'";
            $sql = "SELECT * FROM users_data WHERE Email='$email'";
            $result = mysqli_query($connect, $sql);
            $num = mysqli_num_rows($result);
            $row = mysqli_fetch_assoc($result);

            //  session_start();
            //  $_SESSION['fname'] = $row['First Name']; 
            // if($row)  echo $_SESSION['fname'];
            // else echo "nothing";

            if($num == 1){
               while($row){
                 if(password_verify($password, $row['Password'])){
                   $signIn = true;
                   session_start();
                   $_SESSION['signedin'] = true;
                   $_SESSION['email'] = $email;
                   $_SESSION['fname'] = $row['First Name'];
                   $_SESSION['lname'] = $row['Last Name'];
                   header("location: welcome.php");                   
                 }
               }
            }
            else{
                $showError = "Invalid Credentials";
            }
        }
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <title>Sign In</title>
  </head>
  <body>
    <?php include 'partials/_nav.php';?>

    <div class="container my-5">
        <center><h1>Sign In To Our Website</h1></center>
        <form action="/login_system/signin.php" method="post">                        
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <button type="submit" class="btn btn-success">Sign In</button>
            <a class="btn btn-success" href="/login_system/forgot.php" role="button">Forgot Password</a>
        </form>
    </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  </body>
</html>