<?php
/**
 * Created by PhpStorm.
 * User: Tuan
 * Date: 10/15/2015
 * Time: 14:13
 */
global $G;
$data = $G['data'];
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1> ニュース記事
        <small>編集中</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> ダッシュボード</a></li>
        <li><a href="index.php?a=post-vew&id=<?php echo $data['id'] ?>"><?php echo htmlspecialchars($data['title']) ?></a></li>
        <li class="active">編集</li>
    </ol>
</section>

<!-- Main content -->
<section class="content clearfix">
    <div class="col-md-12">
        <div class="box">

            <!-- /.box-header -->
            <div class="box-body">

                <!-- アラート表示 -->
                <?php if (!empty($G['errors'])): ?>
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <?php foreach ($G['errors'] as $error): ?>
                            <p><i class="icon fa fa-ban"></i> <strong><?php echo $error ?></strong></p>
                        <?php endforeach ?>
                    </div>
                <?php endif ?>
                <!-- アラート表示 -->

                <form method="post" enctype="multipart/form-data">
                    <!-- タイトル -->
                    <div class="form-group">
                        <label>タイトル</label>
                        <input name="title" type="text" class="form-control" value="<?php echo $data['title'] ?>">
                    </div>
                    <!-- エディタ -->
                    <div class="form-group">
                        <textarea id="editor1" name="content" rows="10" cols="80"><?php echo $data['content'] ?></textarea>
                    </div>

                    <?php for ($i = 1; $i <= 5; $i++): ?>
                        <!-- ファイル　-->
                        <div class="form-group">
                            <label for="inputfile">添付ファイル <?php echo $i ?></label>
                            <?php if (!empty($data['file' . $i]) && !empty($data['up_file' . $i])): ?>
                                <ul class="mailbox-attachments clearfix">
                                    <li>
                                        <?php $ext = pathinfo($data['up_file' . $i], PATHINFO_EXTENSION); ?>
                                        <?php if ($ext == 'pdf'): ?>
                                            <span class="mailbox-attachment-icon"><i
                                                    class="fa fa-file-pdf-o"></i></span>
                                            <div class="mailbox-attachment-info">
                                                <a href="../uploads/<?php echo $data['up_file' . $i] ?>"
                                                   class="mailbox-attachment-name">
                                                    <i class="fa fa-paperclip"></i>
                                                    <?php echo htmlspecialchars($data['file' . $i]) ?>
                                                </a>
                                            <span class="mailbox-attachment-size">
                                                <?php echo human_filesize(UPLOAD_PATH . '/' . $data['up_file' . $i]) ?>
                                            </span>
                                            </div>
                                        <?php elseif (in_array($ext, ['jpg', 'jpeg', 'png', 'gif'])): ?>
                                            <span class="mailbox-attachment-icon has-img">
                                            <img src="../uploads/<?php echo $data['up_file' . $i] ?>" alt="Attachment">
                                        </span>
                                            <div class="mailbox-attachment-info">
                                                <a href="../uploads/<?php echo $data['up_file' . $i] ?>"
                                                   class="mailbox-attachment-name">
                                                    <i class="fa fa-camera"></i>
                                                    <?php echo htmlspecialchars($data['file' . $i]) ?>
                                                </a>
                                            <span class="mailbox-attachment-size">
                                            <?php echo human_filesize(UPLOAD_PATH . '/' . $data['up_file' . $i]) ?>
                                            </span>
                                            </div>
                                        <?php else: ?>
                                            <span class="mailbox-attachment-icon"><i class="fa fa-file-o"></i></span>
                                            <div class="mailbox-attachment-info">
                                                <a href="../uploads/<?php echo $data['up_file' . $i] ?>"
                                                   class="mailbox-attachment-name">
                                                    <i class="fa fa-paperclip"></i>
                                                    <?php echo htmlspecialchars($data['file' . $i]) ?>
                                                </a>
                                            <span class="mailbox-attachment-size">
                                                <?php echo human_filesize(UPLOAD_PATH . '/' . $data['up_file' . $i]) ?>
                                            </span>
                                            </div>
                                        <?php endif ?>
                                    </li>
                                </ul>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="delete_file<?php echo $i ?>" value="1">
                                        削除する
                                    </label>
                                </div>
                            <?php else: ?>
                                <input name="file<?php echo $i ?>" type="file" id="inputfile">

                                <p class="help-block">ファイル形式 JPG/GIR/PNG/PDF ....バイトまで </p>
                            <?php endif ?>
                        </div>
                    <?php endfor ?>

                    <?php if (!empty($data['created_date'])) {
                        //$time = strtotime($data['created_date']);
                        $time = $data['created_date'];
                        $date = array(
                            'Y' => date('Y', $time),
                            'n' => date('n', $time),
                            'j' => date('j', $time),
                            'G' => date('G', $time),
                            'i' => date('i', $time),
                        );
                    } else {
                        $date = array(
                            'Y' => -1,
                            'n' => -1,
                            'j' => -1,
                            'G' => -1,
                            'i' => -1,
                        );
                    } ?>
                    <!-- 公開日 -->
                    <div class="form-group">
                        <label>公開日</label>

                        <div class="input-group">
                            <div class="input-time">
                                <select name="start_year" class="w120">
                                    <option value="">選択</option>
                                    <?php $y = (int)date('Y') ?>
                                    <?php for ($i = 0; $i < 4; $i++): ?>
                                        <option value="<?php echo $y ?>" <?php echo $y == $date['Y'] ? 'selected' : '' ?>><?php echo $y ?></option>
                                        <?php $y++; endfor ?>
                                </select>
                                年
                                <select name="start_month" class="w120">
                                    <option value="">選択</option>
                                    <?php for ($i = 1; $i <= 12; $i++): ?>
                                        <option
                                            value="<?php echo $i ?>" <?php echo $i == $date['n'] ? 'selected' : '' ?>><?php echo $i ?></option>
                                    <?php endfor ?>
                                </select>
                                月
                                <select name="start_day" class="w120">
                                    <option value="">選択</option>
                                    <?php for ($i = 1; $i <= 31; $i++): ?>
                                        <option
                                            value="<?php echo $i ?>" <?php echo $i == $date['j'] ? 'selected' : '' ?>><?php echo $i ?></option>
                                    <?php endfor ?>
                                </select>
                                日
                                <select name="start_hour" class="w120">
                                    <option value="">選択</option>
                                    <?php for ($i = 0; $i <= 23; $i++): ?>
                                        <option
                                            value="<?php echo $i ?>" <?php echo $i == $date['G'] ? 'selected' : '' ?>><?php echo $i ?></option>
                                    <?php endfor ?>
                                </select>
                                時
                                <select name="start_min" class="w120">
                                    <option value="">選択</option>
                                    <?php for ($i = 0; $i <= 50; $i += 10): ?>
                                        <option
                                            value="<?php echo $i ?>" <?php echo $i == $date['i'] ? 'selected' : '' ?>><?php echo $i ?></option>
                                    <?php endfor ?>
                                </select>
                                分 <br>
                                <br>
                            </div>
                        </div>
                        <!-- /.input group -->
                    </div>
                    <!-- /.form group -->
                    <!-- ステータス -->
                    <div class="form-group">
                        <label>ステータス</label>
                        <select name="status" class="form-control">
                            <?php foreach (postStatus() as $k => $v): ?>
                                <option
                                    value="<?php echo $k ?>" <?php echo $k == $data['status'] ? 'selected' : '' ?>><?php echo $v ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="box-footer">
                        <div class="col-md-6 col-xs-offset-3">
                            <!--                            <a href="read-edit-check.html" class="btn btn-block btn-success">確認画面へ</a>-->
                            <button type="submit" class="btn btn-block btn-success">確認画面へ</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
</section>
<!-- /.content -->