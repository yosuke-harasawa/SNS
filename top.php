<?php
include 'classes/SNS.php';
    if(!empty($_SESSION['login_id'])){
        header('location:home.php');
    }
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
        <link href="https://fonts.googleapis.com/css?family=Knewave&display=swap" rel="stylesheet">
        <style>
            .top-img{
                background-image: url(img/pop.jpg);
                background-repeat: no-repeat;
                background-size: cover;
                height: 800px;
                width: 100%;
            }
            h1{
                font-family: 'Knewave', cursive;
                color: white;
            }
        </style>
    </head>

    <body style="background-color: rgb(20, 32, 42);">
        <div class="top-img w-50 float-left">
            
        </div>

        <div class="w-50 float-right">
            <h1 class="text-center display-3 mt-5">What's up?!</h1>
            <div class="form-group w-50 mx-auto mt-5">
                <form action="" method="post">
                    <a href="register.php" name="register" class="btn btn-primary form-control" style="border-radius: 25px;">Register</a>

                    <a href='login.php' name="login" class="btn btn-outline-primary form-control mt-3" style="border-radius: 25px;">Login</a>
                </form>
            </div>
        </div>
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>