<form action="demo5.php" method="post">
    Email1 <input type="text" name="emails[]" value="<?= isset($_POST['emails']) ? $_POST['emails'][0] : '' ?>">
    <br>
    Email2 <input type="text" name="emails[]"value="<?= isset($_POST['emails']) ? $_POST['emails'][1] : '' ?>">
    <br>
    Email3 <input type="text" name="emails[]"value="<?= isset($_POST['emails']) ? $_POST['emails'][2] : '' ?>">
    <br>
    <button type="submit">Submit</button>
</form>

<?php 
    if(isset($_POST['emails'])){
        $emails = $_POST['emails'];
        print_r($emails);
        echo '<br>';
        foreach($emails as $email){
            echo $email . '<br>';
        }
    }
?>