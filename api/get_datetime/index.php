<?php
require_once('../inc/authentication.php');

$now = new DateTime();
echo json_encode([
    'status' => 'SUCCESS',
    'message' => $now->format('Y-m-d H:i:s')
]);
