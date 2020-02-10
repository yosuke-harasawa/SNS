<?php
    include 'classes/SNS.php';
    $SNS = new SNS;
    $post_id = $_GET['post_id'];

    $SNS->deleteMyPost($post_id);
?>