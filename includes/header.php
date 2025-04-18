<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            min-height: 100vh;
            display: flex;
        }
        .sidebar {
            width: 250px;
            background-color:rgb(50, 62, 72);
            color: white;
            padding: 20px 10px;
            flex-shrink: 0;
        }
        .sidebar a {
            display: block;
            color: white;
            padding: 10px;
            margin-bottom: 5px;
            text-decoration: none;
            border-radius: 5px;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
        .content {
            flex-grow: 1;
            padding: 20px;
            background-color: #f8f9fa;
        }
        .sidebar h4 {
            
            margin-bottom: 1.5rem;
            font-size: 1.2rem;
            text-align: center;
        }
        .sidebar {
  width: 220px;
  background-color: #1e2a38;
  padding-top: 20px;
  min-height: 100vh;
  color: white;
}

.sidebar-logo {
  text-align: center;
  margin-bottom: 20px;
}

.sidebar-logo img {
  max-width: 100px;
}

.sidebar-menu {
  list-style: none;
  padding-left: 0;
}

.sidebar-menu li {
  margin-bottom: 10px;
}

.sidebar-menu li a {
  display: flex;
  align-items: center;
  padding: 10px 20px;
  color: white;
  text-decoration: none;
  transition: background-color 0.3s;
}

.sidebar-menu li a i {
  margin-right: 12px;
  width: 20px;
  text-align: center;
}

.sidebar-menu li a:hover,
.sidebar-menu li a.active {
  background-color: #32445a;
  border-left: 4px solid #00bcd4;
}

    </style>
</head>
<body>
<!-- Sidebar Menu -->
<div class="sidebar">
<h4>Inventory System</h4>
  <ul class="sidebar-menu">
    <li><a href="index.php"><i class="fas fa-chart-line"></i> Dashboard</a></li>
    <li><a href="products.php"><i class="fas fa-box-open"></i> Products</a></li>
    <li><a href="customers.php"><i class="fas fa-users"></i> Customers</a></li>
    <li><a href="suppliers.php"><i class="fas fa-truck"></i> Suppliers</a></li>
    <li><a href="orders.php"><i class="fas fa-shopping-cart"></i> Orders</a></li>
    <li><a href="stock.php"><i class="fas fa-warehouse"></i> Stock</a></li>
  </ul>
</div>

<div class="content">
