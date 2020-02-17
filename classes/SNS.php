<?php
    include 'Connection.php';

    class SNS extends Connection{

        //REGISTER
        function register($uname,$phone_num,$email,$pword,$confirm_pword){
            if($pword == $confirm_pword){
                $pattern='/\A(?=.*?[a-z])(?=.*?\d)[a-z\d]{8,100}+\z/i';

                if(preg_match($pattern,$pword)){
                    $insert_into_login = "INSERT INTO login(phone_number,email,password) VALUES('$phone_num','$email','$pword')";
                    $login_result = $this->conn->query($insert_into_login);
        
                        if($login_result == TRUE){
                            $login_id = $this->conn->insert_id;
                            $insert_into_users = "INSERT INTO users(username,login_id) VALUES('$uname','$login_id')";
                            $user_result = $this->conn->query($insert_into_users);
            
                            if($user_result == FALSE){
                                echo "insert into users failed";
                            }else{
                                header('location:login.php');
                            }
                        }else{
                            echo "insert into login failed";
                        }
                }else{
                    echo "Please enter more than 7 letters, and combine Alphabet and Number!!";
                }
            }else{
                echo "Confirm password is wrong!!";
            }
        }
        
        //LOGIN
        function login($info,$pword){
            $sql = "SELECT * FROM login INNER JOIN users ON login.login_id=users.login_id WHERE login.phone_number='$info' AND login.password='$pword' OR login.email='$info' AND login.password='$pword'";
            $result = $this->conn->query($sql);
            
            if($result->num_rows==1){
                $row = $result->fetch_assoc();
                $_SESSION['login_id'] = $row['login_id'];

                if($row['status']=='A'){
                    header('location:dashboard.php');
                }else{
                    header('location:home.php');
                }
            }else{
                echo "cannot login!!";
            }
        }

        //USER
        function getCurrentUser($id){
            $sql = "SELECT * FROM users WHERE login_id='$id'";
            $result = $this->conn->query($sql);

            if($result == FALSE){
                die("cannot get one user".$this->conn->error);
            }else{
                return $result->fetch_assoc();
            }
        }

        function updateProfile($id,$uname,$bio,$location){
            $sql = "UPDATE users SET username='$uname',bio='$bio', location='$location' WHERE login_id='$id'";
            $result = $this->conn->query($sql);

            if($result == FALSE){
                die("cannot update".$this->conn->error);
            }else{
                header('location:my_profile.php');
            }
        }

        function uploadUserIcon($id,$file_name){
            $target_dir = 'uploads/';
            $target_file = $target_dir.basename($file_name);
            $sql = "UPDATE users SET icon='$file_name' WHERE login_id='$id'";
            $result = $this->conn->query($sql);
    
            if($result == FALSE){
                die("cannot upload file".$this->conn->error);
            }else{
                move_uploaded_file($_FILES['profile_img']['tmp_name'],$target_file);
                header('location:my_profile.php');
            }
        }
        
        function getOtherUser($id){
            $sql = "SELECT * FROM users WHERE user_id='$id'";
            $result = $this->conn->query($sql);

            if($result == FALSE){
                die($this->conn->error);
            }else{
                return $result->fetch_assoc();
            }
        }

        //POST
        function addPost($id,$text,$picture){
            $sql = "INSERT INTO posts(text,picture,user_id) VALUES('$text','$picture','$id')";
            $result = $this->conn->query($sql);

            if($result == FALSE){
                echo "cannot add post".$this->conn->error;
            }
            // else{
            //     $_SESSION['post_id'];
            // }
        }

        function uploadPicture($file_name){
            $target_dir = "uploads/";
            $target_file = $target_dir.basename($file_name);

            move_uploaded_file($_FILES['picture']['tmp_name'],$target_file);
            header('location:home.php');
        }

        function displayFollowUsersPosts($id){
            $sql = "SELECT * FROM posts INNER JOIN follow ON posts.user_id = follow.followed_user_id
            INNER JOIN users ON users.user_id = posts.user_id WHERE follow.user_id = '$id' ORDER BY posts.post_id DESC";
            $result = $this->conn->query($sql);

            if($result->num_rows>0){
                $row = array();

                while($rows = $result->fetch_assoc()){
                    $row[] = $rows;
                }
                return $row;
            }else{
                return FALSE;
            }
        }

        function displayPaticularPost($id){
            $sql = "SELECT * FROM posts INNER JOIN users ON posts.user_id = users.user_id WHERE post_id = '$id'";
            $result = $this->conn->query($sql);

            if($result->num_rows==1){
                $row = array();

                while($rows = $result->fetch_assoc()){
                    $row[] = $rows;
                }
                return $row;
            }else{
                return FALSE;
            }
        }

        function displayMyPosts($id){
            $sql = "SELECT * FROM posts INNER JOIN users ON posts.user_id = users.user_id WHERE posts.user_id='$id' ORDER BY posts.post_id DESC";
            $result = $this->conn->query($sql);

            if($result->num_rows>0){
                $row = array();

                while($rows = $result->fetch_assoc()){
                    $row[] = $rows;
                }
                return $row;
            }else{
                echo "<div class='jumbotron'>You haven't post yet.Let's post!</div>";
            }
        }

        function deleteMyPost($id){
            $sql = "DELETE FROM posts WHERE post_id='$id'";
            $result = $this->conn->query($sql);

            if($result == FALSE){
                die("cannot delete post".$this->conn->error);
            }else{
                header('location:my_profile.php');
            }
        }

        function displayOthersPosts($id){
            $sql = "SELECT * FROM posts INNER JOIN users ON posts.user_id=users.user_id WHERE users.user_id='$id' ORDER BY posts.post_id DESC";
            $result = $this->conn->query($sql);

            if($result->num_rows>0){
                $row = array();

                while($rows = $result->fetch_assoc()){
                    $row[] = $rows;
                }
                return $row;
            }else{
                echo "<div class='jumbotron'>This user hasn't post yet.</div>";
            }
        }

        //SEARCH
        function searchUser($info){
            $sql = "SELECT * FROM users INNER JOIN login ON users.login_id=login.login_id WHERE users.username LIKE '%$info%' AND login.status='U'";
            $result = $this->conn->query($sql);

            if($result->num_rows>0){
                $row = array();
                while($rows = $result->fetch_assoc()){
                    $row[] = $rows;
                }
                return $row;
            }else{
                echo "<div class='alert alert-warning'>
                        Sorry,cannot find the information.
                    </div>".$this->conn->error;
            }
        }

        //FOLLOW
        function validateUserRelationship($user_id,$random_user_id){
            $sql = "SELECT * FROM follow WHERE user_id='$user_id' AND followed_user_id='$random_user_id'";
            $result = $this->conn->query($sql);

            if($result->num_rows==1){
                return "unfollow";
            }else{
                if($user_id == $random_user_id){
                    return FALSE;
                }else{
                    return "follow";
                }
            }
        }
        
        function followUser($user_id,$followed_user_id){
            $sql ="INSERT INTO follow(user_id,followed_user_id) VALUES($user_id,$followed_user_id)";
            $result = $this->conn->query($sql);

            if($result == FALSE){
                echo "insert into follow failed";
            }else{
                header('location:user_result.php');
            }    
        }    

        function unfollowUser($user_id,$followed_user_id){
            $sql ="DELETE FROM follow WHERE user_id='$user_id' AND followed_user_id='$followed_user_id'";
            $result = $this->conn->query($sql);

            if($result == FALSE){
                echo "cannnot unfollow";
            }else{
                header('location:user_result.php');
            }
        }

        function insideProfileFollowUser($user_id,$followed_user_id){
            $sql ="INSERT INTO follow(user_id,followed_user_id) VALUES($user_id,$followed_user_id)";
            $result = $this->conn->query($sql);

            if($result == FALSE){
                echo "insert into follow failed";
            }else{
                header('location:others_profile.php?user_id='.$followed_user_id);
            }    
        }    

        function insideProfileUnfollowUser($user_id,$followed_user_id){
            $sql ="DELETE FROM follow WHERE user_id='$user_id' AND followed_user_id='$followed_user_id'";
            $result = $this->conn->query($sql);

            if($result == FALSE){
                echo "cannnot unfollow";
            }else{
                header('location:others_profile.php?user_id='.$followed_user_id);
            }
        }

        function insideMyFollowingListUnfollowUser($user_id,$followed_user_id){
            $sql ="DELETE FROM follow WHERE user_id='$user_id' AND followed_user_id='$followed_user_id'";
            $result = $this->conn->query($sql);

            if($result == FALSE){
                echo "cannnot unfollow";
            }else{
                header('location:my_following_list.php?user_id='.$followed_user_id);
            }
        }

        function insideMyFollowerListFollowUser($user_id,$followed_user_id){
            $sql ="INSERT INTO follow(user_id,followed_user_id) VALUES($user_id,$followed_user_id)";
            $result = $this->conn->query($sql);

            if($result == FALSE){
                echo "insert into follow failed";
            }else{
                header('location:my_follower_list.php?user_id='.$followed_user_id);
            }    
        }    

        function insideMyFollowerListUnfollowUser($user_id,$followed_user_id){
            $sql ="DELETE FROM follow WHERE user_id='$user_id' AND followed_user_id='$followed_user_id'";
            $result = $this->conn->query($sql);

            if($result == FALSE){
                echo "cannnot unfollow";
            }else{
                header('location:my_follower_list.php?user_id='.$followed_user_id);
            }
        }

        function insideOthersFollowingListFollowUser($user_id,$followed_user_id,$current_user_id){
            $sql ="INSERT INTO follow(user_id,followed_user_id) VALUES($user_id,$followed_user_id)";
            $result = $this->conn->query($sql);

            if($result == FALSE){
                echo "insert into follow failed";
            }else{
                header('location:others_following_list.php?user_id='.$current_user_id);
            }    
        }    

        function insideOthersFollowingListUnfollowUser($user_id,$followed_user_id,$current_user_id){
            $sql ="DELETE FROM follow WHERE user_id='$user_id' AND followed_user_id='$followed_user_id'";
            $result = $this->conn->query($sql);

            if($result == FALSE){
                echo "cannnot unfollow";
            }else{
                header('location:others_following_list.php?user_id='.$current_user_id);
            }
        }

        function insideOthersFollowerListFollowUser($user_id,$followed_user_id,$current_user_id){
            $sql ="INSERT INTO follow(user_id,followed_user_id) VALUES($user_id,$followed_user_id)";
            $result = $this->conn->query($sql);

            if($result == FALSE){
                echo "insert into follow failed";
            }else{
                header('location:others_follower_list.php?user_id='.$current_user_id);
            }    
        }    

        function insideOthersFollowerListUnfollowUser($user_id,$followed_user_id,$current_user_id){
            $sql ="DELETE FROM follow WHERE user_id='$user_id' AND followed_user_id='$followed_user_id'";
            $result = $this->conn->query($sql);

            if($result == FALSE){
                echo "cannnot unfollow";
            }else{
                header('location:others_follower_list.php?user_id='.$current_user_id);
            }
        }

        function displayFollowingNum($id){
            $sql = "SELECT * FROM follow WHERE user_id = '$id'";
            $result = $this->conn->query($sql);

            if($result->num_rows>0){
                return $result->num_rows;
            }else{
                return 0;
            }
        }

        function displayFollowerNum($id){
            $sql = "SELECT * FROM follow WHERE followed_user_id = '$id'";
            $result = $this->conn->query($sql);

            if($result->num_rows>0){
                return $result->num_rows;
            }else{
                return 0;
            }
        }

        function displayFollowing($id){
            $sql = "SELECT * FROM follow INNER JOIN users ON follow.followed_user_id = users.user_id WHERE follow.user_id = '$id'";
            $result = $this->conn->query($sql);

            if($result->num_rows>0){
                $row = array();

                while($rows = $result->fetch_assoc()){
                    $row[] = $rows;
                }
                return $row;
            }else{
                return FALSE;
            }
        }

        function displayFollower($id){
            $sql = "SELECT * FROM follow INNER JOIN users ON follow.user_id = users.user_id WHERE follow.followed_user_id = '$id'";
            $result = $this->conn->query($sql);

            if($result->num_rows>0){
                $row = array();
                
                while($rows = $result->fetch_assoc()){
                    $row[] = $rows;
                }
                return $row;
            }else{
                return FALSE;
            }
        }

        // REPLY
        function addReply($post_id,$user_id,$comment,$picture){
            $sql = "INSERT INTO replies(post_id,user_id,comment,picture) VALUES('$post_id','$user_id','$comment','$picture')";
            $result = $this->conn->query($sql);

            if($result == FALSE){
                echo "insert into reply error";
            }else{
                header('location:home.php');
            }
        }

        function insideOthersProfileAddReply($post_id,$user_id,$comment,$picture){
            $sql = "INSERT INTO replies(post_id,user_id,comment,picture) VALUES('$post_id','$user_id','$comment','$picture')";
            $result = $this->conn->query($sql);

            if($result == FALSE){
                echo "insert into reply error";
            }else{
                header('location:comment.php?post_id='.$post_id);
            }
        }

        function insideMyProfileAddReply($post_id,$user_id,$comment,$picture){
            $sql = "INSERT INTO replies(post_id,user_id,comment,picture) VALUES('$post_id','$user_id','$comment','$picture')";
            $result = $this->conn->query($sql);

            if($result == FALSE){
                echo "insert into reply error";
            }else{
                header('location:comment.php?post_id='.$post_id);
            }
        }

        function insideCommentAddReply($post_id,$user_id,$comment,$picture){
            $sql = "INSERT INTO replies(post_id,user_id,comment,picture) VALUES('$post_id','$user_id','$comment','$picture')";
            $result = $this->conn->query($sql);

            if($result == FALSE){
                echo "insert into reply error";
            }else{
                header('location:comment.php?post_id='.$post_id);
            }
        }

        function displayReplyNum($id){
            $sql = "SELECT * FROM replies WHERE post_id ='$id'";
            $result = $this->conn->query($sql);

            if($result->num_rows>0){
                return $result->num_rows;
            }else{
                return FALSE;
            }
        }

        function displayReplyAgainstReplyNum($id){
            $sql = "SELECT * FROM replies WHERE replies.reply_id = '$id'";
            $result = $this->conn->query($sql);

            if($result->num_rows>0){
                return $result->num_rows;
            }else{
                return FALSE;
            }
        }   

        function displayReplies($id){
            $sql = "SELECT * FROM replies INNER JOIN users ON replies.user_id = users.user_id WHERE replies.post_id = '$id'";
            $result = $this->conn->query($sql);

            if($result->num_rows>0){
                $row = array();

                while($rows = $result->fetch_assoc()){
                    $row[] = $rows;
                }
                return $row;
            }else{
                return FALSE;
            }
        }

        //RETWEET
        
        
        //LIKE

            function likeRelationship($post_id,$user_id){
                $sql = "SELECT * FROM likes WHERE post_id = '$post_id' AND user_id = '$user_id'";
                $result = $this->conn->query($sql);
    
                if($result->num_rows==1){
                    return "unlike";
                }else{
                    return "like";
                }
            }

        function addLike($post_id,$user_id){
            $sql = "INSERT INTO likes(post_id,user_id) VALUES('$post_id','$user_id')";
            $result = $this->conn->query($sql);

            if($result == FALSE){
                echo "insert into likes failed";
            }else{
                header('location:home.php');
            }
        }

        function insideOthersProfileAddLike($post_id,$user_id,$liked_user_id){
            $sql = "INSERT INTO likes(post_id,user_id) VALUES('$post_id','$user_id')";
            $result = $this->conn->query($sql);

            if($result == FALSE){
                echo "insert into likes failed";
            }else{
                header('location:others_profile.php?user_id='.$liked_user_id);
            }
        }

        function insideMyprofileAddLike($post_id,$user_id){
            $sql = "INSERT INTO likes(post_id,user_id) VALUES('$post_id','$user_id')";
            $result = $this->conn->query($sql);

            if($result == FALSE){
                echo "insert into likes failed";
            }else{
                header('location:my_profile.php');
            }
        }

        function insideCommentAddLike($post_id,$user_id){
            $sql = "INSERT INTO likes(post_id,user_id) VALUES('$post_id','$user_id')";
            $result = $this->conn->query($sql);

            if($result == FALSE){
                echo "insert into likes failed";
            }else{
                header('location:comment.php?post_id='.$post_id);
            }
        }


        function deleteLike($post_id,$user_id){
            $sql = "DELETE FROM likes WHERE post_id = '$post_id' AND user_id = '$user_id'";
            $result = $this->conn->query($sql);

            if($result == FALSE){
                echo "cannot delete like";
            }else{
                header('location:home.php');
            }
        }

        function insideOthersProfileDeleteLike($post_id,$user_id,$unliked_user_id){
            $sql = "DELETE FROM likes WHERE post_id = '$post_id' AND user_id = '$user_id'";
            $result = $this->conn->query($sql);

            if($result == FALSE){
                echo "cannot delete like";
            }else{
                header('location:others_profile.php?user_id='.$unliked_user_id);
            }
        }

        function insideMyprofileDeleteLike($post_id,$user_id){
            $sql = "DELETE FROM likes WHERE post_id = '$post_id' AND user_id = '$user_id'";
            $result = $this->conn->query($sql);

            if($result == FALSE){
                echo "cannot delete like";
            }else{
                header('location:my_profile.php');
            }
        }

        function insideCommentDeleteLike($post_id,$user_id){
            $sql = "DELETE FROM likes WHERE post_id = '$post_id' AND user_id = '$user_id'";
            $result = $this->conn->query($sql);

            if($result == FALSE){
                echo "cannot delete like";
            }else{
                header('location:comment.php?post_id='.$post_id);
            }
        }

        function displayLikesNum($id){
            $sql = "SELECT * FROM likes WHERE post_id = '$id'";
            $result = $this->conn->query($sql);

            if($result->num_rows>0){
                return $result->num_rows;
            }else{
                return FALSE;
            }
        }

        function displayLikeList($post_id){
            $sql = "SELECT * FROM likes INNER JOIN users ON likes.user_id = users.user_id WHERE likes.post_id = '$post_id'";
            $result = $this->conn->query($sql);

            if($result->num_rows>0){
                $row = array();

                while($rows = $result->fetch_assoc()){
                    $row[] = $rows;
                }
                return $row;
            }else{
                return FALSE;
            }
        }
    }
?>