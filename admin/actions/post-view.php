<?php
/**
 * Created by PhpStorm.
 * User: Tuan
 * Date: 10/15/2015
 * Time: 14:01
 */

$stmt = getDB()->prepare("SELECT * FROM post WHERE id=:id");
$stmt->execute([':id' => _get('id', 0)]);
if ($stmt->rowCount() == 0) {
    render('404');
    return;
}

$G['data'] = $stmt->fetch(PDO::FETCH_ASSOC);

render('post-view');