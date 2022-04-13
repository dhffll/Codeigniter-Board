<?php
    include 'header.php';
?>
    <h1>Resister</h1>
    <form action="resister2.php" method="POST" onsubmit="return check()">
        <p><input type="text" name="id" id="id" placeholder="id" autocomplete="off"></p>
        <a href="javascript:void(0)" id="test" onclick="test()">id 중복 확인</a>
        <div id="info"></div>
        
        <p><input type="password" name="pw" id="pw" placeholder="pw" autocomplete="off"></p>
        <p><input type="password" name="pw2" id="pw2" placeholder="pw confirm"></p>
        <p><input type="submit" value="resister"></p>
    </form>
    <a href="index.php">cancel</a>
</body>

<script src="js/jquery.min.js"></script>
<script src="js/resister.js"></script>

<?php 
    include 'footer.php';
?>