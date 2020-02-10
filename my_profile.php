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
        .view_profile{
            position: relative;
            left: 360px;
        }

        .profile_icon:hover{
            opacity: 0.9;
        }
    </style>

  </head>

  <body>
      <div class="container-fluid mt-3">
          <div class="row">
                <?php include 'user_menu.php'; ?>

                <div class="view_profile col-lg-6">
                    <?php if(!empty($current_user['icon'])){
                        $img = $current_user['icon'];
                    ?>
                        <a href="upload.php?login_id=<?php echo $current_login_id; ?>" class="profile_icon">
                            <img src="<?php echo "uploads/$img"; ?>" style='width:150px; height:150px;' class="rounded-circle">  
                        </a>
                    <?php }else{ ?>
                        <a href="upload.php?login_id=<?php echo $current_login_id; ?>" class="profile_icon">
                            <img src='img/user_icon.png' style='width:150px; height:150px;' class='rounded-circle'>
                        </a>
                     <?php } ?>
                    <br>
                    Username: <?php echo $current_user['username']; ?>
                    <br>
                    Bio: <?php echo $current_user['bio']; ?>
                    <br>
                    Location: <?php echo $current_user['location']; ?>
                    <br>
                    Folowing: 
                    <br>
                    Follwer: 
                    <br>

                    <!-- Button trigger profile modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#updateModal">
                    Edit
                    </button>

                    <!-- Profile Modal -->
                    <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Profile</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="<?php echo "action.php?login_id=$current_login_id"; ?>" method="post">
                                    <div class="modal-body">
                                        <?php if(!empty($current_user['icon'])){ ?>
                                            <a href="<?php echo "upload.php?login_id=$current_login_id"; ?>" class="profile_icon">
                                                <img src='uploads/<?php echo $current_user['icon']; ?>' style='width:50px; height:50px;' class='rounded-circle'>
                                            </a>
                                        <?php }else{ ?>
                                            <a href="<?php echo "upload.php?login_id=$current_login_id"; ?>" class="profile_icon">
                                                <img src='img/user_icon.png' style='width:50px; height:50px;' class='rounded-circle'>
                                            </a>
                                        <?php } ?>
                                        <br>
                                        <label for="">Username</label>
                                        <input type="text" name="username" class="form-control" value="<?php if(!empty($current_user['username'])){
                                            echo $current_user['username'];
                                        } ?>">
                                        <label for="">Bio</label>
                                        <textarea name="bio" id="" cols="30" rows="10" class="form-control">
                                            <?php 
                                                if(!empty($current_user['bio'])){
                                                echo $current_user['bio'];
                                                } 
                                            ?>
                                        </textarea>  
                                        <label for="">Location</label>     
                                        <input type="text" name="location" class="form-control" value="<?php if(!empty($current_user['location'])){
                                            echo $current_user['location'];
                                        } ?>">            
                                        <button type="submit" name="update_profile" class="btn btn-primary float-right my-3">Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <?php 
                        $my_postlist = $SNS->displayMyPosts($current_login_id);
                        foreach($my_postlist as $row):
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
                                    <a href="delete_mypost.php?post_id=<?php echo $row['post_id']; ?>" class="btn"><i class="fas fa-trash-alt fa-lg text-danger"></i></a>
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