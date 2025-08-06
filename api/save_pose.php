<?php require '../config.php';
$d = json_decode(file_get_contents('php://input'), true);
$q = $pdo->prepare("INSERT INTO pose(servo1,servo2,servo3,servo4,servo5,servo6)
                    VALUES(?,?,?,?,?,?)");
$q->execute($d);
echo '{"ok":true}';
