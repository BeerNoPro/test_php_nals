<?php

require './src/public/bootstrap.php';

$router = new Router();

require 'src/router/routers.php';

$base_uri = trim($_SERVER['REQUEST_URI'], '/');
$uri      = explode('/', $base_uri);
$method   = $_SERVER['REQUEST_METHOD'];
$chk_uri  = isset($uri[1]) ? $uri[1] : '';

if (isset($_GET['id'])) {
    $method  = 'GET';
    $chk_uri = 'edit';
}

if (isset($_GET['status'])) {
    $method  = 'GET';
    $chk_uri = 'search';
}

if (isset($_GET['column']) && isset($_GET['type'])) {
    $method  = 'GET';
    $chk_uri = 'search_date';
}

if (isset($_GET['start_date']) && isset($_GET['end_date'])) {
    $method  = 'GET';
    $chk_uri = 'date_working';
}

if (isset($_POST['_method'])) {
    if ($_POST['_method'] == 'delete') {
        $method = 'DELETE';
    }

    if ($_POST['_method'] == 'put') {
        $method = 'PUT';
    }
}

$router->direct($chk_uri, $method);
