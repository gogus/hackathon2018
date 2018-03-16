<?php

$action = $_GET['action'] ?? 'login';
$path = __DIR__ . '/../frontend/page/' . $action . '.php';

if (file_exists($path)) {
    require_once $path;
}
