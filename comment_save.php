<?php 
    session_start();
    include 'mysql.php';

    $filtered = [
        "post" => mysqli_real_escape_string($con,$_POST['num']),
        "comment" => mysqli_real_escape_string($con,$_POST['comment'])
    ];

    $sql = "
        insert into comment(
            post, writer, comment, date
        )
        values(
            '{$filtered['post']}',
            '{$_SESSION['id']}',
            '{$filtered['comment']}',
            now()
        )
    ";


    $result = mysqli_query($con,$sql);

    $sql2 = "select * from comment where post = {$filtered['post']} and comment = {$filtered['comment']}";

    $result2 = mysqli_query($con,$sql2);

    while($row = mysqli_fetch_array($result2)){
        $filtered2[] = array(
            'writer' => htmlspecialchars($row['writer']),
            'comment' => htmlspecialchars($row['comment']),
            'date' => htmlspecialchars($row['date'])
        );
    }

    $data = json_encode($filtered2, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    print($data);

?>