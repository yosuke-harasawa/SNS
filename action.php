<?php
    include 'classes/SNS.php';
    $SNS = new SNS;

    //REGISTER
    if(isset($_POST['register'])){
        $uname = $_POST['username'];
        $phone_num = $_POST['phone_number'];
        $email = $_POST['email'];
        $pword = $_POST['password'];
        $confirm_pword = $_POST['confirm_password'];

        $SNS->register($uname,$phone_num,$email,$pword,$confirm_pword);
    }
    
    //LOGIN
    if(isset($_POST['login'])){
        $info = $_POST['info'];
        $pword = $_POST['password'];

        $SNS->login($info,$pword);
    }

    //UPDATE PROFILE
    if(isset($_POST['update_profile'])){
        $uname = $_POST['username'];
        $bio = $_POST['bio'];
        $location = $_POST['location'];
        
        $SNS->updateProfile($_SESSION['login_id'],$uname,$bio,$location);
    }
    
    // ADD POST
    if(isset($_POST['add_post'])){
        $text = $_POST['text'];
        $file_name = $_FILES['picture']['name'];

        $SNS->addPost($_SESSION['login_id'],$text,$file_name);
        $SNS->uploadPicture($file_name);
    }

    //SEARCH
    if(isset($_POST['search'])){
        $info = $_POST['search_info'];

        $searched_users = $SNS->searchUser($info);
        $_SESSION['searched_users'] = $searched_users;

        header('location:user_result.php');
    }

    //FOLLOW UNFOLLOW
    if(isset($_POST['follow'])){
        $user_id = $_POST['user_id'];
        $followed_user_id = $_POST['followed_user_id'];

        $SNS->followUser($user_id,$followed_user_id);

    }elseif(isset($_POST['unfollow'])){
        $user_id = $_POST['user_id'];
        $followed_user_id = $_POST['followed_user_id'];

        $SNS->unfollowUser($user_id,$followed_user_id);

    }elseif(isset($_POST['follow_in_profile'])){
        $user_id = $_POST['user_id'];
        $followed_user_id = $_POST['followed_user_id'];

        $SNS->insideProfileFollowUser($user_id,$followed_user_id);

    }elseif(isset($_POST['unfollow_in_profile'])){
        $user_id = $_POST['user_id'];
        $followed_user_id = $_POST['followed_user_id'];

        $SNS->insideProfileUnfollowUser($user_id,$followed_user_id);

    }elseif(isset($_POST['unfollow_in_myfollowing_list'])){
        $user_id = $_POST['user_id'];
        $followed_user_id = $_POST['followed_user_id'];

        $SNS->insideMyFollowingListUnfollowUser($user_id,$followed_user_id);

    }elseif(isset($_POST['follow_in_myfollower_list'])){
        $user_id = $_POST['user_id'];
        $followed_user_id = $_POST['followed_user_id'];

        $SNS->insideMyFollowerListFollowUser($user_id,$followed_user_id);

    }elseif(isset($_POST['unfollow_in_myfollower_list'])){
        $user_id = $_POST['user_id'];
        $followed_user_id = $_POST['followed_user_id'];

        $SNS->insideMyFollowerListUnfollowUser($user_id,$followed_user_id);

    }elseif(isset($_POST['follow_in_others_following_list'])){
        $user_id = $_POST['user_id'];
        $followed_user_id = $_POST['followed_user_id'];
        $current_user_id = $_POST['current_user_id'];

        $SNS->insideOthersFollowingListFollowUser($user_id,$followed_user_id,$current_user_id);

    }elseif(isset($_POST['unfollow_in_others_following_list'])){
        $user_id = $_POST['user_id'];
        $followed_user_id = $_POST['followed_user_id'];
        $current_user_id = $_POST['current_user_id'];

        $SNS->insideOthersFollowingListUnfollowUser($user_id,$followed_user_id,$current_user_id);

    } elseif(isset($_POST['follow_in_others_follower_list'])){
        $user_id = $_POST['user_id'];
        $followed_user_id = $_POST['followed_user_id'];
        $current_user_id = $_POST['current_user_id'];

        $SNS->insideOthersFollowerListFollowUser($user_id,$followed_user_id,$current_user_id);

    }elseif(isset($_POST['unfollow_in_others_follower_list'])){
        $user_id = $_POST['user_id'];
        $followed_user_id = $_POST['followed_user_id'];
        $current_user_id = $_POST['current_user_id'];

        $SNS->insideOthersFollowerListUnfollowUser($user_id,$followed_user_id,$current_user_id);
    }
   

    //REPLY
    if(isset($_POST['reply'])){
        $post_id = $_POST['post_id'];
        $user_id = $_SESSION['login_id'];
        $comment = $_POST['comment'];
        $picture = $_POST['picture'];

        $SNS->addReply($post_id,$user_id,$comment,$picture);

    }elseif(isset($_POST['reply_in_others_profile'])){
        $post_id = $_POST['post_id'];
        $user_id = $_SESSION['login_id'];
        $comment = $_POST['comment'];
        $picture = $_POST['picture'];

        $SNS->insideOthersProfileAddReply($post_id,$user_id,$comment,$picture);

    }elseif(isset($_POST['reply_in_myprofile'])){
        $post_id = $_POST['post_id'];
        $user_id = $_SESSION['login_id'];
        $comment = $_POST['comment'];
        $picture = $_POST['picture'];

        $SNS->insideMyProfileAddReply($post_id,$user_id,$comment,$picture);

    }elseif(isset($_POST['reply_in_comment'])){
        $post_id = $_POST['post_id'];
        $user_id = $_SESSION['login_id'];
        $comment = $_POST['comment'];
        $picture = $_POST['picture'];

        $SNS->insideCommentAddReply($post_id,$user_id,$comment,$picture);
    }

    // if(isset($_POST['reply_against_reply'])){
    //     $reply_id = $_POST['reply_id'];
    //     $user_id = $_SESSION['login_id'];
    //     $comment = $_POST['comment'];
    //     $picture = $_POST['picture'];

    //     $SNS->addReplyAgainstReply($reply_id,$user_id,$comment,$picture);
    // }

    // LIKE UNLIKE
    if(isset($_POST['like'])){
        $post_id = $_POST['post_id'];
        $user_id = $_SESSION['login_id'];

        $SNS->addLike($post_id,$user_id);

    }elseif(isset($_POST['unlike'])){
        $post_id = $_POST['post_id'];
        $user_id = $_SESSION['login_id'];

        $SNS->deleteLike($post_id,$user_id);
    }

    if(isset($_POST['like_in_others_profile'])){
        $post_id = $_POST['post_id'];
        $user_id = $_SESSION['login_id'];
        $liked_user_id = $_POST['liked_user_id'];

        $SNS->insideOthersProfileAddLike($post_id,$user_id,$liked_user_id);

    }elseif(isset($_POST['unlike_in_others_profile'])){
        $post_id = $_POST['post_id'];
        $user_id = $_SESSION['login_id'];
        $unliked_user_id = $_POST['unliked_user_id'];

        $SNS->insideOthersProfileDeleteLike($post_id,$user_id,$unliked_user_id);
    }

    if(isset($_POST['like_in_myprofile'])){
        $post_id = $_POST['post_id'];
        $user_id = $_SESSION['login_id'];

        $SNS->insideMyprofileAddLike($post_id,$user_id);

    }elseif(isset($_POST['unlike_in_myprofile'])){
        $post_id = $_POST['post_id'];
        $user_id = $_SESSION['login_id'];

        $SNS->insideMyprofileDeleteLike($post_id,$user_id);
    }

    if(isset($_POST['like_in_comment'])){
        $post_id = $_POST['post_id'];
        $user_id = $_SESSION['login_id'];

        $SNS->insideCommentAddLike($post_id,$user_id);

    }elseif(isset($_POST['unlike_in_comment'])){
        $post_id = $_POST['post_id'];
        $user_id = $_SESSION['login_id'];

        $SNS->insideCommentDeleteLike($post_id,$user_id);
    }

?>