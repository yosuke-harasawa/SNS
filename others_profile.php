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

        <style>
            .view-other-profile{
                position: relative;
                left: 360px;
            }
        </style>
    </head>

    <body>
        <div class="container-fluid mt-3">
            <div class="row">
                <?php include 'user_menu.php'; ?>

                <div class="view-other-profile col-lg-6">
                    <?php 
                        $user_id = $_GET['user_id'];
                        $other_user = $SNS->getOtherUser($user_id);
                        
                        if(!empty($other_user['icon'])){
                        $img = $other_user['icon'];
                    ?>
                        <img src="<?php echo "uploads/$img"; ?>" style='width:150px; height:150px;' class="rounded-circle">
                    <?php }else{ ?>
                        <img src='img/user_icon.png' style='width:150px; height:150px;' class='rounded-circle'>
                    <?php } ?>
                    <br>
                    Username: <?php echo $other_user['username']; ?>
                    <br>
                    Bio: <?php echo $other_user['bio']; ?>
                    <br>
                    Location: <?php echo $other_user['location']; ?>
                    <br>
                    Folowing: 
                    <br>
                    Follwer: 
                    <br>
                    <hr>

                    <?php 
                        $others_postlist = $SNS->displayOthersPosts($user_id);
                        foreach($others_postlist as $row):
                    ?>
                        <div class="card w-100 mt-3">
                            <div class="card-header">
                                <?php
                                    if(!empty($row['icon'])): 
                                        $icon = $row['icon'];
                                ?>
                                    <img src="uploads/<?php echo "$icon"; ?>" style='width:50px; height:50px;' class="rounded-circle mr-2">
                                <?php endif; ?>
                                
                                <?php echo $row['username']; ?>
                            </div>

                            <div class="card-body">
                                <?php echo $row['text']; ?>
                                <br>
                                <?php if(!empty($row['picture'])): 
                                    $img = $row['picture'];
                                ?>
                                    <div class="card mt-2" style="border: 0;">
                                        <img src="uploads/<?php echo $img; ?>" alt="" class="w-100 h-100" style="border-radius: 25px;">
                                    </div>
                                <?php endif; ?>

                                <!-- SNS BUTTONS -->
                                <div class="mt-2">
                                    <!-- Button trigger comment modal -->
                                    <button type="button" class="btn" data-toggle="modal" data-target="#exampleModal">
                                        <i class="far fa-comment-alt fa-lg"></i>
                                    </button>
                                    <!-- Comment Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <img src="uploads/<?php echo $current_user['icon']; ?>" alt="" class="rounded-circle mr-2" style="width: 50px; height: 50px;">
                                                    <form action="action.php" method="post" enctype="multipart/form-data">
                                                        <textarea name="comment" id="" cols="14" rows="10" class="form-control mt-2" placeholder="Input your reply"></textarea>
                                                        <input type="file" name="picture">
                                                        <br>
                                                        <button type="submit" name="reply" class="btn btn-info float-right mt-2">Reply</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <button name="retweet" class="btn"><i class="fas fa-retweet fa-lg"></i></button>
                                    <button name="like" class="btn"><i class="far fa-heart fa-lg"></i></button>
                                    <button name="send" class="btn"><i class="far fa-share-square fa-lg"></i></button>
                                    <button name="bookmark" class="btn"><i class="far fa-bookmark fa-lg"></i></button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
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