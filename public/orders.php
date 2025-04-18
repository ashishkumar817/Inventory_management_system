<?php include("../includes/header.php"); ?>
<?php include("../config/db.php"); ?>

<div class="container mt-4">
    <h2 class="mb-4">Order Management</h2>

    <!-- Add Order Form -->
    <form method="POST" action="../actions/add_order.php" class="mb-4">
        <div class="row g-2 align-items-center">
            <div class="col-md-3">
                <select name="customer_id" class="form-control" required>
                    <option value="">Select Customer</option>
                    <?php
                    $customers = $conn->query("SELECT * FROM customers");
                    if ($customers) {
                        while ($cust = $customers->fetch_assoc()):
                    ?>
                    <option value="<?= $cust['customer_id'] ?>"><?= $cust['name'] ?></option> <!-- Updated 'c_name' to 'name' -->
                    <?php endwhile; } else { echo "Error fetching customers: " . $conn->error; } ?>
                </select>
            </div>
            <div class="col-md-3">
                <input type="date" name="order_date" class="form-control" required>
            </div>
            <div class="col-md-3">
                <select name="status" class="form-control" required>
                    <option value="Processing">Processing</option>
                    <option value="Completed">Completed</option>
                    <option value="Cancelled">Cancelled</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">Add Order</button>
            </div>
        </div>
    </form>

    <!-- Orders Table -->
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Customer</th>
                <th>Date</th>
                <th>Status</th>
                <th style="width: 300px;">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Fetching orders with customer name correctly
            $orders = $conn->query("SELECT o.*, c.name FROM order_ o LEFT JOIN customers c ON o.customer_id = c.customer_id");
            if ($orders) {
                while ($row = $orders->fetch_assoc()):
            ?>
            <tr>
                <td><?= $row['order_id'] ?></td>
                <td><?= $row['name'] ?></td> <!-- Updated 'c_name' to 'name' -->
                <td><?= $row['order_date'] ?></td>
                <td><?= $row['status'] ?></td>
                <td>
                    <!-- Update Form -->
                    <form action="../actions/update_order.php" method="POST" class="d-inline-flex flex-wrap gap-1 mb-1">
                        <input type="hidden" name="id" value="<?= $row['order_id'] ?>">
                        <select name="customer_id" class="form-select form-select-sm" required>
                            <?php
                            $customers->data_seek(0); // Reset the customer result set pointer to reuse
                            while ($cust = $customers->fetch_assoc()):
                            ?>
                            <option value="<?= $cust['customer_id'] ?>" <?= $cust['customer_id'] == $row['customer_id'] ? 'selected' : '' ?>>
                                <?= $cust['name'] ?> <!-- Updated 'c_name' to 'name' -->
                            </option>
                            <?php endwhile; ?>
                        </select>
                        <input type="date" name="order_date" value="<?= $row['order_date'] ?>" class="form-control form-control-sm" required>
                        <select name="status" class="form-select form-select-sm" required>
                            <option <?= $row['status'] == 'Processing' ? 'selected' : '' ?>>Processing</option>
                            <option <?= $row['status'] == 'Completed' ? 'selected' : '' ?>>Completed</option>
                            <option <?= $row['status'] == 'Cancelled' ? 'selected' : '' ?>>Cancelled</option>
                        </select>
                        <button class="btn btn-sm btn-success">Update</button>
                    </form>

                    <!-- Delete Form -->
                    <form action="../actions/delete_order.php" method="POST" class="d-inline">
                        <input type="hidden" name="id" value="<?= $row['order_id'] ?>">
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this order?')">Delete</button>
                    </form>
                </td>
            </tr>
            <?php endwhile; } else { echo "Error fetching orders: " . $conn->error; } ?>
        </tbody>
    </table>
</div>

<?php include("../includes/footer.php"); ?>
