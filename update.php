<?php 
    include 'mysql.php';

    $filtered_num = mysqli_real_escape_string($con, $_GET['num']);

    $sql = "
        select * from board where num = $filtered_num;
    ";

    $result = mysqli_query($con,$sql);

    $row = mysqli_fetch_array($result);

    $filtered = [
        'date' => htmlspecialchars($row['date']),
        'title' => htmlspecialchars($row['title']),
        'content' => htmlspecialchars($row['content']),
        'writer' => htmlspecialchars($row['writer']),
    ];

    include 'header.php';
?>

    <form action="update2.php" method="POST">
        <p><input type="hidden" name="num" value="<?=$filtered_num?>"></p>
        <p>title : <input type="text" name="title" value="<?=$filtered['title']?>"></p>
        <p>content : <textarea name="content"><?=$filtered['content']?></textarea></p>
        <input type="submit" value="update">
    </form>

    <a href="list.php?num=<?=$filtered_num?>">cancel</a>

<?php 
    include 'footer.php';
?>