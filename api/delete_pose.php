<?php require '../config.php';
$id = (int)($_GET['id'] ?? 0);
$pdo->prepare("DELETE FROM pose WHERE id=?")->execute([$id]);
echo '{"ok":true}';
