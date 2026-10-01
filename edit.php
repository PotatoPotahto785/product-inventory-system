<?php
include "db.php";
$id = (int)($_GET['id'] ?? $_POST['id'] ?? 0);
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST['name']);
    $category = trim($_POST['category']);
    $quantity = (int)$_POST['quantity'];
    $price = (float)$_POST['price'];
    $stmt = $conn->prepare("UPDATE products SET name=?, category=?, quantity=?, price=? WHERE id=?");
    $stmt->bind_param("ssidi", $name, $category, $quantity, $price, $id);
    $stmt->execute();
    header("Location: index.php?msg=Product updated successfully");
    exit;
}
$stmt = $conn->prepare("SELECT * FROM products WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$p = $stmt->get_result()->fetch_assoc();
if (!$p) { die("Product not found."); }
?>
<!DOCTYPE html>
<html>
<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Edit Product</title><link rel="stylesheet" href="style.css"></head>
<body>
<div class="container">
  <h1>Edit Product</h1>
  <form method="post">
    <input type="hidden" name="id" value="<?= $p['id'] ?>">
    <label>Product Name</label><input type="text" name="name" value="<?= htmlspecialchars($p['name']) ?>" required>
    <label>Category</label><input type="text" name="category" value="<?= htmlspecialchars($p['category']) ?>" required>
    <label>Quantity</label><input type="number" name="quantity" min="0" value="<?= $p['quantity'] ?>" required>
    <label>Price</label><input type="number" name="price" step="0.01" min="0" value="<?= $p['price'] ?>" required>
    <br><button class="btn edit" type="submit">Update</button>
    <a class="btn back" href="index.php">Cancel</a>
  </form>
</div>
</body>
</html>
