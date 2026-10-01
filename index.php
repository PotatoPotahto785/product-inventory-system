<?php
include "db.php";
$search = isset($_GET['q']) ? trim($_GET['q']) : "";
if ($search !== "") {
    $like = "%" . $search . "%";
    $stmt = $conn->prepare("SELECT * FROM products WHERE name LIKE ? OR category LIKE ? ORDER BY id DESC");
    $stmt->bind_param("ss", $like, $like);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $result = $conn->query("SELECT * FROM products ORDER BY id DESC");
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Product Inventory</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
  <h1>Product Inventory Management System</h1>
  <?php if (isset($_GET['msg'])): ?>
    <div class="msg"><?= htmlspecialchars($_GET['msg']) ?></div>
  <?php endif; ?>
  <a class="btn add" href="add.php">+ Add Product</a>
  <form class="search" method="get">
    <input type="text" name="q" placeholder="Search name or category" value="<?= htmlspecialchars($search) ?>">
    <button class="btn back" type="submit">Search</button>
  </form>
  <table>
    <tr><th>ID</th><th>Name</th><th>Category</th><th>Qty</th><th>Price</th><th>Actions</th></tr>
    <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
      <td><?= $row['id'] ?></td>
      <td><?= htmlspecialchars($row['name']) ?></td>
      <td><?= htmlspecialchars($row['category']) ?></td>
      <td><?= $row['quantity'] ?></td>
      <td>₱<?= number_format($row['price'], 2) ?></td>
      <td>
        <a class="btn edit" href="edit.php?id=<?= $row['id'] ?>">Edit</a>
        <a class="btn del" href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Delete this product?')">Delete</a>
      </td>
    </tr>
    <?php endwhile; ?>
  </table>
</div>
</body>
</html>
