<?php
/**
 * Created by PhpStorm.
 * User: Tuan
 * Date: 10/15/2015
 * Time: 14:02
 */
global $G;
$data = $G['data'];
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1> ニュース記事
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> ダッシュボード</a></li>
        <li class="active"><?= htmlspecialchars($data['title']) ?></li>
    </ol>
</section>

<!-- Main content -->
<section class="content clearfix">
    <div class="col-md-12">
        <div class="box">

            <div class="box-body">
                <form role="form">
                    <!-- タイトル -->
                    <div class="form-group">

                        <h2 class="text-center"><?= htmlspecialchars($data['title']) ?></h2>
                    </div>
                    <!-- エディタ -->
                    <div class="form-group">
                        <?= $data['content'] ?>
                    </div>

                    <!-- ファイル　-->
                    <div class="form-group">
                        <ul class="mailbox-attachments clearfix">
                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                <?php if (empty($data['file' . $i]) || empty($data['up_file' . $i])) continue; ?>
                                <li>
                                    <?php $ext = pathinfo($data['up_file' . $i], PATHINFO_EXTENSION); ?>
                                    <?php if ($ext == 'pdf'): ?>
                                        <span class="mailbox-attachment-icon"><i class="fa fa-file-pdf-o"></i></span>
                                        <div class="mailbox-attachment-info">
                                            <a href="../uploads/<?= $data['up_file' . $i] ?>"
                                               class="mailbox-attachment-name">
                                                <i class="fa fa-paperclip"></i>
                                                <?= htmlspecialchars($data['file' . $i]) ?>
                                            </a>
                                            <span class="mailbox-attachment-size">
                                                <?= human_filesize(UPLOAD_PATH . '/' . $data['up_file' . $i]) ?>
                                            </span>
                                        </div>
                                    <?php elseif (in_array($ext, ['jpg', 'jpeg', 'png', 'gif'])): ?>
                                        <span class="mailbox-attachment-icon has-img">
                                            <img src="../uploads/<?= $data['up_file' . $i] ?>" alt="Attachment">
                                        </span>
                                        <div class="mailbox-attachment-info">
                                            <a href="../uploads/<?= $data['up_file' . $i] ?>"
                                               class="mailbox-attachment-name">
                                                <i class="fa fa-camera"></i>
                                                <?= htmlspecialchars($data['file' . $i]) ?>
                                            </a>
                                            <span class="mailbox-attachment-size">
                                            <?= human_filesize(UPLOAD_PATH . '/' . $data['up_file' . $i]) ?>
                                            </span>
                                        </div>
                                    <?php else: ?>
                                        <span class="mailbox-attachment-icon"><i class="fa fa-file-o"></i></span>
                                        <div class="mailbox-attachment-info">
                                            <a href="../uploads/<?= $data['up_file' . $i] ?>"
                                               class="mailbox-attachment-name">
                                                <i class="fa fa-paperclip"></i>
                                                <?= htmlspecialchars($data['file' . $i]) ?>
                                            </a>
                                            <span class="mailbox-attachment-size">
                                                <?= human_filesize(UPLOAD_PATH . '/' . $data['up_file' . $i]) ?>
                                            </span>
                                        </div>
                                    <?php endif ?>
                                </li>
                            <?php endfor ?>
                        </ul>
                    </div>


                    <!-- 公開日 -->
                    <?php //$time = strtotime($data['created_date']) ?>
                    <?php $time = $data['created_date'] ?>
                    <div class="form-group">
                        <label>公開日</label>

                        <p class="form-control-static">
                            <?= date('Y', $time) ?>年<?= date('m', $time) ?>月<?= date('d', $time) ?>日
                        </p>
                        <!-- /.input group -->
                    </div>
                    <!-- /.form group -->
                    <!-- ステータス -->
                    <div class="form-group">
                        <label>ステータス</label>

                        <p class="form-control-static">
                            <?= postStatus($data['status']) ?>
                        </p>
                    </div>
                    <div class="box-footer">
                        <div class="col-md-6 col-xs-offset-3">
                            <a class="btn btn-block btn-danger"
                               href="index.php?a=post-edit&id=<?= $data['id'] ?>">編集する</a>
                            <!-- <button class="btn btn-block btn-success">登録する</button> -->
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
</section>
<!-- /.content -->