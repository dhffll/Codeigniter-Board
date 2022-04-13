<?php
    include 'mysql.php';

    session_start();
    
    $filtered=[
        'pw' => mysqli_real_escape_string($con,$_POST['pw']),
        'new_pw' => mysqli_real_escape_string($con,$_POST['new_pw']),
        'new_pw2' => mysqli_real_escape_string($con,$_POST['new_pw2'])
    ];

    $sql = "
        select password from member where id = '{$_SESSION['id']}'
    ";

    $result = mysqli_query($con,$sql);
    $row = mysqli_fetch_array($result);

    if($filtered['pw'] == $row['password']){
        if($filtered['new_pw'] == $filtered['new_pw2']){
            $sql = "
                update member set
                    password = '{$filtered['new_pw']}'
                where
                    id = '{$_SESSION['id']}'  
            ";

            $result = mysqli_query($con,$sql);

            if($result){
                echo "success!";
                echo "<a href='login.php'>다시 로그인하기</a>";
                session_destroy();
                
            }else{
                echo mysqli_error($con);
                echo 'A problem has occured.';
            }
        }else{
            echo "<script>
                alert('새로운 비밀번호가 일치하지 않습니다.');
                location.href='change_info.php';
            </script>";
        }
    }else{
        echo "<script>
            alert('기존 비밀번호가 일치하지 않습니다.');
            location.href='change_info.php';
        </script>";
    }
?>