<a href="index.php?page=home">Home</a>
<a href="index.php?page=about_us">About Us</a>
<a href="index.php?page=news">News</a>
<a href="index.php?page=demo1">Products</a>
<br><br>
<?php 
   require_once  (isset($_GET['page'])? $_GET['page'] . '.php' : "home.php");
?>
<br><br>
Copy Right