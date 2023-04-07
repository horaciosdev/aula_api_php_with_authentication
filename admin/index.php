<?php
session_start();

// define a control constant
define("ROOT", true);

require_once("./inc/config.php");
require_once("./inc/database.php");

require_once("./inc/html_header.php");

// define routes
$route = '';

if (!isset($_SESSION['id_admin']) && $_SERVER['REQUEST_METHOD'] != 'POST') {
    $route = "login";
} elseif (!isset($_SESSION['id_admin']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $route = "login_submit";
} else {
    $route = "home";

    // if router is defined
    if (isset($_GET['route'])) {
        $route = $_GET['route'];
    }
}

// route execution
switch ($route) {
    case "login":
        require_once("login.php");
        break;
    case "login_submit":
        require_once("login_submit.php");
        break;

        // after login
    case "home":
        require_once("bo/home.php");
        break;
    case "new_client":
        require_once("bo/new_client.php");
        break;
    case "edit_client":
        require_once("bo/edit_client.php");
        break;
    case "delete_client":
        require_once("bo/delete_client.php");
        break;
    case "delete_client_ok":
        require_once("bo/delete_client_ok.php");
        break;
    case "restore_client":
        require_once("bo/restore_client.php");
        break;

    default:
        echo "Not defined route";
        break;
}

require_once("./inc/html_footer.php");
