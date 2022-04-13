<?php 
    session_start();

    $con = mysqli_connect('localhost', 'root', 'lotion1023!', 'db00');

    $filtered_num = htmlspecialchars($_POST['num']);

    $filtered = [
        'title' => mysqli_real_escape_string($con,$_POST['title']),
        'content' => mysqli_real_escape_string($con,$_POST['content'])
    ];

    $sql = "
        update board
        set
            title = '{$filtered['title']}',
            content = '{$filtered['content']}',
            date = now(),
            writer = '{$_SESSION['id']}'
        where num = $filtered_num
    ";


    $result = mysqli_query($con,$sql);

    if($result){
        header("location: list.php?num=$filtered_num");
    }else{
        echo mysqli_error($con);
    }

?>