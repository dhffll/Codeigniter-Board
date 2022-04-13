<?php 
    include 'mysql.php';

    if(!empty($_POST['id'])){
        $filtered=[
            'id' => mysqli_real_escape_string($con,$_POST['id']),
            'pw' => mysqli_real_escape_string($con,$_POST['pw'])
        ];
        $sql = "select password from member where id = '{$filtered['id']}'";
        $result = mysqli_query($con,$sql);
        
        $num = mysqli_num_rows($result);
        if($num==0){
            echo "<script> alert('로그인 실패'); </script>";
        }
        while($row = mysqli_fetch_array($result)){
            if($filtered['pw'] == $row['password']){
                session_start();
                $_SESSION['id'] = $filtered['id'];
                header("location: index.php");
            }else{
                echo "<script> alert('로그인 실패'); </script>";
            }
        }
    }

    include 'header.php';
?>

<h1><a href="index.php">Board</a></h1>
<form action="login.php" method="POST">
    <p><input type="id" name="id" id='id' placeholder="id" autocomplete="off" required></p>
    <p><input type="password" name="pw" id='pw' placeholder="pw" autocomplete="off" required></p>
    <p><input type="submit" id="submit" value="login"></p>
</form>

<?php 
    include 'footer.php';
?>