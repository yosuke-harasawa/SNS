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
            h1{
                font-family: 'Knewave', cursive;
                color: white;
            }
        </style>
    </head>

    <body style="background-color: rgb(21, 32, 43);">
        <div class="container w-50 mx-auto mt-5">
            <h1 class=" text-center text-light font-weight-light">Login</h1>
            <form action="action.php" method="post">
                <input type="text" name="info" class="form-control mt-4" placeholder="E-mail or PhoneNumber" required>
                <input type="password" name="password" class="form-control mt-4" placeholder="Password" required>
                <button type="submit" name="login" class="btn btn-primary mt-4 ml-2 form-control" style="border-radius: 25px;">Login</button>
            </form>
        </div>
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>