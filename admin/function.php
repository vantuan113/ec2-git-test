<?php
/**
 * Created by PhpStorm.
 * User: Tuan
 * Date: 10/14/2015
 * Time: 16:48
 */

function _get($name, $default = null)
{
    return isset($_GET[$name]) ? $_GET[$name] : $default;
}

function _post($name, $default = null)
{
    return isset($_POST[$name]) ? $_POST[$name] : $default;
}

function isLoggedIn()
{
    global $G;
    if (isset($_SESSION['uid']) && $_SESSION['uid'] > 0) {
        $stmt = getDB()->prepare("SELECT * FROM user WHERE id=:id LIMIT 1");
        $stmt->execute([':id' => $_SESSION['uid']]);
        if ($stmt->rowCount() > 0) {
            $G['user'] = $stmt->fetch(PDO::FETCH_ASSOC);
            return true;
        }
    }
    return false;
}

function loggedIn($user)
{
    if (isset($user['id'])) {
        $_SESSION['uid'] = $user['id'];
    }
}

function loggout()
{
    unset($_SESSION['uid']);
}

function getUserId()
{
    return isset($_SESSION['uid']) ? $_SESSION['uid'] : 0;
}

function isPostRequest()
{
    return isset($_SERVER['REQUEST_METHOD']) && !strcasecmp($_SERVER['REQUEST_METHOD'], 'POST');
}

function getDB()
{
    global $DB;
    if ($DB == null) {
        try {
            $DB = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASSWORD,
                array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        } catch (Exception $e) {
            exit ('Unable to connect: ' . $e->getMessage());
        }
    }
    return $DB;
}

function render($view, $options = [])
{
    $defaultOptions = ['header' => true, 'footer' => true];
    $options = array_merge($defaultOptions, $options);

    if ($options['header']) include 'views/_header.php';

    $file = 'views/' . $view . '.php';
    if (file_exists($file)) {
        include $file;
    } else {
        echo 'file not found';
    }

    if ($options['footer']) include 'views/_footer.php';
}

function findUser($email)
{
    $stmt = getDB()->prepare('SELECT * FROM user WHERE email=:email');
    $stmt->execute([':email' => $email]);
    return $stmt->rowCount() > 0 ? $stmt->fetch(PDO::FETCH_ASSOC) : [];
}

function hashPassword($password)
{
    return sha1($password);
}

function redirect($action, $statusCode = 302)
{
    header('Location: index.php?a=' . $action, true, $statusCode);
    die();
}

function getUploadPath()
{
    $dir = date('Y/m/d');
    $path = UPLOAD_PATH . '/' . $dir;
    if (!is_dir($path)) {
        mkdir($path, 0755, true);
    }
    return $dir;
}

function human_filesize($file, $decimals = 2)
{
    $bytes = filesize($file);
    $size = array('B', 'kB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
    $factor = floor((strlen($bytes) - 1) / 3);
    return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$size[$factor];
}

function postStatus($status = null)
{
    $a = [
        1 => '公開',
        2 => '非公開',
        3 => '削除',
    ];
    return $status === null ? $a : (isset($a[$status]) ? $a[$status] : 'Unknown');
}

function deleteTmpFiles()
{
    $dir = UPLOAD_PATH . DIRECTORY_SEPARATOR . 'tmp';
    $it = new RecursiveDirectoryIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS);
    $files = new RecursiveIteratorIterator($it, RecursiveIteratorIterator::CHILD_FIRST);
    foreach ($files as $file) {
        if ($file->isDir()) {
            rmdir($file->getRealPath());
        } else {
            unlink($file->getRealPath());
        }
    }
    //rmdir($dir);
}