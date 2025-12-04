<h3>Save Page</h3>
<a href="demo2.php">Back To Demo2</a>
<br><br>
<?php 
    $keyword = $_GET['keyword'];
    echo 'Keyword: ' . $keyword;
    $username = $_GET['username'];
    echo '<br> Username: ' . $username;
    $password = $_GET['password'];
    echo '<br> Password: ' . $password;
?>