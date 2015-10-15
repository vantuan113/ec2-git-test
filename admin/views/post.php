<?php
/**
 * Created by PhpStorm.
 * User: Tuan
 * Date: 10/15/2015
 * Time: 9:46
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
        <li class="active">投稿</li>
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
                            <p><i class="icon fa fa-ban"></i> <strong><?= $error ?></strong></p>
                        <?php endforeach ?>
                    </div>
                <?php endif ?>
                <!-- アラート表示 -->

                <form method="post" enctype="multipart/form-data">
                    <!-- タイトル -->
                    <div class="form-group">
                        <label>タイトル</label>
                        <input name="title" value="<?= $data['title'] ?>" type="text" class="form-control"
                               placeholder="タイトルを入力してください...">
                    </div>
                    <!-- エディタ -->
                    <div class="form-group">
                        <textarea id="editor1" name="content" rows="10" cols="80"><?= $data['content'] ?></textarea>
                    </div>

                    <?php for ($i = 1; $i <= 5; $i++): ?>
                        <!-- ファイル　-->
                        <div class="form-group">
                            <label for="inputfile">添付ファイル <?= $i ?></label>
                            <input name="file<?= $i ?>" type="file" id="inputfile">

                            <p class="help-block">ファイル形式 JPG/GIR/PNG/PDF ....バイトまで </p>
                        </div>
                    <?php endfor ?>

                    <?php if (!empty($data['created_date'])) {
                        $time = strtotime($data['created_date']);
                        $date = [
                            'Y' => date('Y', $time),
                            'n' => date('n', $time),
                            'j' => date('j', $time),
                            'G' => date('G', $time),
                            'i' => date('i', $time),
                        ];
                    } else {
                        $date = [
                            'Y' => -1,
                            'n' => -1,
                            'j' => -1,
                            'G' => -1,
                            'i' => -1,
                        ];
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
                                        <option value="<?= $y ?>" <?= $y == $date['Y'] ? 'selected' : '' ?>><?= $y ?></option>
                                        <?php $y++; endfor ?>
                                </select>
                                年
                                <select name="start_month" class="w120">
                                    <option value="">選択</option>
                                    <?php for ($i = 1; $i <= 12; $i++): ?>
                                        <option
                                            value="<?= $i ?>" <?= $i == $date['n'] ? 'selected' : '' ?>><?= $i ?></option>
                                    <?php endfor ?>
                                </select>
                                月
                                <select name="start_day" class="w120">
                                    <option value="">選択</option>
                                    <?php for ($i = 1; $i <= 31; $i++): ?>
                                        <option
                                            value="<?= $i ?>" <?= $i == $date['j'] ? 'selected' : '' ?>><?= $i ?></option>
                                    <?php endfor ?>
                                </select>
                                日
                                <select name="start_hour" class="w120">
                                    <option value="">選択</option>
                                    <?php for ($i = 0; $i <= 23; $i++): ?>
                                        <option
                                            value="<?= $i ?>" <?= $i == $date['G'] ? 'selected' : '' ?>><?= $i ?></option>
                                    <?php endfor ?>
                                </select>
                                時
                                <select name="start_min" class="w120">
                                    <option value="">選択</option>
                                    <?php for ($i = 0; $i <= 50; $i += 10): ?>
                                        <option
                                            value="<?= $i ?>" <?= $i == $date['i'] ? 'selected' : '' ?>><?= $i ?></option>
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
                                <option value="<?= $k ?>"><?= $v ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="box-footer">
                        <!--                        <div class="col-md-6 col-xs-offset-3"> <a href="post-check.html" class="btn btn-block btn-success">確認画面へ</a>-->
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
