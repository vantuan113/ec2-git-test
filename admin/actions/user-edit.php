<?php
/**
 * Created by PhpStorm.
 * User: Tuan
 * Date: 10/14/2015
 * Time: 17:50
 */

if (isPostRequest()) {
    $email = trim(_post('email'));
    $password = _post('password');
    $confirmPassword = _post('password-confirm');

//    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
//        $G['errors']['email'] = 'Invalid email format';
//    }
    if (!empty($password) && $password != $confirmPassword) {
        $G['errors']['password'] = '２つのパスワードがあってません';
    }

    if (empty($G['errors'])) {
        if (_post('confirmed') == '1') {
            $user = $G['user'];
            $password = empty($password) ? $user['password'] : hashPassword($password);
            $stmt = getDB()->prepare('UPDATE user SET email=:email, password=:password WHERE id=:id');
            $stmt->execute([':email' => $email, ':password' => $password, ':id' => $user['id']]);
            render('user-edit-thanks');
        } else {
            $G['data'] = ['email' => $email, 'password' => $password];
            render('user-edit-check');
            return;
        }
    }
}

render('user-edit');
