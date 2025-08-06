<?php require '../config.php';
$d = json_decode(file_get_contents('php://input'), true);
$pdo->prepare("UPDATE run SET
     servo1=?,servo2=?,servo3=?,servo4=?,servo5=?,servo6=?,status=1
     WHERE id=1")->execute($d);
echo '{"ok":true}';
