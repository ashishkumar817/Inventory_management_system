<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: ../login/index.php");
    exit();
}
include '../includes/db.php';
include '../includes/header.php';
?>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
    body {
        font-family: 'Segoe UI', sans-serif;
        background-color: #f0f2f5;
        margin: 0;
        padding: 0;
    }

    .main-content {
                
        padding: 2px;
        box-sizing: border-box;
    }

    .main-content h2 {
        font-size: 2rem;
        color: #2c3e50;
        margin-bottom: 1.5rem;
    }

    .card-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 1rem;
        margin-bottom: 3rem;
    }

    .card {
    color: #fff;
    border-radius: 10px;
    padding: 1.2rem 1rem;
    box-shadow: 0 6px 14px rgba(0, 0, 0, 0.05);
    display: flex;
    flex-direction: column;
    justify-content: center;
    transition: 0.3s ease;
    position: relative;
    overflow: hidden;
    }
    .card:hover {
        box-shadow: 0 8px 18px rgba(0, 0, 0, 0.08);
        transform: translateY(-2px);
    }

    .card h3 {
    font-size: 1rem;
    margin-bottom: 0.3rem;
    font-weight: 500;
    }


    .card p {
    font-size: 1.6rem;
    font-weight: bold;
    margin: 0;
    }

    .card.customers {
    background: linear-gradient(to right, #4facfe, #00f2fe);
    }

    .card.products {
    background: linear-gradient(to right, #43e97b, #38f9d7);
    }

    .card.suppliers {
    background: linear-gradient(to right, #a18cd1, #fbc2eb);
    }

    .card.orders {
    background: linear-gradient(to right, #f7971e, #ffd200);
    }

    .section {
        margin-bottom: 3rem;
    }

    .section h3 {
        font-size: 1.25rem;
        color: #2d3436;
        margin-bottom: 1rem;
        padding-left: 4px;
    }

    .table-wrapper {
        overflow-x: auto;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.04);
        overflow: hidden;
        min-width: 600px;
    }

    .table th, .table td {
        padding: 14px 18px;
        text-align: left;
        border-bottom: 1px solid #f0f0f0;
        font-size: 0.95rem;
        white-space: nowrap;
    }

    .table th {
        background-color: #fafafa;
        color: #333;
    }

    .table tbody tr:hover {
        background-color: #f7f7f7;
    }

    .status {
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 500;
        display: inline-block;
    }

    .status.Completed {
        background-color: #d4edda;
        color: #155724;
    }

    .status.Processing {
        background-color: #fff3cd;
        color: #856404;
    }

    .status.Cancelled {
        background-color: #f8d7da;
        color: #721c24;
    }
    .form-select {
    width: 40%;
    }
    .form-control {
    width: 60%;
    }

    @media (max-width: 768px) {
        .main-content {
            margin-left: 0;
            padding: 1rem;
        }

        .main-content h2 {
            font-size: 1.5rem;
        }

        .card p {
            font-size: 1.2rem;
        }

        .table th, .table td {
            font-size: 0.85rem;
            padding: 12px;
        }
    }
</style>

<div class="main-content">
    <h2>Admin Dashboard</h2>
    <div class="card-container">
        <?php
        $customer_result = $conn->query("SELECT COUNT(*) AS total FROM customers");
        $customer_data = $customer_result ? $customer_result->fetch_assoc() : ['total' => 'N/A'];

        $product_result = $conn->query("SELECT COUNT(*) AS total FROM product");
        $product_data = $product_result ? $product_result->fetch_assoc() : ['total' => 'N/A'];

        $supplier_result = $conn->query("SELECT COUNT(*) AS total FROM supplier");
        $supplier_data = $supplier_result ? $supplier_result->fetch_assoc() : ['total' => 'N/A'];

        $order_result = $conn->query("SELECT COUNT(*) AS total FROM order_");
        $order_data = $order_result ? $order_result->fetch_assoc() : ['total' => 'N/A'];
        ?>

    <div class="card customers">
    <h3>Total Customers</h3>
    <p><?= $customer_data['total']; ?></p>
    </div>

    <div class="card products">
    <h3>Total Products</h3>
    <p><?= $product_data['total']; ?></p>
    </div>

    <div class="card suppliers">
    <h3>Total Suppliers</h3>
    <p><?= $supplier_data['total']; ?></p>
    </div>

    <div class="card orders">
    <h3>Total Orders</h3>
    <p><?= $order_data['total']; ?></p>
</div>

    </div>

    <!-- Recent Orders -->
    <div class="section">
        <h3>Recent Orders</h3>
        <div class="table-wrapper">
            <table class="table">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Customer</th>
                        <th>Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $recent_orders = $conn->query("
                        SELECT o.order_id, c.name AS customer_name, o.order_date, o.status 
                        FROM order_ o
                        LEFT JOIN customers c ON o.customer_id = c.customer_id
                        ORDER BY o.order_date DESC
                        LIMIT 5
                    ");
                    while ($row = $recent_orders->fetch_assoc()):
                    ?>
                    <tr>
                        <td><?= $row['order_id'] ?></td>
                        <td><?= $row['customer_name'] ?></td>
                        <td><?= $row['order_date'] ?></td>
                        <td><span class="status <?= $row['status'] ?>"><?= $row['status'] ?></span></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Product Inventory -->
    <div class="section">
        <h3>Product Inventory</h3>
        <div class="table-wrapper">
            <table class="table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Stock</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $products = $conn->query("SELECT p_name, price, quantity_in_stock FROM product ORDER BY p_name ASC LIMIT 5");
                    while ($row = $products->fetch_assoc()):
                    ?>
                    <tr>
                        <td><?= $row['p_name'] ?></td>
                        <td>$<?= number_format($row['price'], 2) ?></td>
                        <td><?= $row['quantity_in_stock'] ?></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Recent Stock Updates -->
    <div class="section">
        <h3>Recent Stock Updates</h3>
        <div class="table-wrapper">
            <table class="table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity Added</th>
                        <th>Date Added</th>
                        <th>Supplier</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $stock_updates = $conn->query("
                        SELECT s.quantity_added, s.date_added, p.p_name, sp.s_name
                        FROM stock s
                        JOIN product p ON s.product_id = p.product_id
                        LEFT JOIN supplier sp ON s.supplier_id = sp.supplier_id
                        ORDER BY s.date_added DESC
                        LIMIT 5
                    ");
                    while ($row = $stock_updates->fetch_assoc()):
                    ?>
                    <tr>
                        <td><?= $row['p_name'] ?></td>
                        <td><?= $row['quantity_added'] ?></td>
                        <td><?= $row['date_added'] ?></td>
                        <td><?= $row['s_name'] ?></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
