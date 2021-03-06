<?php

    $signIn = false;
    $showError = false;
    require 'partials/_dbconnect.php';
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        
        $sql = "SELECT * FROM users_data WHERE Email='$email' AND Phone='$phone'";
        $result = mysqli_query($connect, $sql);
        $num = mysqli_num_rows($result);
        if($num){
            session_start();
            $_SESSION['forgot'] = true;
            $_SESSION['email'] = $email;
            header("location: reset.php");
        }
        else{
            $showError = "Invalid Credentials, Try with those credentials which you have registered with us.";
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

    <title>Forgot Password</title>
  </head>
  <body>
    <?php include 'partials/_nav.php';?>

    <?php
        if($showError){
        
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error! </strong>'.$showError.' 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>';
        }
    ?>

    <div class="container my-3">
        <center><h1>Reset Your Password Here</h1></center>
            <form action="/login_system/forgot.php" method="post">                        
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email Address" aria-describedby="emailHelp">
                </div>
                <div class="form-group">
                    <label for="phone">Phone No.</label>
                    <input type="number" class="form-control" id="phone" name="phone" placeholder="Phone Number">
                </div>
                <button type="submit" class="btn btn-success">Proceed</button>
            </form>            
        </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  </body>
</html>