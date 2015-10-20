<?php
/**
 * Created by PhpStorm.
 * User: Tuan
 * Date: 10/14/2015
 * Time: 16:52
 */

$page = (int)_get('page');
$page = $page > 0 ? $page - 1 : 0;
$pageSize = 10;

$sql = 'SELECT "id","title","created_date","status" FROM "post" ORDER BY "id" DESC LIMIT ' . $pageSize . ' OFFSET ' . ($page * $pageSize);
$stmt = getDB()->prepare($sql);
$stmt->execute();
$G['data'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
$stmt = getDB()->prepare('SELECT count(*) FROM "post"');
$stmt->execute();
$G['total'] = $stmt->fetchColumn();

render('index');