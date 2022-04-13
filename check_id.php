<?php
    include 'mysql.php';
    
    $filtered = mysqli_real_escape_string($con,$_POST['id']);

    $sql = "
        select * from member where id = '$filtered'
    ";

    $result = mysqli_query($con,$sql);
    $row = mysqli_fetch_array($result);

    if($row['id']==$filtered){
        $send = (int)0; //같은 아이디가 있으면 0을 담아주고
    }else{
        $send = (int)1; //없으면 1을 담아주기
    }
    print($send);
?>