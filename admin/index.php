<?php
/**
 * Created by PhpStorm.
 * User: Tuan
 * Date: 10/14/2015
 * Time: 16:47
 */

define('BASE_PATH', __DIR__);
define('UPLOAD_PATH', __DIR__.'/../uploads');

@session_start();

$DB = null;
$G = ['errors' => []];

include '../config.php';
include 'function.php';

$action = _get('a', 'index');

if (!isLoggedIn()) {
    $action = 'login';
}

$file = 'actions/' . $action . '.php';
if (!file_exists($file)) {
    $action = '404';
    $file = 'actions/404.php';
}
$G['action'] = $action;

include $file;