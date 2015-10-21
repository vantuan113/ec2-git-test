<?php
/**
 * Created by PhpStorm.
 * User: Tuan
 * Date: 10/15/2015
 * Time: 14:12
 */

$stmt = getDB()->prepare('SELECT * FROM "post" WHERE "id"=:id');
$stmt->execute(array(':id' => _get('id', 0)));
if ($stmt->rowCount() == 0) {
    render('404');
    return;
}

$data = $stmt->fetch(PDO::FETCH_ASSOC);

if (isPostRequest()) {
    $data['title'] = _post('title');
    $data['content'] = _post('content');
    $data['status'] = _post('status');

    if (empty($data['title'])) {
        $G['errors']['title'] = 'タイトルが入力されていません';
    }

    // file 1 -> 5
    for ($i = 1; $i <= 5; $i++) {
        if (isset($_FILES['file' . $i]) && $_FILES['file' . $i]['error'] == 0) {
            $f = $_FILES['file' . $i];
            if ($f['size'] > 5 * 1024 * 1024) { // 5M
                $G['errors']['file' . $i] = '添付ファイル ' . $i . 'の内容をご確認下さい';
            }
            if (!in_array(pathinfo($f['name'], PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif', 'pdf'])) {
                $G['errors']['file' . $i] = '添付ファイル ' . $i . 'の内容をご確認下さい';
            }
            if (empty($G['errors']['file' . $i])) {
                $data['file' . $i] = array('name' => $f['name'], 'tmp_name' => $f['tmp_name']);
            }
        } else {
            if (_post('delete_file' . $i) == '1') {
                unset($data['file' . $i]);
            } elseif (!empty($data['file' . $i]) && !empty($data['up_file' . $i])) {
                $data['file' . $i] = array('name' => $data['file' . $i], 'path' => $data['up_file' . $i]);
            }
        }
    }

    //$data['created_date'] = _post('start_year') . '-' . _post('start_month') . '-' . _post('start_day') . ' ' . _post('start_hour') . ':' . _post('start_min') . ':00';
    $s = _post('start_year') . '-' . _post('start_month') . '-' . _post('start_day') . ' ' . _post('start_hour') . ':' . _post('start_min') . ':00';
    $date = DateTime::createFromFormat('Y-n-j G:i:s', $s);
    $data['created_date'] = $date->getTimestamp();

    if (empty($G['errors'])) {
        // move file upload for check
        for ($i = 1; $i <= 5; $i++) {
            if (!empty($data['file' . $i]['tmp_name'])) {
                //$path = getUploadPath();
                $filename = uniqid() . $i . '_' . rand() . rand() . '_' . uniqid() . '.' . pathinfo($data['file' . $i]['name'], PATHINFO_EXTENSION);
                //if (move_uploaded_file($data['file' . $i]['tmp_name'], UPLOAD_PATH . '/' . $path . '/' . $filename)) {
                if (move_uploaded_file($data['file' . $i]['tmp_name'], UPLOAD_PATH . '/tmp/' . $filename)) {
                    //$data['file' . $i]['path'] = $path . '/' . $filename;
                    $data['file' . $i]['path'] = $filename;
                } else {
                    exit('Sorry, there was an error uploading your file.');
                }
            }
        }
        $G['data'] = $data;
        render('post-edit-check');
        return;
    }

} else {
    $G['data'] = $data;
}

render('post-edit');
