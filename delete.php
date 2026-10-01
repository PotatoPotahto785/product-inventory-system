<?php
include "db.php";
$id = (int)($_GET['id'] ?? 0);
$stmt = $conn->prepare("DELETE FROM products WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
header("Location: index.php?msg=Product deleted successfully");
exit;
