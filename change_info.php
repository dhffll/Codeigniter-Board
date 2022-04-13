<?php 
    include 'header.php';
?>
    <form action="change_info2.php" method="POST">
        <p><input type="password" name="pw" id='pw' placeholder="password"></p>
        <p><input type="password" name="new_pw" id="new_pw" placeholder="new password"></p>
        <p><input type="password" name="new_pw2" id="new_pw2" placeholder="new password confirm"></p>
        <p><input type="submit" value="change"></p>
    </form>

<?php 
    include 'footer.php';
?>