<?php include("../config/db.php"); include("../includes/header.php"); ?>
<?php
$id = $_GET['id'];
$product = $conn->query("SELECT * FROM product WHERE product_id = $id")->fetch_assoc();
?>
<div class="container mt-4">
    <h3>Edit Product</h3>
    <form action="../actions/update_product.php" method="POST">
        <input type="hidden" name="product_id" value="<?= $product['product_id'] ?>">
        <input type="text" name="p_name" class="form-control mb-2" value="<?= $product['p_name'] ?>" required>
        <textarea name="description" class="form-control mb-2"><?= $product['description'] ?></textarea>
        <input type="number" step="0.01" name="price" class="form-control mb-2" value="<?= $product['price'] ?>" required>
        <input type="number" name="quantity_in_stock" class="form-control mb-2" value="<?= $product['quantity_in_stock'] ?>" required>
        <button class="btn btn-primary" type="submit">Update</button>
        <a href="products.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
<?php include("../includes/footer.php"); ?>
