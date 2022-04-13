<?php 
    include 'mysql.php';

    $filtered_num = mysqli_real_escape_string($con,$_POST['num']);

    $sql = "
        delete from board
        where num = $filtered_num
    ";

    $result = mysqli_query($con,$sql);

    if($result){
        header("location: index.php");
    }else{
        echo mysqli_error($con);
    }
?>