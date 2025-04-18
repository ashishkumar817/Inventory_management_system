<?php include("../includes/header.php"); ?>
<div class="container mt-4">
    <h3>Add New Product</h3>
    <form action="../actions/insert_product.php" method="POST">
        <input type="text" name="p_name" class="form-control mb-2" placeholder="Product Name" required>
        <textarea name="description" class="form-control mb-2" placeholder="Description"></textarea>
        <input type="number" step="0.01" name="price" class="form-control mb-2" placeholder="Price" required>
        <input type="number" name="quantity_in_stock" class="form-control mb-2" placeholder="Quantity in Stock" required>
        <button class="btn btn-success" type="submit">Save</button>
        <a href="products.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
<?php include("../includes/footer.php"); ?>

