<!doctype html>
<html lang="en">
    <head>
        <title>Title</title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <style>
        .follower_list{
            position: relative;
            left: 360px;
        }
        </style>
  </head>

    <body>
        <div class="container-fluid mt-3">
            <div class="row">
                <?php include 'user_menu.php'; ?>

                <div class="follower_list col-lg-6">
                    <?php 
                        $follower_list = $SNS->displayFollower($_GET['user_id']);
                        foreach($follower_list as $row):
                    ?>
                        <div class="card my-2">
                            <div class="card-header border-bottom-0">
                                <div class="float-left">
                                <?php if($row['user_id'] == $current_login_id){ ?>
                                        <a href="my_profile.php">
                                            <img src="uploads/<?php echo $row['icon'] ?>" alt="" class="rounded-circle mr-2" style="width: 50px; height: 50px;">
                                        </a>
                                        <a href="my_profile.php">
                                            <?php echo $row['username'] ?>
                                        </a>
                                    <?php }else{ ?>
                                        <a href="others_profile.php?user_id=<?php echo $row['user_id'] ?>">
                                            <img src="uploads/<?php echo $row['icon'] ?>" alt="" class="rounded-circle mr-2" style="width: 50px; height: 50px;">
                                        </a>
                                        <a href="others_profile.php?user_id=<?php echo $row['user_id'] ?>">
                                            <?php echo $row['username'] ?>
                                        </a>
                                    <?php } ?>
                                </div>

                                <?php
                                    $random_user_id = $row['user_id'];
                                    $rs = $SNS->validateUserRelationship($_SESSION['login_id'],$random_user_id);
                                    if($rs == 'follow'){
                                ?>  <div class="float-right">
                                        <form action="action.php" method="post">
                                            <input type="hidden" name="followed_user_id" value="<?php echo $row['user_id'] ?>">
                                            <input type="hidden" name="user_id" value="<?php echo $_SESSION['login_id'] ?>">
                                            <button type="submit" name="follow_in_myfollower_list" class="btn btn-outline-primary" style="border-radius: 25px;">Follow</button>
                                        </form>
                                    </div>
                                <?php }elseif($rs == 'unfollow'){ ?>
                                    <div class="float-right">
                                        <form action="action.php" method="post">
                                            <input type="hidden" name="followed_user_id" value="<?php echo $row['user_id'] ?>">
                                            <input type="hidden" name="user_id" value="<?php echo $_SESSION['login_id'] ?>">
                                            <button type="submit" name="unfollow_in_myfollower_list" class="btn btn-outline-primary" style="border-radius: 25px;">Unfollow</button>
                                        </form>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    <?php endforeach ?>
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