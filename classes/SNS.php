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
            $sql = "INSERT INTO posts(text,picture,login_id) VALUES('$text','$picture','$id')";
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

        function displayAllPosts(){
            $sql = "SELECT * FROM posts INNER JOIN users ON posts.login_id = users.login_id ORDER BY posts.post_id DESC";
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

        function displayMyPosts($id){
            $sql = "SELECT * FROM posts INNER JOIN users ON posts.login_id = users.login_id WHERE posts.login_id='$id' ORDER BY posts.post_id DESC";
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
            $sql = "SELECT * FROM posts INNER JOIN users ON posts.login_id=users.login_id WHERE users.user_id='$id' ORDER BY posts.post_id DESC";
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
            $sql = "SELECT * FROM users INNER JOIN login ON users.login_id=login.login_id INNER JOIN follow ON follow.login_id=users.login_id WHERE users.username LIKE '%$info%' AND login.status='U'";
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
        function followUser($login_id,$user_id){
            $sql = "INSERT INTO follow(user_id,login_id,status) VALUE('$user_id','$login_id','followed')";
            $result = $this->conn->query($sql);

            if($result == TRUE){
                header('location:user_result.php');
            }else{
                echo "Insert into follow failed";
            }
        }

        //COMMENT
        // function addComment($comment){
        //     $sql = "INSERT INTO "
        // }
    }
?>