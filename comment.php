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
            .view-post{
                position: relative;
                left: 360px;
            }
            .user_icon:hover{
                text-decoration: none;
                opacity: 0.9;
            }
            .fa-color{
                color: lightslategrey;
            }
            .like-color{
                color: rgb(223, 35, 94);
            }
            .v_line_fix{
                margin-left: 23px;
                width: 4px;
                height: 50px;
                background-color: lightslategrey;
                margin-bottom: 6px;
            }
        </style>    
    </head>

    <body style="background-color: rgb(21, 32, 43);">
        <div class="container-fluid mt-3">
            <div class="row">
                <!-- SIDEMENUE -->
                <?php include 'user_menu.php'; ?>

                <!-- MAIN VIEW -->
                <!-- CARD -->
                <div class="view-post col-lg-6">
                    <h1 class="text-light">Post</h1>
                    <div class="card w-100 mt-3" style="background-color: rgb(25, 39, 52); border-color: rgb(55, 68, 76);">
                        <?php
                            $paticular_post = $SNS->displayPaticularPost($_GET['post_id']);
                            foreach($paticular_post as $row): 
                            $post_id = $row['post_id'];
                        ?>
                            <div class="card-header" style="border-color: rgb(55, 68, 76);">
                                <!-- USER ICON -->
                                <?php
                                    if(!empty($row['icon'])){
                                    $icon = $row['icon'];
                                    $user_id = $row['user_id'];
                                ?>
                                    <a href="<?php 
                                                if($user_id == $current_login_id){
                                                echo "my_profile.php";
                                                }else{
                                                echo "others_profile.php?user_id=$user_id"; 
                                                }
                                            ?>" class="user_icon">
                                        <img src="uploads/<?php echo "$icon"; ?>" style='width:50px; height:50px;' class="rounded-circle mr-2">
                                    </a>
                                <?php }else{ ?>
                                    <a href="<?php 
                                                if($user_id == $current_login_id){
                                                echo "my_profile.php";
                                                }else{
                                                echo "others_profile.php?user_id=$user_id"; 
                                                }
                                            ?>" class="user_icon">
                                        <img src="img/user_icon.png" alt="" style='width:50px; height:50px;' class="rounded-circle mr-2">
                                    </a>
                                <?php } ?>
                                <!-- USER NAME -->
                                <a href="<?php 
                                                if($user_id == $current_login_id){
                                                echo "my_profile.php";
                                                }else{
                                                echo "others_profile.php?user_id=$user_id"; 
                                                }
                                            ?>" class="text-light">
                                    <?php echo $row['username']; ?>
                                </a>
                            </div>
                            <!-- POST CONTENT -->
                            <div class="card-body text-light">
                                <p style="font-size: 2em;"><?php echo $row['text']; ?></p>
                                <br>
                                <?php if(!empty($row['picture'])): 
                                    $img = $row['picture'];
                                ?>
                                    <div class="card mt-2" style="border: 0;">
                                        <img src="uploads/<?php echo $img; ?>" alt="" class="w-100 h-100" style="border-radius: 25px;">
                                    </div>
                                <?php endif; ?>
                                <hr color="#37444c">
                                    <!-- LIKE LIST -->
                                    <a href="like_list.php?post_id=<?php echo $post_id ?>" class="text-light">
                                        <?php echo $SNS->displayLikesNum($row['post_id']) ?>
                                        <span style="color: lightslategrey;">
                                            Likes
                                        </span> 
                                    </a>
                                <hr color="#37444c">
                                <!-- SNS BUTTONS -->
                                <form action="action.php" method="post">
                                    <div class="mt-2">
                                        <!-- REPLY -->
                                        <!-- Button trigger REPLY modal -->
                                        <button type="button" class="btn" data-toggle="modal" data-target="#modalID_<?php echo $post_id ?>">
                                            <i class="far fa-comment-alt fa-lg fa-color"></i>
                                        </button>
                                        <span style="color: lightslategrey;"><?php echo $SNS->displayReplyNum($post_id) ?></span> 
                                        <!-- REPLY Modal -->
                                        <div class="modal fade" id="modalID_<?php echo $post_id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content" style="background-color: rgb(21, 32, 42);">
                                                    <div class="modal-header" style="border-color:rgb(55, 68, 76);">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <img src="uploads/<?php echo $current_user['icon']; ?>" alt="" class="rounded-circle mr-2" style="width: 50px; height: 50px;">
                                                        <form action="action.php" method="post" enctype="multipart/form-data">
                                                            <textarea name="comment" id="" cols="14" rows="10" class="form-control mt-2" placeholder="Input your reply"></textarea>
                                                            <input type="file" name="picture" class="mt-3" style="color: lightslategrey;">
                                                            <br>
                                                            <input type="hidden" name="post_id" value="<?php echo $row['post_id'] ?>">
                                                            <button type="submit" name="reply_in_comment" class="btn btn-primary float-right mt-2">Reply</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- RETWEET -->
                                        <button name="retweet" class="btn"><i class="fas fa-retweet fa-lg fa-color"></i></button>
                                        <!-- LIKE -->
                                        <?php 
                                            $rs = $SNS->likeRelationship($row['post_id'],$current_login_id);
                                            if($rs == 'like'){
                                        ?>
                                            <input type="hidden" name="post_id" value="<?php echo $row['post_id'] ?>">
                                            <button type="submit" name="like_in_comment" class="btn">
                                                <i class="far fa-heart fa-lg fa-color"></i>
                                            </button>
                                            <span style="color: lightslategrey;">
                                                <?php echo $SNS->displayLikesNum($row['post_id']) ?>
                                            </span> 
                                        <?php }else{ ?>
                                            <input type="hidden" name="post_id" value="<?php echo $row['post_id'] ?>">
                                            <button type="submit" name="unlike_in_comment" class="btn">
                                                <i class="far fa-heart fa-lg like-color"></i>
                                            </button>
                                            <?php echo $SNS->displayLikesNum($row['post_id']) ?>
                                        <?php } ?>
                                        <!-- SEND -->
                                        <button name="send" class="btn">
                                            <i class="far fa-share-square fa-lg fa-color"></i>
                                        </button>
                                        <!-- BOOKMARK -->
                                        <button name="bookmark" class="btn">
                                            <i class="far fa-bookmark fa-lg fa-color"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        <?php endforeach; ?>

                        <!-- REPLIES -->
                        <?php
                            $replies_list = $SNS->displayReplies($_GET['post_id']);
                            foreach($replies_list as $row):
                            $reply_id = $row['reply_id'];
                        ?>
                            <div class="card-body text-light border-bottom-0 pb-0" style="background-color: rgb(25, 39, 52); border-top: 1px solid rgb(55, 68, 76);">
                                 <!-- USER ICON -->
                                <?php
                                    if(!empty($row['icon'])){
                                    $icon = $row['icon'];
                                    $user_id = $row['user_id'];
                                ?>
                                    <a href="<?php 
                                                if($user_id == $current_login_id){
                                                echo "my_profile.php";
                                                }else{
                                                echo "others_profile.php?user_id=$user_id"; 
                                                }
                                            ?>" class="user_icon">
                                        <img src="uploads/<?php echo "$icon"; ?>" style='width:50px; height:50px;' class="rounded-circle mr-2">
                                    </a>
                                <?php }else{ ?>
                                    <a href="<?php 
                                                if($user_id == $current_login_id){
                                                echo "my_profile.php";
                                                }else{
                                                echo "others_profile.php?user_id=$user_id"; 
                                                }
                                            ?>" class="user_icon">
                                        <img src="img/user_icon.png" alt="" style='width:50px; height:50px;' class="rounded-circle mr-2">
                                    </a>
                                <?php } ?>
                                <!-- USER NAME -->
                                <a href="<?php 
                                                if($user_id == $current_login_id){
                                                echo "my_profile.php";
                                                }else{
                                                echo "others_profile.php?user_id=$user_id"; 
                                                }
                                            ?>" class="text-light">
                                    <?php echo $row['username']; ?>
                                </a>
                                <br>
                            <!-- POST CONTENT -->
                                <?php echo $row['comment']; ?>
                                <br>
                                <?php 
                                    if(!empty($row['picture'])): 
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
                                        <button type="button" class="btn" data-toggle="modal" data-target="#modalID_<?php echo $reply_id ?>">
                                            <i class="far fa-comment-alt fa-lg fa-color"></i>
                                        </button>
                                        <span style="color: lightslategrey;">
                                            <?php echo $SNS->displayRereplyNum($reply_id) ?>
                                        </span>
                                        <!-- REPLY Modal -->
                                        <div class="modal fade" id="modalID_<?php echo $reply_id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content" style="background-color: rgb(21, 32, 42);">
                                                    <div class="modal-header" style="border-color:rgb(55, 68, 76);">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <img src="uploads/<?php echo $current_user['icon']; ?>" alt="" class="rounded-circle mr-2" style="width: 50px; height: 50px;">
                                                        <form action="action.php" method="post" enctype="multipart/form-data">
                                                            <textarea name="comment" id="" cols="14" rows="10" class="form-control mt-2" placeholder="Input your reply"></textarea>
                                                            <input type="file" name="picture" class="mt-3" style="color: lightslategrey;">
                                                            <br>
                                                            <input type="hidden" name="post_id" value="<?php echo $_GET['post_id'] ?>">
                                                            <input type="hidden" name="reply_id" value="<?php echo $reply_id ?>">
                                                            
                                                            <button type="submit" name="reply_to_reply" class="btn btn-primary float-right mt-2">Reply</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- RETWEET -->
                                        <button name="retweet" class="btn">
                                            <i class="fas fa-retweet fa-lg fa-color"></i>
                                        </button>
                                        <!-- LIKE -->
                                        <?php 
                                            $rs = $SNS->likeRelationship($row['comment_id'],$current_login_id);
                                            if($rs == 'like'){
                                        ?>
                                            <button type="submit" name="like" class="btn">
                                                <i class="far fa-heart fa-lg fa-color"></i>
                                            </button>
                                            <span style="color: lightslategrey;">
                                                <?php echo $SNS->displayLikesNum($row['comment_id']) ?>
                                            </span>
                                        <?php }else{ ?>
                                            <button type="submit" name="unlike" class="btn">
                                                <i class="far fa-heart fa-lg fa-color"></i>
                                            </button>
                                            <span style="color: lightslategrey;">
                                                <?php echo $SNS->displayLikesNum($row['comment_id']) ?>
                                            </span>
                                        <?php } ?>
                                        <!-- SEND -->
                                        <button name="send" class="btn">
                                            <i class="far fa-share-square fa-lg fa-color"></i>
                                        </button>
                                        <!-- BOOKMARK -->
                                        <button name="bookmark" class="btn">
                                            <i class="far fa-bookmark fa-lg fa-color"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <!-- REPLY TO REPLY -->
                            <?php
                                $re_replies_list = $SNS->displayRereply($reply_id);
                                foreach($re_replies_list as $row):
                            ?>
                                <div class="card-body text-light border-bottom-0 pt-0 pb-0">
                                    <div class="v_line_fix"></div>
                                    <!-- USER ICON -->
                                    <?php
                                        if(!empty($row['icon'])){
                                        $icon = $row['icon'];
                                        $user_id = $row['user_id'];
                                    ?>
                                        <a href="<?php 
                                                    if($user_id == $current_login_id){
                                                    echo "my_profile.php";
                                                    }else{
                                                    echo "others_profile.php?user_id=$user_id"; 
                                                    }
                                                ?>" class="user_icon">
                                            <img src="uploads/<?php echo "$icon"; ?>" style='width:50px; height:50px;' class="rounded-circle mr-2">
                                        </a>
                                    <?php }else{ ?>
                                        <a href="<?php 
                                                    if($user_id == $current_login_id){
                                                    echo "my_profile.php";
                                                    }else{
                                                    echo "others_profile.php?user_id=$user_id"; 
                                                    }
                                                ?>" style="text-decoration: none;">
                                            <img src="img/user_icon.png" alt="" style='width:50px; height:50px;' class="rounded-circle mr-2">
                                        </a>
                                    <?php } ?>
                                    <!-- USER NAME -->
                                    <a href="<?php 
                                                    if($user_id == $current_login_id){
                                                    echo "my_profile.php";
                                                    }else{
                                                    echo "others_profile.php?user_id=$user_id"; 
                                                    }
                                                ?>" class="text-light">
                                        <?php echo $row['username']; ?>
                                    </a>
                                    <br>
                                <!-- POST CONTENT -->
                                    <?php echo $row['reply']; ?>
                                    <br>
                                    <?php 
                                        if(!empty($row['picture'])): 
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
                                            <button type="button" class="btn" data-toggle="modal" data-target="#modalID_<?php echo $reply_id ?>">
                                                <i class="far fa-comment-alt fa-lg fa-color"></i>
                                            </button>
                                            <!-- REPLY Modal -->
                                            <div class="modal fade" id="modalID_<?php echo $reply_id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                                <input type="file" name="picture" class="mt-3" style="color: lightslategrey;">
                                                                <br>
                                                                <input type="hidden" name="post_id" value="<?php echo $_GET['post_id'] ?>">
                                                                <input type="hidden" name="reply_id" value="<?php echo $reply_id ?>">
                                                                
                                                                <button type="submit" name="reply_to_reply" class="btn btn-info float-right mt-2">Reply</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- RETWEET -->
                                            <button name="retweet" class="btn"><i class="fas fa-retweet fa-lg fa-color"></i></button>
                                            <!-- LIKE -->
                                            <?php 
                                                $rs = $SNS->likeRelationship($row['comment_id'],$current_login_id);
                                                if($rs == 'like'){
                                            ?>
                                                <button type="submit" name="like" class="btn"><i class="far fa-heart fa-lg fa-color"></i></button><?php echo $SNS->displayLikesNum($row['comment_id']) ?>
                                            <?php }else{ ?>
                                                <button type="submit" name="unlike" class="btn"><i class="far fa-heart fa-lg fa-color"></i></button><?php echo $SNS->displayLikesNum($row['comment_id']) ?>
                                            <?php } ?>
                                            <!-- SEND -->
                                            <button name="send" class="btn"><i class="far fa-share-square fa-lg fa-color"></i></button>
                                            <!-- BOOKMARK -->
                                            <button name="bookmark" class="btn"><i class="far fa-bookmark fa-lg fa-color"></i></button>
                                        </div>
                                    </form>
                                </div> 
                            <?php endforeach; ?>
                        <?php endforeach ?>
                    </div>
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