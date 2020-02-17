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
                    <h1>Profile</h1>
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
                    <a href="others_following_list.php?user_id=<?php echo $user_id ?>" style="color: black;">
                        Folowing: <b><?php echo $SNS->displayFollowingNum($user_id) ?></b>
                    </a> 
                    <br>
                    <a href="others_follower_list.php?user_id=<?php echo $user_id ?>" style="color: black;">
                        Follower: <b><?php echo $SNS->displayFollowerNum($user_id) ?></b> 
                    </a>
                    <br>
                    <?php 
                        $rs = $SNS->validateUserRelationship($current_login_id,$user_id);
                        if($rs == 'follow'){
                    ?>
                        <form action="action.php" method="post">
                            <input type="hidden" name="user_id" value="<?php echo $current_login_id ?>">
                            <input type="hidden" name="followed_user_id" value="<?php echo $user_id ?>">
                            <button type="submit" name="follow_in_profile" class="btn btn-outline-primary mt-2" style="border-radius: 25px;">Follow</button>
                        </form>
                    <?php 
                        }else{
                    ?>
                        <form action="action.php" method="post">
                            <input type="hidden" name="user_id" value="<?php echo $current_login_id ?>">
                            <input type="hidden" name="followed_user_id" value="<?php echo $user_id ?>">
                            <button type="submit" name="unfollow_in_profile" class="btn btn-outline-primary mt-2" style="border-radius: 25px;">Unfollow</button>
                        </form>
                    <?php } ?>
                    <hr>

                    <?php 
                        $others_postlist = $SNS->displayOthersPosts($user_id);
                        foreach($others_postlist as $row):
                        $post_id = $row['post_id']
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
                                <form action="action.php" method="post">
                                    <div class="mt-2">
                                        <!-- REPLY -->
                                        <!-- Button trigger REPLY modal -->
                                        <button type="button" class="btn" data-toggle="modal" data-target="#ModalID_<?php echo $post_id ?>">
                                            <i class="far fa-comment-alt fa-lg"></i>
                                        </button>
                                        <?php echo $SNS->displayReplyNum($post_id) ?>
                                        <!-- REPLY Modal -->
                                        <div class="modal fade" id="ModalID_<?php echo $post_id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                            <input type="hidden" name="post_id" value="<?php echo $row['post_id'] ?>">
                                                            <button type="submit" name="reply_in_others_profile" class="btn btn-info float-right mt-2">Reply</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- RETWEET -->
                                        <button name="retweet" class="btn"><i class="fas fa-retweet fa-lg"></i></button>
                                        <!-- LIKE -->
                                        <?php 
                                            $rs = $SNS->likeRelationship($row['post_id'],$current_login_id);
                                            if($rs == 'like'){
                                         ?>
                                            <input type="hidden" name="liked_user_id" value="<?php echo $user_id ?>">
                                            <button type="submit" name="like_in_others_profile" class="like btn">
                                                <i class="far fa-heart fa-lg"></i>
                                            </button>
                                            <?php echo $SNS->displayLikesNum($row['post_id']) ?>
                                        <?php }else{ ?>
                                            <input type="hidden" name="unliked_user_id" value="<?php echo $user_id ?>">
                                            <button type="submit" name="unlike_in_others_profile" class="unlike btn">
                                                <i class="far fa-heart fa-lg"></i>
                                            </button>
                                            <?php echo $SNS->displayLikesNum($row['post_id']) ?>
                                        <?php } ?>
                                        <!-- SEND -->
                                        <button name="send" class="btn">
                                            <i class="far fa-share-square fa-lg"></i>
                                        </button>
                                        <!-- BOOKMARK -->
                                        <button name="bookmark" class="btn">
                                            <i class="far fa-bookmark fa-lg"></i>
                                        </button>
                                    </div>
                                </form>
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