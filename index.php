<?php 
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods,Authorization, X-Requested-With');

$method = $_SERVER['REQUEST_METHOD'];

$request_uri = $_SERVER['REQUEST_URI'];

$tables = ['posts'];
$id = null;
$queryStr = null;

$url = rtrim($request_uri, '/');
$url = filter_var($url, FILTER_SANITIZE_URL);

$urlArr = explode('?' , $url);
if (sizeof($urlArr) > 1) {
    $queryStr = $urlArr[1];
    $url = $urlArr[0];
}

$url = explode('/', $url);

$tableName = (string) $url[3];

if (isset($url[4]) && $url[4] != null) {
    $id = (int) $url[4];
}

if (in_array($tableName, $tables)) {
    include_once './classes/Database.php';
    include_once './api/'.$tableName.'.php';
}else{
    echo 'Table does not exist';
}