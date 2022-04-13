<?php 
    session_start();
    include 'mysql.php';
    include 'header.php';
    include 'index_paging.php';
?>

<link rel="stylesheet" href="css/style.css">

    <h1><a href="index.php">Board</a></h1><br>
    
    <?php 
        if(empty($_SESSION['id'])){
    ?>        
       <a href='login.php'>login</a>
       <a href='resister.php'>signup</a>
    <?php 
        }else{
    ?>
        <span>Welcome, <?=$_SESSION['id']?>!</span>
        <a href='create.php'>write</a>
        <a href='logout.php'>logout</a>
        <a href="change_info.php">info</a>
    <?php         
        }
    ?>
    <br><br>
    <form action="index.php" method="GET">
        <input type="hidden" name="search" value="<?=$search?>">
        <select name="sort" id="sort" onchange="this.form.submit()">
            <option value="1" selected>최신순</option>
            <option value="2">오래된순</option>
        </select>
    </form>
    
    <form action="index.php" method='GET'>
        <input type="text" name="search" id="search" autocomplete="off" value="<?=$search?>">
        <input type="submit" value="검색">
    </form>
    <br>
    <table>
        <tr>
            <td>날짜</td>
            <td style="width:200px">글제목</td>
            <td>작성자</td>
        </tr>
        
        <?php  
            if($total_data!=0){
                while($row = mysqli_fetch_array($result)){
                    $filtered = [
                        'date' => date('m-d',strtotime(htmlspecialchars($row['date']))),
                        'title' => htmlspecialchars($row['title']),
                        'writer' => htmlspecialchars($row['writer']),
                        'num' =>htmlspecialchars($row['num'])
                    ];
                    $today = date('m-d');
                    if($filtered['date'] == $today){
                        $filtered['date'] = date('H:i',strtotime(htmlspecialchars($row['date'])));
                    }
                    
                    //댓글 개수
                    $sql2 = "select * from comment where post = {$filtered['num']}";
                    $result2 = mysqli_query($con,$sql2);
                    $cnt = mysqli_num_rows($result2);
        ?>

        <tr>
            <td><?=$filtered['date']?></td>
            <td><a href="list.php?num=<?=$filtered['num']?>"><?=$filtered['title']?><span id="cnt">[<?=$cnt?>]</span></a></td>
            <td><?=$filtered['writer']?></td>
        </tr>

        <?php 
                }
            }else{
        ?> 
        <tr>
            <td class="empty" colspan="3">게시물이 없습니다</td>
        </tr>
        <?php        
            }    
        ?> 
    </table>

    <br>

    <div id="block">
        <a href="index.php?page=1&&sort=<?=$sort?>&&search=<?=$search?>">처음으로</a></a>

        <?php if($page_now<=1){ ?>
        <a href="index.php?page=1&&sort=<?=$sort?>&&search=<?=$search?>">이전</a>
        <?php }else{ ?>
        <a href="index.php?page=<?=($page_now-1)?>&&sort=<?=$sort?>&&search=<?=$search?>">이전</a>

        <?php } for($i=$start; $i<=$end; $i++){ ?>
            <a href="index.php?page=<?=$i?>&&sort=<?=$sort?>&&search=<?=$search?>"><?=$i?></a>

        <?php } if($page_now>=$page_total){ ?>
            <a href="index.php?page=<?=$page_now?>&&sort=<?=$sort?>&&search=<?=$search?>">다음</a>
        <?php }else{ ?>   
            <a href="index.php?page=<?=($page_now+1)?>&&sort=<?=$sort?>&&search=<?=$search?>">다음</a>
        <?php } ?>   

        <a href="index.php?page=<?=$page_total?>&&sort=<?=$sort?>&&search=<?=$search?>">마지막으로</a></a>
    </div>

<script src="js/jquery.min.js"></script>
<script src="js/script.js"></script>
<script>
    
</script>
<?php 
    include 'footer.php';
?>