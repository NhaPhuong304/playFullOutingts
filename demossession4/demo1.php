<?php 
    require_once 'products.php';
?>
<h3>Product List</h3>
<table border = '1'>
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Quantity</th>
        <th>Price</th>
        <th>Photo</th>
        <th>Action</th>
    </tr>
    <?php foreach ($products as $product){?>
        <tr>
            <td><?= $product['id'] ?> </td>
            <td><?= $product['name'] ?> </td>
            <td><?= $product['quantity'] ?> </td>
            <td><?= $product['price'] ?> </td>
            <td> <img src="images/<?= $product['photo'] ?>" alt="" height="50" width="50"> </td>
            <td><a href="index.php?page=detail&id= <?= $product['id']?>">Chi tiet</a></td>
        </tr>
    <?php } ?>
</table>