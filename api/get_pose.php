<?php require '../config.php';
$id = (int)($_GET['id'] ?? 0);
$q  = $pdo->prepare("SELECT * FROM pose WHERE id=?");
$q->execute([$id]);
echo json_encode($q->fetch());
