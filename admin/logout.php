<?php
session_start();

// remove user from the session
unset($_SESSION['id_admin']);
unset($_SESSION['username']);

header('Location: index.php');
