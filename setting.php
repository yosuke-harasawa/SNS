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
            .main-view{
                position: relative;
                left: 360px;
            }
        </style>
    </head>

    <body style="background-color: rgb(21, 32, 42);">
        <div class="container-fluid mt-3">
            <div class="row">
                <!-- SIDEMENUE -->
                <?php include 'user_menu.php'; ?>
                <!-- MAIN VIEW -->
                <div class="main-view col-lg-6" >
                    <h1 class="text-light">Setting</h1>  
                        <div class="row mt-3">
                            <div class="col-4">
                                <div class="list-group" id="list-tab" role="tablist">
                                    <a class="list-group-item list-group-item-action active" id="list-phone-list" data-toggle="list" href="#list-phone" role="tab" aria-controls ="phone" style="background-color: rgb(21, 32, 42); border-color: rgb(55, 68, 76);">
                                         Phone
                                    </a>
                                    <a class="list-group-item list-group-item-action" id="list-email-list" data-toggle="list" href="#list-email" role="tab" aria-controls ="email" style="background-color: rgb(21, 32, 42); border-color: rgb(55, 68, 76);"> 
                                        E-mail
                                    </a>
                                    <a class="list-group-item list-group-item-action" id="list-password-list" data-toggle="list" href="#list-password" role="tab" aria-controls ="messa ges" style="background-color: rgb(21, 32, 42); border-color: rgb(55, 68, 76);">
                                        Password
                                    </a>
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="tab-content" id="nav-tabContent">
                                    <?php $current_user_info = $SNS->getCurrentUserInfo($current_login_id) ?>
                                    <div class="tab-pane fade show active" id="list-phone" role="tabpanel" aria-labelledby="list-phone-list">
                                        <form action="action.php" method="post">
                                            <input type="text" name="phone_number" class="form-control" placeholder="<?php echo $current_user_info['phone_number'] ?>" required>
                                            <button type="submit" name="change_phone" class="btn btn-primary mt-3 float-right">Update</button>
                                        </form>
                                    </div>
                                    <div class="tab-pane fade" id="list-email" role="tabpanel" aria-labelledby="list-email-list">
                                        <form action="action.php" method="post">
                                            <input type="text" name="email" class="form-control" placeholder="<?php echo $current_user_info['email'] ?>" required>
                                            <button type="submit" name="change_email" class="btn btn-primary mt-3 float-right">Update</button>
                                        </form>
                                    </div>
                                    <div class="tab-pane fade" id="list-password" role="tabpanel" aria-labelledby="list-password-list">
                                        <form action="action.php" method="post">
                                            <input type="password" name="current_password" class="form-control" placeholder="Current Password" required>
                                            <input type="password" name="new_password" class="form-control mt-3" placeholder="New Password *More than 7 letters, Alphabet and Numbers" required>
                                            <input type="password" name="confirm_password" class="form-control mt-3" placeholder="Confirm Password *Same Password above" required>
                                            <input type="hidden" name="session_id" value="<?php echo $_SESSION['login_id'] ?>">
                                            <button type="submit" name="change_password" class="btn btn-primary mt-3 float-right">Update</button>
                                        </form>
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