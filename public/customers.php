<?php include("../includes/header.php"); ?>
<?php include("../config/db.php"); ?>

<h2>Customer Management</h2>

<!-- Add Customer Form -->
<form method="POST" action="../actions/add_customer.php" class="mb-4">
    <div class="row">
        <div class="col-md-3"><input type="text" name="name" class="form-control" placeholder="Name" required></div>
        <div class="col-md-3"><input type="email" name="email" class="form-control" placeholder="Email" required></div>
        <div class="col-md-2"><input type="text" name="phone" class="form-control" placeholder="Phone"  pattern="^\+?\d{1,4}[-\s]?\d{7,14}$"
        title="Enter a valid phone number (e.g., +91-9876543210)" required></div>
        <div class="col-md-3"><input type="text" name="address" class="form-control" placeholder="Address" required></div>
        <div class="col-md-1"><button type="submit" class="btn btn-primary">Add</button></div>
    </div>
</form>

<!-- Display Customers -->
<table class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th>ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Address</th><th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $result = $conn->query("SELECT * FROM customers") or die("Query Error: " . $conn->error);
        while ($row = $result->fetch_assoc()):
        ?>
        <tr>
            <td><?= $row['customer_id'] ?></td>
            <td><?= $row['name'] ?></td>
            <td><?= $row['email'] ?></td>
            <td><?= $row['phone'] ?></td>
            <td><?= $row['address'] ?></td>
            <td>
                <form action="../actions/update_customer.php" method="POST" class="d-inline">
                    <input type="hidden" name="id" value="<?= $row['customer_id'] ?>">
                    <input type="text" name="name" value="<?= $row['name'] ?>" required>
                    <input type="email" name="email" value="<?= $row['email'] ?>" required>
                    <input type="text" name="phone" value="<?= $row['phone'] ?>" required>
                    <input type="text" name="address" value="<?= $row['address'] ?>" required>
                    <button class="btn btn-sm btn-success">Update</button>
                </form>
                <form action="../actions/delete_customer.php" method="POST" class="d-inline">
                    <input type="hidden" name="id" value="<?= $row['customer_id'] ?>">
                    <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this customer?')">Delete</button>
                </form>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<?php include("../includes/footer.php"); ?>
