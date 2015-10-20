<?php
/**
 * Created by PhpStorm.
 * User: Tuan
 * Date: 10/15/2015
 * Time: 11:51
 */

if (isPostRequest()) {
    $sql = 'INSERT INTO "post"("title","content","file1","up_file1","file2","up_file2","file3","up_file3","file4","up_file4","file5","up_file5","status","created_author","modified_author","created_date","updated_date") VALUES ';
    $sql .= '(:title,:content,:file1,:up_file1,:file2,:up_file2,:file3,:up_file3,:file4,:up_file4,:file5,:up_file5,:status,:created_author,:modified_author,:created_date,:updated_date)';
    $stmt = getDB()->prepare($sql);
    $data = [
        ':title' => _post('title'),
        ':content' => _post('content'),
        ':status' => _post('status'),
        ':created_date' => _post('created_date'),
        //':updated_date' => date('Y-m-d H:i:s'), PostgreSQL don't have datetime data type like MySQL
        ':updated_date' => time(),
        ':created_author' => getUserId(),
        ':modified_author' => getUserId(),
    ];

    $path = getUploadPath();
    for ($i = 1; $i <= 5; $i++) {
        $fname = _post('file' . $i, '');
        $fpath = _post('up_file' . $i, '');
        if (!empty($fname) && !empty($fpath)) {
            if (copy(UPLOAD_PATH . '/tmp/' . $fpath, UPLOAD_PATH . '/' . $path . '/' . $fpath)) {
                $data[':file' . $i] = $fname;
                $data[':up_file' . $i] = $path . '/' . $fpath;
            } else {
                exit('Can NOT copy file. May be not writeable in uploads directory');
            }
        } else {
            $data[':file' . $i] = '';
            $data[':up_file' . $i] = '';
        }
    }

    $stmt->execute($data);
    $G['data'] = [
        'id' => getDB()->lastInsertId(),
        'title' => $data[':title'],
    ];
    render('post-thanks');

    deleteTmpFiles();

    return;
}

redirect('post');