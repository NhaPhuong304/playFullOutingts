<h3>Product Detail Page</h3>
<a href="demo1.php">Back To Product List</a>
<br>
<?php 
require_once 'products.php';
echo 'Id: ' . $_GET['id'];
    $id = $_GET['id'];
    $product = [];
    foreach($products as $p){
        if($p['id'] == $id){
            $product = $p;
        }
    }
?>

<table>
    <tr>
        <td>Id</td>
        <td><?= $product['id']?></td>
    </tr>
    <tr>
        <td>Name</td>
        <td><?= $product['name']?></td>
    </tr>
    <tr>
        <td>Quantity</td>
        <td><?= $product['quantity']?></td>
    </tr>
    <tr>
        <td>Price</td>
        <td><?= $product['price']?></td>
    </tr>
    <tr>
        <td>Photo</td>
        <td> <img src="images/<?= $product['photo'] ?>" alt="" height="50" width="50"> </td>
    </tr>
</table>