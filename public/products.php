<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
?>

<?php include("../config/db.php"); ?>
<?php include("../includes/header.php"); ?>


<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Product Management</h3>
        <a href="add_product.php" class="btn btn-primary">Add Product</a>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th><th>Name</th><th>Description</th><th>Price</th><th>Stock</th><th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $result = $conn->query("SELECT * FROM product");
        while ($row = $result->fetch_assoc()):
        ?>
        <tr>
            <td><?= $row['product_id'] ?></td>
            <td><?= $row['p_name'] ?></td>
            <td><?= $row['description'] ?></td>
            <td>$<?= number_format($row['price'], 2) ?></td>
            <td><?= $row['quantity_in_stock'] ?></td>
            <td>
                <a href="edit_product.php?id=<?= $row['product_id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                <a href="../actions/delete_product.php?id=<?= $row['product_id'] ?>" onclick="return confirm('Delete this product?')" class="btn btn-sm btn-danger">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php include("../includes/footer.php"); ?>
