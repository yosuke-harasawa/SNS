<?php
    include 'classes/SNS.php';
    if(empty($_SESSION['login_id'])){
        header('location:top.php');
    }
    $SNS = new SNS;
    $current_login_id = $_SESSION['login_id'];
    $current_user = $SNS->getCurrentUser($current_login_id);
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
        <script src="https://kit.fontawesome.com/eb83b1af77.js" crossorigin="anonymous"></script>
        <link href="https://fonts.googleapis.com/css?family=Knewave&display=swap" rel="stylesheet">

        <style>
            .side-bar{
                position: fixed;
            }
            h1.icon{
                font-family: 'Knewave', cursive;
                color: white;
            }
        </style>
    </head>

    <body>
        <div class="side-bar col-3">
            <h1 class="icon display-5 mb-3">What's up?!</h1>
            <!-- <i class="twitter-icon fab fa-twitter fa-3x"></i> -->
            <form action="action.php" method="post">
                <div class="input-group my-2" style="border-radius: 25px;">
                    <input type="text" name="search_info" class="form-control" placeholder="Search">
                    <div class="input-group-append">
                        <button type="submit" name="search" class="btn input-group-text"><i class="fas fa-search fa-lg"></i></button>
                    </div>
                </div>
            </form>
            <a href="home.php" class="btn btn-outline-light form-control my-2" style="border-radius: 25px;">
                <i class="fas fa-home fa-lg"></i> Home
            </a>
            <a href="notification.php" class="btn btn-outline-light form-control my-2" style="border-radius: 25px;">
            <i class="far fa-bell fa-lg"></i> Notification
            </a>
            <a href="" class="btn btn-outline-light form-control my-2" style="border-radius: 25px;">
                <i class="far fa-envelope fa-lg"></i> Message
            </a>
            <a href="" class="btn btn-outline-light form-control my-2" style="border-radius: 25px;">
                <i class="far fa-bookmark fa-lg"></i> Bookmarks
            </a>
            <a href="my_profile.php" class="btn btn-outline-light form-control my-2" style="border-radius: 25px;">
                <i class="far fa-user-circle fa-lg"></i> Profile
            </a>
            <a href="setting.php" class="btn btn-outline-light form-control my-2" style="border-radius: 25px;">
                <i class="fas fa-cog fa-lg"></i> Settings
            </a>
            <a href="logout.php" class="btn btn-outline-light form-control my-2" style="border-radius: 25px;">
                <i class="fas fa-key fa-lg"></i> Logout
            </a>
            <hr>

            <!-- Button trigger New Post modal -->
            <button type="button" class="btn btn-primary form-control" data-toggle="modal" data-target="#postModal" style="border-radius: 25px;">
                 New Post
            </button>
        </div>
            <!-- New Post Modal -->
            <div class="modal fade" id="postModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content" style="background-color: rgb(21, 32, 43);">
                        <div class="modal-header" style="border-color: rgb(55, 68, 76);">
                            <h5 class="modal-title text-light" id="exampleModalLabel" >What's up?!</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <?php if(!empty($current_user['icon'])){ ?>
                                <img src="uploads/<?php echo $current_user['icon']; ?>" alt="" class="rounded-circle" style="width:50px; height:50px;">
                            <?php }else{ ?>
                                <img src="img/user_icon.png" alt="" class="rounded-circle" style="width:50px; height:50px;">
                            <?php } ?>
                            <form action="action.php" method="post" enctype="multipart/form-data">
                                <textarea name="text" id="" cols="14" rows="10" class="form-control mt-2" placeholder="What's up?!"></textarea>
                                <input type="file" name="picture" class="mt-3" style="color: lightslategrey;">
                                <br>
                                <button type="submit" name="add_post" class="btn btn-primary float-right" style="border-radius: 25px;">Post</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    <body>
      
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>