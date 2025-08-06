<?php require '../config.php';
$row = $pdo->query("SELECT * FROM run WHERE id=1")->fetch();
/* Return CSV exactly like the screenshot: 0,s190,s290,...  */
echo $row['status'] . ', ' .
     's' . $row['servo1'] . ', ' .
     's' . $row['servo2'] . ', ' .
     's' . $row['servo3'] . ', ' .
     's' . $row['servo4'] . ', ' .
     's' . $row['servo5'] . ', ' .
     's' . $row['servo6'];
