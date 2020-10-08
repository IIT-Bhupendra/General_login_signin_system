<!-- <?php

    $signIn = false;
    // $showAlert = false;
    $showError = false;
    require 'partials/_dbconnect.php';
    
    session_start();
    if((!isset($_SESSION['forgot'])) || $_SESSION['forgot']!=true){
        header("location: forgot.php");
        exit; 
    }
    else if($_SERVER['REQUEST_METHOD']=="POST"){
        $newpassword = $_POST['password'];
        $cnewpassword = $_POST['cpassword'];
        $email = $_SESSION['email'];

        if($newpassword==$cnewpassword){
            $hash = password_hash($newpassword, PASSWORD_DEFAULT);
            $sql = "UPDATE `users_data` SET `Password` = '$hash' WHERE `users_data`.`Email` = '$email';";
            $result = mysqli_query($connect, $sql);
            if($result){
                // $showAlert = "Your password has been resetted successfully";
                $_SESSION['reset'] = true;
                header("location: reset_success.php");
            }
        else{
            $showError = "You haven't entered same passwords.";
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

    <title>iLearn: Password Reset</title>
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
        
        <div class="container my-5">
            <form action="/login_system/reset.php" method="POST">
                <div class="row my-3">
                    <div class="col">
                    <label for="password">New Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="New Password">
                </div>
                <div class="col">
                    <label for="cpassword">Confirm New Password</label>
                    <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Confirm New Password">
                    <small id="cpaswword" class="form-text text-muted">Be sure to type same password.</small>
                    </div>
                </div>
                <button type="submit" class="btn btn-success my-2">Reset Password</button>
            </form>
        </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  </body>
</html>