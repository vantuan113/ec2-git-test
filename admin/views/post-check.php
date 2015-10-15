<?php
/**
 * Created by PhpStorm.
 * User: Tuan
 * Date: 10/15/2015
 * Time: 11:04
 */
global $G;
$data = $G['data'];
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1> 新規投稿
        <small>ニュース記事を追加</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> ダッシュボード</a></li>
        <li><a href="index.php?a=post">投稿</a></li>
        <li class="active">確認</li>
    </ol>
</section>

<!-- Main content -->
<section class="content clearfix">
    <div class="col-md-12">
        <div class="box">


            <div class="box-body">
                <form role="form" method="post" action="index.php?a=post-insert">
                    <!-- タイトル -->
                    <div class="form-group">
                        <!--                        <h2 class="text-center">eco-bill 臨時メンテナンス作業実施のお知らせ </h2>-->
                        <h2 class="text-center"><?= htmlspecialchars($data['title']) ?></h2>
                        <input type="hidden" name="title" value="<?= $data['title'] ?>"/>
                    </div>
                    <!-- エディタ -->
                    <div class="form-group">
                        <?= $data['content'] ?>
                        <textarea name="content" class="hidden"><?= $data['content'] ?></textarea>
                    </div>

                    <!-- ファイル　-->
                    <div class="form-group">
                        <ul class="mailbox-attachments clearfix">
                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                <?php if (!isset($data['file' . $i])) continue; ?>
                                <?php $f = $data['file' . $i]; ?>
                                <li>
                                    <input type="hidden" name="file<?= $i ?>" value="<?= $f['name'] ?>">
                                    <input type="hidden" name="up_file<?= $i ?>" value="<?= $f['path'] ?>">
                                    <?php $ext = pathinfo($f['name'], PATHINFO_EXTENSION); ?>
                                    <?php if ($ext == 'pdf'): ?>
                                        <span class="mailbox-attachment-icon"><i class="fa fa-file-pdf-o"></i></span>
                                        <div class="mailbox-attachment-info">
                                            <a href="../uploads/tmp/<?= $f['path'] ?>" class="mailbox-attachment-name">
                                                <i class="fa fa-paperclip"></i>
                                                <?= htmlspecialchars($f['name']) ?>
                                            </a>
                                            <span class="mailbox-attachment-size">
                                                <?= human_filesize(UPLOAD_PATH . '/tmp/' . $f['path']) ?>
                                            </span>
                                        </div>
                                    <?php elseif (in_array($ext, ['jpg', 'jpeg', 'png', 'gif'])): ?>
                                        <span class="mailbox-attachment-icon has-img">
                                            <img src="../uploads/tmp/<?= $f['path'] ?>" alt="Attachment">
                                        </span>
                                        <div class="mailbox-attachment-info">
                                            <a href="../uploads/tmp/<?= $f['path'] ?>" class="mailbox-attachment-name">
                                                <i class="fa fa-camera"></i>
                                                <?= htmlspecialchars($f['name']) ?>
                                            </a>
                                            <span class="mailbox-attachment-size">
                                            <?= human_filesize(UPLOAD_PATH . '/tmp/' . $f['path']) ?>
                                            </span>
                                        </div>
                                    <?php else: ?>
                                        <span class="mailbox-attachment-icon"><i class="fa fa-file-o"></i></span>
                                        <div class="mailbox-attachment-info">
                                            <a href="../uploads/tmp/<?= $f['path'] ?>" class="mailbox-attachment-name">
                                                <i class="fa fa-paperclip"></i>
                                                <?= htmlspecialchars($f['name']) ?>
                                            </a>
                                            <span class="mailbox-attachment-size">
                                                <?= human_filesize(UPLOAD_PATH . '/tmp/' . $f['path']) ?>
                                            </span>
                                        </div>
                                    <?php endif ?>
                                </li>
                            <?php endfor ?>
                        </ul>
                    </div>


                    <!-- 公開日 -->
                    <?php $time = strtotime($data['created_date']) ?>
                    <div class="form-group">
                        <label>公開日</label>

                        <p class="form-control-static">
                            <?= date('Y', $time) ?>年<?= date('m', $time) ?>月<?= date('d', $time) ?>日
                        </p>
                        <input name="created_date" type="hidden" value="<?= $data['created_date'] ?>" >
                        <!-- /.input group -->
                    </div>
                    <!-- /.form group -->
                    <!-- ステータス -->
                    <div class="form-group">
                        <label>ステータス</label>

                        <p class="form-control-static">
                            <?= postStatus($data['status']) ?>
                        </p>
                        <!--                        <p>公開</p>-->
                        <input name="status" type="hidden" value="<?= $data['status'] ?>" >
                    </div>
                    <div class="box-footer text-center">
                        <div class="col-md-6">
                            <a class="btn btn-block btn-default" href="index.php?a=post">戻る</a>
                            <!-- <button class="btn btn-block btn-default">戻る</button> -->
                        </div>
                        <div class="col-md-6">
                            <!--                            <a class="btn btn-block btn-success" href="post-thanks.html">登録する</a>-->
                            <button type="submit" class="btn btn-block btn-success">登録する</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
</section>
<!-- /.content -->
