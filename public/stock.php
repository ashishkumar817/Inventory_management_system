<?php include("../includes/header.php"); ?>
<?php include("../config/db.php"); ?>

<div class="container mt-4">
    <h2 class="mb-4">Stock Management</h2>

    <!-- Add Stock Form -->
    <form method="POST" action="../actions/add_stock.php" class="mb-4">
        <div class="row g-2 align-items-center">
            <div class="col-md-3">
                <select name="product_id" class="form-control" required>
                    <option value="">Select Product</option>
                    <?php
                    $products = $conn->query("SELECT * FROM product");
                    if ($products) {
                        while ($prod = $products->fetch_assoc()):
                    ?>
                    <option value="<?= $prod['product_id'] ?>"><?= $prod['p_name'] ?></option>
                    <?php endwhile; } else { echo "Error fetching products: " . $conn->error; } ?>
                </select>
            </div>
            <div class="col-md-3">
                <input type="number" name="quantity_added" class="form-control" required min="1" placeholder="Quantity Added">
            </div>
            <div class="col-md-3">
                <input type="date" name="date_added" class="form-control" required>
            </div>
            <div class="col-md-3">
                <select name="supplier_id" class="form-control" required>
                    <option value="">Select Supplier</option>
                    <?php
                    $suppliers = $conn->query("SELECT * FROM supplier");
                    if ($suppliers) {
                        while ($sup = $suppliers->fetch_assoc()):
                    ?>
                    <option value="<?= $sup['supplier_id'] ?>"><?= $sup['s_name'] ?></option>
                    <?php endwhile; } else { echo "Error fetching suppliers: " . $conn->error; } ?>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">Add Stock</button>
            </div>
        </div>
    </form>

    <!-- Stock Table -->
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Stock ID</th>
                <th>Product</th>
                <th>Quantity Added</th>
                <th>Date Added</th>
                <th>Supplier</th>
                <th style="width: 300px;">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Fetching all stock entries
            $stock = $conn->query("SELECT s.*, p.p_name, sup.s_name FROM stock s
                                   LEFT JOIN product p ON s.product_id = p.product_id
                                   LEFT JOIN supplier sup ON s.supplier_id = sup.supplier_id");
            if ($stock) {
                while ($row = $stock->fetch_assoc()):
            ?>
            <tr>
                <td><?= $row['stock_id'] ?></td>
                <td><?= $row['p_name'] ?></td>
                <td><?= $row['quantity_added'] ?></td>
                <td><?= $row['date_added'] ?></td>
                <td><?= $row['s_name'] ?></td>
                <td>
                    <!-- Update Form -->
                    <form action="../actions/update_stock.php" method="POST" class="d-inline-flex flex-wrap gap-1 mb-1">
                        <input type="hidden" name="stock_id" value="<?= $row['stock_id'] ?>">
                        <select name="product_id" class="form-select form-select-sm" required>
                            <?php
                            // Refetch products for the update form
                            $products->data_seek(0); // Reset the product pointer
                            while ($prod = $products->fetch_assoc()):
                            ?>
                            <option value="<?= $prod['product_id'] ?>" <?= $prod['product_id'] == $row['product_id'] ? 'selected' : '' ?>>
                                <?= $prod['p_name'] ?>
                            </option>
                            <?php endwhile; ?>
                        </select>
                        <input type="number" name="quantity_added" value="<?= $row['quantity_added'] ?>" class="form-control form-control-sm" required min="1">
                        <input type="date" name="date_added" value="<?= $row['date_added'] ?>" class="form-control form-control-sm" required>
                        <select name="supplier_id" class="form-select form-select-sm" required>
                            <?php
                            // Refetch suppliers for the update form
                            $suppliers->data_seek(0); // Reset the supplier pointer
                            while ($sup = $suppliers->fetch_assoc()):
                            ?>
                            <option value="<?= $sup['supplier_id'] ?>" <?= $sup['supplier_id'] == $row['supplier_id'] ? 'selected' : '' ?>>
                                <?= $sup['s_name'] ?>
                            </option>
                            <?php endwhile; ?>
                        </select>
                        <button class="btn btn-sm btn-success">Update</button>
                    </form>

                    <!-- Delete Form -->
                    <form action="../actions/delete_stock.php" method="POST" class="d-inline">
                        <input type="hidden" name="stock_id" value="<?= $row['stock_id'] ?>">
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this stock record?')">Delete</button>
                    </form>
                </td>
            </tr>
            <?php endwhile; } else { echo "Error fetching stock: " . $conn->error; } ?>
        </tbody>
    </table>
</div>

<?php include("../includes/footer.php"); ?>
