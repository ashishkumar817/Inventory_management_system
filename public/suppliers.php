<?php include("../includes/header.php"); ?>
<?php include("../config/db.php"); ?>

<div class="container mt-4">
    <h2 class="mb-4">Supplier Management</h2>

    <!-- Add Supplier Form -->
    <form method="POST" action="../actions/add_supplier.php" class="mb-4">
        <div class="row g-2 align-items-center">
            <div class="col-md-3">
                <input type="text" name="s_name" class="form-control" placeholder="Name" required>
            </div>
            <div class="col-md-2">
                <input type="text" name="s_contact_no" class="form-control" placeholder="Phone" required>
            </div>
            <div class="col-md-4">
                <input type="text" name="s_addr" class="form-control" placeholder="Address" required>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">Add Supplier</button>
            </div>
        </div>
    </form>

    <!-- Suppliers Table -->
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Address</th>
                <th style="width: 400px;">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $result = $conn->query("SELECT * FROM supplier");
            while ($row = $result->fetch_assoc()):
            ?>
            <tr>
                <td><?= $row['supplier_id'] ?></td>
                <td><?= $row['s_name'] ?></td>
                <td><?= $row['s_contact_no'] ?></td>
                <td><?= $row['s_addr'] ?></td>
                <td>
                    <div class="d-flex flex-column gap-2">
                        <form action="../actions/update_supplier.php" method="POST" class="d-flex flex-wrap gap-2 align-items-center">
                            <input type="hidden" name="id" value="<?= $row['supplier_id'] ?>">
                            <input type="text" name="s_name" value="<?= $row['s_name'] ?>" class="form-control form-control-sm" required>
                            <input type="text" name="s_contact_no" value="<?= $row['s_contact_no'] ?>" class="form-control form-control-sm" required>
                            <input type="text" name="s_addr" value="<?= $row['s_addr'] ?>" class="form-control form-control-sm" required>
                            <button class="btn btn-sm btn-success">Update</button>
                        </form>

                        <form action="../actions/delete_supplier.php" method="POST" class="d-inline">
                            <input type="hidden" name="id" value="<?= $row['supplier_id'] ?>">
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this supplier?')">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php include("../includes/footer.php"); ?>
