<h3>Search Page</h3>
<form action="demo4.php" method="post">
    keyword <input type="text" name="keyword" value="<?= isset($_POST['keyword']) ? $_POST['keyword'] : '' ?>">
    <br>
    <button type="submit">Search</button>
</form>
<?php 
    if (isset($_POST['keyword'])){
        echo 'Keyword: ' . $_POST['keyword'];
    }
?>