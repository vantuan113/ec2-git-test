<?php
/**
 * Created by PhpStorm.
 * User: Tuan
 * Date: 10/15/2015
 * Time: 15:13
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
        <li><a href="index.php?a=post-view&id=<?php echo $data['id'] ?>"><?php echo htmlspecialchars($data['title']) ?></a></li>
        <li><a href="index.php?a=post-edit&id=<?php echo $data['id'] ?>">編集</a></li>
        <li class="active">確認</li>
    </ol>
</section>

<!-- Main content -->
<section class="content clearfix">
    <div class="col-md-12">
        <div class="box">


            <div class="box-body">
                <form role="form" method="post" action="index.php?a=post-update">
                    <input name="id" type="hidden" value="<?php echo $data['id'] ?>">
                    <!-- タイトル -->
                    <div class="form-group">
                        <!--                        <h2 class="text-center">eco-bill 臨時メンテナンス作業実施のお知らせ </h2>-->
                        <h2 class="text-center"><?php echo htmlspecialchars($data['title']) ?></h2>
                        <input type="hidden" name="title" value="<?php echo $data['title'] ?>"/>
                    </div>
                    <!-- エディタ -->
                    <div class="form-group">
                        <?php echo $data['content'] ?>
                        <textarea name="content" class="hidden"><?php echo $data['content'] ?></textarea>
                    </div>

                    <!-- ファイル　-->
                    <div class="form-group">
                        <ul class="mailbox-attachments clearfix">
                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                <?php if (!isset($data['file' . $i]['name'])) continue; ?>
                                <?php $f = $data['file' . $i]; ?>
                                <?php $fLink = '../uploads/' . (strpos($f['path'], '/') > 0 ? '' : 'tmp/') . $f['path']; ?>
                                <?php $fPath = UPLOAD_PATH. '/' . (strpos($f['path'], '/') > 0 ? '' : 'tmp/') . $f['path']; ?>
                                <li>
                                    <input type="hidden" name="file<?php echo $i ?>" value="<?php echo $f['name'] ?>">
                                    <input type="hidden" name="up_file<?php echo $i ?>" value="<?php echo $f['path'] ?>">
                                    <?php $ext = pathinfo($f['name'], PATHINFO_EXTENSION); ?>
                                    <?php if ($ext == 'pdf'): ?>
                                        <span class="mailbox-attachment-icon"><i class="fa fa-file-pdf-o"></i></span>
                                        <div class="mailbox-attachment-info">
                                            <a href="<?php echo $fLink ?>" class="mailbox-attachment-name">
                                                <i class="fa fa-paperclip"></i>
                                                <?php echo htmlspecialchars($f['name']) ?>
                                            </a>
                                            <span class="mailbox-attachment-size">
                                                <?php echo human_filesize($fPath) ?>
                                            </span>
                                        </div>
                                    <?php elseif (in_array($ext, ['jpg', 'jpeg', 'png', 'gif'])): ?>
                                        <span class="mailbox-attachment-icon has-img">
                                            <img src="<?php echo $fLink ?>" alt="Attachment">
                                        </span>
                                        <div class="mailbox-attachment-info">
                                            <a href="<?php echo $fLink ?>" class="mailbox-attachment-name">
                                                <i class="fa fa-camera"></i>
                                                <?php echo htmlspecialchars($f['name']) ?>
                                            </a>
                                            <span class="mailbox-attachment-size">
                                            <?php echo human_filesize($fPath) ?>
                                            </span>
                                        </div>
                                    <?php else: ?>
                                        <span class="mailbox-attachment-icon"><i class="fa fa-file-o"></i></span>
                                        <div class="mailbox-attachment-info">
                                            <a href="<?php echo $fLink ?>" class="mailbox-attachment-name">
                                                <i class="fa fa-paperclip"></i>
                                                <?php echo htmlspecialchars($f['name']) ?>
                                            </a>
                                            <span class="mailbox-attachment-size">
                                                <?php echo human_filesize($fPath) ?>
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
                            <?php echo date('Y', $time) ?>年<?php echo date('m', $time) ?>月<?php echo date('d', $time) ?>日
                        </p>
                        <input name="created_date" type="hidden" value="<?php echo $data['created_date'] ?>">
                        <!-- /.input group -->
                    </div>
                    <!-- /.form group -->
                    <!-- ステータス -->
                    <div class="form-group">
                        <label>ステータス</label>

                        <p class="form-control-static">
                            <?php echo postStatus($data['status']) ?>
                        </p>
                        <!--                        <p>公開</p>-->
                        <input name="status" type="hidden" value="<?php echo $data['status'] ?>">
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
