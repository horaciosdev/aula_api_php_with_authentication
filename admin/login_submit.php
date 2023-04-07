<?php defined("ROOT") or die("<p>Invalid access</p>"); ?>

<?php

// check if all data needed to authenticantion is provided
// -- check request method
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    die('<p>Invalid access</p>');
}

$user = $_POST['text_user'];
$password = $_POST['text_password'];

if (empty($user) || empty($password)) {
    $_SESSION['error'] = 'All fields are required';
    header('Location: index.php');
    return;
}

// connect to the database
$db = new database();
$params = [
    ':user' => $user,
];

$restults = $db->EXE_QUERY('SELECT * FROM admin_users WHERE username = :user', $params);

if (count($restults) == 0) {
    $_SESSION['error'] = 'Invalid username or password';
    header('Location: index.php');
    return;
}

// validate the password
if (!password_verify($password, $restults[0]['passwrd'])) {
    $_SESSION['error'] = 'Invalid username or password';
    header('Location: index.php');
    return;
}

// create a session
$_SESSION['id_admin'] = $restults[0]['id_admin'];
$_SESSION['username'] = $restults[0]['username'];

// redirect to index.php
header('Location: index.php');


?>