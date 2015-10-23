<?php
/**
 * Created by PhpStorm.
 * User: Tuan
 * Date: 10/14/2015
 * Time: 16:47
 */


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(-1);

@session_start();

$t = time();

$DB = null;
$G = array('errors' => array());

include '../config.php';
include 'function.php';

$db = getDB();

$tables = array('user' => false, 'post' => false);

// user table
try {
    $stmt = $db->prepare('SELECT id FROM "user" LIMIT 1');
    $stmt->execute();
    $tables['user'] = true;
} catch (PDOException $e) {
    $tables['user'] = false;
}
/// post table
try {
    $stmt = $db->prepare('SELECT id FROM "post" LIMIT 1');
    $stmt->execute();
    $tables['post'] = true;
} catch (PDOException $e) {
    $tables['post'] = false;
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>INSTALL</title>
</head>
<body>

<div style="margin: 100px auto 0 auto; width: 500px;">
    <?php if (isPostRequest()): ?>
        <?php
        if (!$tables['user']) {
            $stmt = $db->prepare('CREATE TABLE "user" (id integer NOT NULL, email character varying(255) NOT NULL, password character varying(255), name character varying(255))');
            $stmt->execute();
            $stmt = $db->prepare('CREATE SEQUENCE user_id_seq_' . $t . ' START WITH 1 INCREMENT BY 1 NO MINVALUE NO MAXVALUE CACHE 1');
            $stmt->execute();
            $stmt = $db->prepare('ALTER SEQUENCE user_id_seq_' . $t . ' OWNED BY "user".id');
            $stmt->execute();
            $stmt = $db->prepare('ALTER TABLE ONLY "user" ALTER COLUMN id SET DEFAULT nextval(\'user_id_seq_' . $t . '\'::regclass)');
            $stmt->execute();
            $stmt = $db->prepare('ALTER TABLE ONLY "user" ADD CONSTRAINT user_email_key_' . $t . ' UNIQUE (email)');
            $stmt->execute();
            $stmt = $db->prepare('ALTER TABLE ONLY "user" ADD CONSTRAINT user_pkey_' . $t . ' PRIMARY KEY (id)');
            $stmt->execute();

            // first user admin/test
            $stmt = $db->prepare('INSERT INTO "user"("email","password","name") VALUES (:email,:password,:name)');
            $stmt->execute(array(
                ':email' => 'admin',
                ':password' => hashPassword('test'),
                'name' => 'Admin',
            ));
        }

        if (!$tables['post']) {
            $stmt = $db->prepare('CREATE TABLE post (id integer NOT NULL, title text, abstract text, content text, file1 text, up_file1 text, file2 text, up_file2 text, file3 text, up_file3 text, file4 text, up_file4 text, file5 text, up_file5 text, status integer, created_author integer, modified_author integer, created_date integer, updated_date integer)');
            $stmt->execute();
            $stmt = $db->prepare('CREATE SEQUENCE post_id_seq_' . $t . ' START WITH 1 INCREMENT BY 1 NO MINVALUE NO MAXVALUE CACHE 1');
            $stmt->execute();
            $stmt = $db->prepare('ALTER SEQUENCE post_id_seq_' . $t . ' OWNED BY post.id');
            $stmt->execute();
            $stmt = $db->prepare('ALTER TABLE ONLY post ALTER COLUMN id SET DEFAULT nextval(\'post_id_seq_' . $t . '\'::regclass)');
            $stmt->execute();
            $stmt = $db->prepare('ALTER TABLE ONLY post ADD CONSTRAINT post_pkey_' . $t . ' PRIMARY KEY (id);');
            $stmt->execute();
        }
        ?>
        <h3>INSTALL SUCCESSFULLY</h3>
        <p style="color: green;">
            Database has been installed!
        </p>
        <p>
            Admin login info<br />
            Email: <b>admin</b><br />
            Password: <b>test</b>
        </p>
    <?php else: ?>
        <p>
            Table USER:
            <?php if ($tables['user']): ?>
                <span style="color: green;">CREATED</span>
            <?php else: ?>
                <span style="color: red">NOT CREATED</span>
            <?php endif ?>
        </p>
        <p>
            Table POST:
            <?php if ($tables['post']): ?>
                <span style="color: green;">CREATED</span>
            <?php else: ?>
                <span style="color: red">NOT CREATED</span>
            <?php endif ?>
        </p>
        <?php if (!$tables['user'] || !$tables['post']): ?>
            <div>
                <form method="post">
                    <input type="submit" value="INSTALL">
                </form>
            </div>
        <?php endif ?>
    <?php endif ?>
</div>
</body>
</html>
