<?php 
    if(!empty($_POST['id'])){
        $con = mysqli_connect('localhost', 'root', 'lotion1023!', 'db00');
        $filtered=[
            'id' => mysqli_real_escape_string($con,$_POST['id']),
            'pw' => mysqli_real_escape_string($con,$_POST['pw'])
        ];
        $sql = "
            insert into member
            (id, password)
            values(
                '{$filtered['id']}',
                '{$filtered['pw']}'
            )
        ";
        $result = mysqli_query($con,$sql);

        if($result){
            echo "success!";
            echo "<a href='login.php'>로그인하기</a>";
        }else{
            echo mysqli_error($con);
        }
    }
?>