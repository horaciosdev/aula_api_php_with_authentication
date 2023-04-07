<?php

// check if user and pass exist
if (
    !isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW'])
    || empty($_SERVER['PHP_AUTH_USER']) || empty($_SERVER['PHP_AUTH_PW'])
) {
    echo json_encode([
        'status' => 'ERROR',
        'message' => 'Invalid access.'
    ]);
    exit();
}

// check if user and pass are valid
require_once('config.php');
require_once('database.php');

$db = new Database();

$params = [
    ':access_key' => $_SERVER['PHP_AUTH_USER'],
];

$results = $db->EXE_QUERY('SELECT * FROM `authentication` WHERE access_key = :access_key', $params);

$message = 'Invalid authentication credentials.';
if (count($results) > 0) {
    // check if password is valid
    $user = $results[0];
    if (password_verify($_SERVER['PHP_AUTH_PW'], $user['passwrd'])) {
        if (!empty($user['deleted_at'])) {
            $valid_authentication = false;
            $message = 'Your account has been deactivated. Please contact your administrator.';
        } else {
            $valid_authentication = true;
        }
    } else {
        $valid_authentication = false;
    }
} else {
    $valid_authentication = false;
}

// if user and pass are not valid return error
if (!$valid_authentication) {
    echo json_encode([
        'status' => 'ERROR',
        'message' => $message
    ]);
    exit();
}
