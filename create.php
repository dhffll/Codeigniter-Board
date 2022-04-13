<?php 
    include 'header.php';
?>
    <h1><a href="index.php">Board</a></h1>

    <form action="create2.php" method="POST">
        <p><input type="text" name="title" placeholder="title"></p>
        <textarea name="content" placeholder="content"></textarea>
        <p><input type="submit" value="submit"></p>
    </form>

    <a href="index.php">cancel</a>

<?php 
    include 'footer.php';
?>