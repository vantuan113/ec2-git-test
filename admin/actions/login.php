<?php
/**
 * Created by PhpStorm.
 * User: Tuan
 * Date: 10/14/2015
 * Time: 16:52
 */

if (isLoggedIn()) {
    redirect('index');
}

if (isPostRequest()) {
    $email = _post('email');
    $password = hashPassword(_post('password'));
    $user = findUser($email);
    if (!empty($user) && $user['password'] == $password) {
        loggedIn($user);
        redirect('index');
    } else {
        $G['errors'][] = 'login fail';
    }
}

render('login', ['header' => false, 'footer' => false]);