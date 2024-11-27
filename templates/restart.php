<?php
session_start();
session_destroy();
session_start();
$_SESSION['hearts'] = 3;
$_SESSION['used_questions'] = [];

header('Content-Type: application/json');
echo json_encode(['success' => true]);
?>