<?php
    include 'classes/SNS.php';
    $SNS = new SNS;

    if(isset($_POST['register'])){
        $uname = $_POST['username'];
        $phone_num = $_POST['phone_number'];
        $email = $_POST['email'];
        $pword = $_POST['password'];
        $confirm_pword = $_POST['confirm_password'];

        $SNS->register($uname,$phone_num,$email,$pword,$confirm_pword);
    }
    
    if(isset($_POST['login'])){
        $info = $_POST['info'];
        $pword = $_POST['password'];

        $SNS->login($info,$pword);
    }

    if(isset($_POST['update_profile'])){
        $uname = $_POST['username'];
        $bio = $_POST['bio'];
        $location = $_POST['location'];
        
        $SNS->updateProfile($_SESSION['login_id'],$uname,$bio,$location);
    }
    
    if(isset($_POST['add_post'])){
        $text = $_POST['text'];
        $file_name = $_FILES['picture']['name'];

        $SNS->addPost($_SESSION['login_id'],$text,$file_name);
        $SNS->uploadPicture($file_name);
    }

    if(isset($_POST['search'])){
        $info = $_POST['search_info'];

        $searched_users = $SNS->searchUser($info);
        $_SESSION['searched_users'] = $searched_users;

        header('location:user_result.php');
    }

    if(isset($_POST['first_follow'])){    
        $user_id = $_GET['user_id'];
        $login_id = $_SESSION['login_id'];

        $SNS->followUser($user_id,$login_id);
    }

    // if(isset($_POST['reply'])){
    //     $comment = $_POST['comment'];

    //     $SNS->addComment($comment);
    // }
    
    


?>