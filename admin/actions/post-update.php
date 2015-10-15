<?php
/**
 * Created by PhpStorm.
 * User: Tuan
 * Date: 10/15/2015
 * Time: 15:16
 */


if (isPostRequest()) {
    $sql = 'UPDATE post SET `title`=:title,`content`=:content,`file1`=:file1,`up_file1`=:up_file1,`file2`=:file2,`up_file2`=:up_file2,';
    $sql .= '`file3`=:file3,`up_file3`=:up_file3,`file4`=:file4,`up_file4`=:up_file4,`file5`=:file5,`up_file5`=:up_file5,';
    $sql .= '`status`=:status,`modified_author`=:modified_author,`created_date`=:created_date,`updated_date`=:updated_date WHERE id=:id';
    $stmt = getDB()->prepare($sql);
    $data = [
        ':title' => _post('title'),
        ':content' => _post('content'),
        ':status' => _post('status'),
        ':created_date' => _post('created_date'),
        ':updated_date' => date('Y-m-d H:i:s'),
        ':modified_author' => getUserId(),
        ':id' => _post('id'),
    ];


    $path = getUploadPath();
    for ($i = 1; $i <= 5; $i++) {
        $fname = _post('file' . $i, '');
        $fpath = _post('up_file' . $i, '');
        if (!empty($fname) && !empty($fpath)) {
            $data[':file' . $i] = $fname;
            if (strpos($fpath, '/')) { // old file, keep!
                $data[':up_file' . $i] = $fpath;
            } else { // new file, copy!
                if (copy(UPLOAD_PATH . '/tmp/' . $fpath, UPLOAD_PATH . '/' . $path . '/' . $fpath)) {
                    $data[':up_file' . $i] = $path . '/' . $fpath;
                } else {
                    exit('Can NOT copy file. May be not writeable in uploads directory');
                }
            }

        } else {
            $data[':file' . $i] = '';
            $data[':up_file' . $i] = '';
        }
    }

    $stmt->execute($data);
    $G['data'] = [
        'id' => $data[':id'],
        'title' => $data[':title'],
    ];

    render('post-edit-thanks');

    deleteTmpFiles();

    return;
}

redirect('post');