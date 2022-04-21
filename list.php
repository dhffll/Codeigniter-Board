<?php 
    session_start();
    include 'mysql.php';

    //게시글을 보여주기 위한 쿼리
    $filtered_num = mysqli_real_escape_string($con, $_GET['num']);

    $sql = "select * from board left join member on board.writer = member.id where num = $filtered_num";

    $result = mysqli_query($con,$sql);

    $row = mysqli_fetch_array($result);

    $filtered = [
        'date' => htmlspecialchars($row['date']),
        'title' => htmlspecialchars($row['title']),
        'content' => htmlspecialchars($row['content']),
        'writer' => htmlspecialchars($row['id'])
    ];

    include 'header.php';
?>

<link rel="stylesheet" href="css/list.css">

    <p>date : <?=$filtered['date']?></p>
    <p>writer : <?=$filtered['writer']?></p>
    <p>title : <?=$filtered['title']?></p>
    <p>content : <?=$filtered['content']?></p>

    <?php 
        if($_SESSION['id'] == $filtered['writer']){ //작성자 권한
    ?> 
        <a href="update.php?num=<?=$filtered_num?>">update</a>
        <form style="display: inline-block;" action="delete.php" method="POST" id="form" onsubmit="return confirm('정말 삭제하시겠습니까?')">
            <input type="hidden" name="num" value="<?=$filtered_num?>">
            <input type="submit" value="delete">
        </form>
        <br><br>
    <?php       
        }
        if(!empty($_SESSION['id'])){ //로그인 상태라면 댓글 입력 가능
    ?>
    
    <textarea name="comment" id="comment" cols="30" rows="3" placeholder="댓글을 입력해주세요"></textarea>
    <button id="save" onclick="comment_save(<?=$filtered_num?>)">입력</button>
    <?php  
        }
    ?>
    <div id="comment_list">
    <?php 
        //댓글 보여주기 위한 쿼리
        $sql2 = "select * from comment where post = $filtered_num order by date DESC";
        $result2 = mysqli_query($con,$sql2);

        while($row2 = mysqli_fetch_array($result2)){
            $filtered2 = [
                'id' => htmlspecialchars($row2['id']),
                'writer' => htmlspecialchars($row2['writer']),
                'comment' => htmlspecialchars($row2['comment']),
                'date' => date('m-d',strtotime(htmlspecialchars($row2['date'])))
            ];

            $today = date('m-d'); //오늘이면 시간으로 바꿔주기
            if($filtered2['date'] == $today){
                $filtered2['date'] = date('H:i',strtotime(htmlspecialchars($row2['date'])));                
            }
    ?>
        <ul class="box">
            <li><?=$filtered2['writer']?></li>
            <li><?=$filtered2['comment']?></li>
            <li><?=$filtered2['date']?></li>
        </ul>
    <?php
        if($_SESSION['id']==$filtered2['writer']){ //댓글 작성자 권한
    ?> 
        <button onclick="comment_delete(<?=$filtered2['id']?>)">삭제</button>
    <?php       
        }
        }
    ?>
    </div>
    
    <p><a href="index.php">main</a></p>

<script src="js/jquery.min.js"></script>
<script src="js/list.js"></script>

<?php 
    include 'footer.php';
?>
