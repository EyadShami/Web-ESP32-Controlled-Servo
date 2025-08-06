<?php require '../config.php';
echo json_encode($pdo->query("SELECT * FROM pose ORDER BY id DESC")->fetchAll());
