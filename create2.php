<?php 
    include 'mysql.php';

    session_start();    

    $filtered = [
        "title" => mysqli_real_escape_string($con,$_POST['title']),
        "content" => mysqli_real_escape_string($con,$_POST['content'])
    ];

    $sql = "
        insert into board(
            title, writer, content, date
        )
        values(
            '{$filtered['title']}',
            '{$_SESSION['id']}',
            '{$filtered['content']}',
            now()
        )
    ";

    $result = mysqli_query($con,$sql);

    if($result){
        header("location: index.php");
    }else{
        echo mysqli_error($con);
    }
?>