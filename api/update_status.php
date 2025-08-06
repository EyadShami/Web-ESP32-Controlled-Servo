<?php require '../config.php';
$pdo->exec("UPDATE run SET status=0 WHERE id=1");
echo '{"ok":true}';
