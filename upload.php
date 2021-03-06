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
      .upload{
        position: relative;
        left: 360px;
      }
    </style>
  </head>

  <body style="background-color: rgb(21, 32, 42);">
      <div class="container-fluid mt-3">
          <div class="row">
            <?php include 'user_menu.php'; ?>

            <div class="upload col-lg-6 mt-3">
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="file" name="profile_img" style="color: lightslategrey;">
                    <br>
                    <button type="submit" name="upload_icon" class="btn btn-primary mt-3">Upload</button>
                </form>
            </div>
          </div>
      </div>
    <?php
        if(isset($_POST['upload_icon'])){
            $fileName = $_FILES['profile_img']['name'];

            $SNS->uploadUserIcon($_GET['login_id'],$fileName);
        }
    ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>