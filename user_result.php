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
      .view-searched-user{
        position: relative;
        left: 360px;
      }
    </style>
  </head>

  <body>
      <div class="container-fluid mt-3">
          <div class="row">
              <?php include 'user_menu.php'; ?>

              <div class="view-searched-user col-lg-6">
                  <?php
                    $user_list = $_SESSION['searched_users'];
                    // print_r($user_list);
                    foreach($user_list as $row):
                  ?>
                  <div class="card my-2">
                      <div class="card-header border-bottom-0">
                            <a href="others_profile.php?user_id=<?php echo $row['user_id'] ?>">
                                <img src="uploads/<?php echo $row['icon']; ?>" alt="" class="rounded-circle mr-2" style="width: 50px; height: 50px;">
                            </a>
                            <a href="others_profile.php?user_id=<?php echo $row['user_id'] ?>">
                                <?php echo $row['username']; ?>
                            </a>
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