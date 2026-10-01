<?php
include "db.php";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST['name']);
    $category = trim($_POST['category']);
    $quantity = (int)$_POST['quantity'];
    $price = (float)$_POST['price'];
    $stmt = $conn->prepare("INSERT INTO products (name, category, quantity, price) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssid", $name, $category, $quantity, $price);
    $stmt->execute();
    header("Location: index.php?msg=Product added successfully");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Add Product</title><link rel="stylesheet" href="style.css"></head>
<body>
<div class="container">
  <h1>Add Product</h1>
  <form method="post">
    <label>Product Name</label><input type="text" name="name" required>
    <label>Category</label><input type="text" name="category" required>
    <label>Quantity</label><input type="number" name="quantity" min="0" required>
    <label>Price</label><input type="number" name="price" step="0.01" min="0" required>
    <br><button class="btn add" type="submit">Save</button>
    <a class="btn back" href="index.php">Cancel</a>
  </form>
</div>
</body>
</html>
