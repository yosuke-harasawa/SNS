<?php
    // include 'classes/SNS.php';

    // if(isset($_POST['register'])){
    //     $uname = $_POST['username'];
    //     $phone_num = $_POST['phone_number'];
    //     $email = $_POST['email'];
    //     $pword = $_POST['password'];
    //     $confirm_pword = $_POST['confirm_password'];

    //     if($pword == $confirm_pword){
    //         $SNS->register($uname,$phone_num,$email,$pword);
    //     }else{
    //         $error_mssage = "* Confirm Password is wrong!!";
    //     }
    // }
?>
<!doctype html>
<html lang="en">
    <head>
        <title>Title</title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>

    <body>
        <div class="container w-50 mx-auto mt-5">
            <h1 class="text-center font-weight-lighter">Register</h1>

            <div class="card">
                <div class="card-body">
                    <form action="action.php" method="post">
                        <label for="">Username</label>
                        <input type="text" name="username" class="form-control" required>
                        <label for="">Phone Number</label>
                        <input type="text" name="phone_number" class="form-control" required>
                        <label for="">E-mail</label>
                        <input type="text" name="email" class="form-control" required>
                        <label for="">Password</label>
                        <input type="password" name="password" class="form-control" required placeholder="Please enter more than 7 letters, and combine Alphabet and Number">
                        <label for="">Confirm Password</label>
                        <input type="password" name="confirm_password" class="form-control" required placeholder="Please enter same Password above">
                        <br>
                        <button type="submit" name="register" class="btn btn-primary float-right">Register</button>
                    </form>
                </div>
            </div>
        </div>
      

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>
