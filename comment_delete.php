<?php 
    include 'mysql.php';

    $num  = mysqli_real_escape_string($con,$_POST['num']);
    $sql = "
        delete from comment where id = {$num}
    ";
    $result = mysqli_query($con,$sql);

?>