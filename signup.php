<?php

$showError = false;
$showAlert = false;
$signIn = false;
    if($_SERVER["REQUEST_METHOD"]=="POST"){
    
        require 'partials/_dbconnect.php';

        $lname = $_POST['lname'];
        $fname = $_POST['fname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];

        $existSql = "SELECT * FROM `users_data` WHERE Email='$email' OR Phone='$phone'";
        $result = mysqli_query($connect, $existSql);
        $numExistRows = mysqli_num_rows($result);
        if($numExistRows > 0){
            $showError = "There is already an account exist with this email address or Phone Number.";
        }
        else{
            if($password == $cpassword){
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $sql = "INSERT INTO `users_data` (`Sr.No.`, `First Name`, `Last Name`, `Email`, `Phone`, `Password`, `Date`) VALUES (NULL, '$fname', '$lname', '$email', '$phone', '$hash', current_timestamp());";
                $result = mysqli_query($connect, $sql);
                if($result){
                    $showAlert = "You have signed up successfully.";
                }
                else{
                    $showError = "Server Down, Please try again later.";
                }
            }
            else{
                $showError = "You haven't entered same passwords";
            }
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

    <title>Sign Up</title>
  </head>
  <body>
    <?php require 'partials/_nav.php';?>

    <?php
    if($showAlert){
        
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success! </strong>'.$showAlert.' 
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>';
    }
    if($showError){
        
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error! </strong>'.$showError.' 
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>';
    }
    ?>

    <div class="container my-5">
        <center><h1>Sign Up Here</h1></center>
        <form action="/login_system/signup.php" method="POST">
            <div class="row my-3">
                <div class="col">
                <label for="fname">First Name</label>
                <input type="text" class="form-control" id="fname" name="fname" placeholder="First name">
            </div>
            <div class="col">
                <label for="lname">Last Name</label>
                <input type="text" class="form-control" id="lname" name="lname" placeholder="Last name">
                </div>
            </div>
            <div class="row my-3">
                <div class="col">
                <label for="email">Email Address</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Email Address">
            </div>
            <div class="col">
                <label for="phone">Phone No.</label>
                <input type="number" class="form-control" id="phone" name="phone" placeholder="Phone Number">
                </div>
            </div>
            <div class="row my-3">
                <div class="col">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
            </div>
            <div class="col">
                <label for="cpassword">Confirm Password</label>
                <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Confirm Password">
                <small id="cpaswword" class="form-text text-muted">Be sure to type same password.</small>
                </div>
            </div>
            <div class="form-check">
                <input class="form-check-input is-invalid" type="checkbox" value="" id="invalidCheck3" aria-describedby="invalidCheck3Feedback" required>
                <label class="form-check-label" for="invalidCheck3">
                    Agree to terms and conditions
                </label>
                <div  id="invalidCheck3Feedback" class="invalid-feedback">
                    You must agree before submitting.
                </div>
            </div>
            <button type="submit" class="btn btn-success my-2">Sign Up</button>
        </form>
    </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  </body>
</html>