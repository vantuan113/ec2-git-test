<?php
/**
 * Created by PhpStorm.
 * User: Tuan
 * Date: 10/14/2015
 * Time: 22:45
 */
global $G;
$data = $G['data'];
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1> ユーザー
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> ダッシュボード</a></li>
        <li><a href="index.php?a=user">ユーザー</a></li>
        <li><a href="index.php?a=user-edit&id=<?= getUserId() ?>">編集</a></li>
        <li class="active">確認</li>
    </ol>
</section>

<!-- Main content -->
<section class="content clearfix">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">ユーザー</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <form method="post">
                    <!-- ユーザーID -->
                    <div class="form-group">
                        <label>ユーザーID</label>

                        <p class="form-control-static"><?= getUserId() ?></p>
                    </div>
                    <!-- Email -->
                    <div class="form-group">
                        <label>Email login</label>

                        <p class="form-control-static"><?= $data['email'] ?></p>
                        <input name="email" type="hidden" value="<?= $data['email'] ?>">
                    </div>
                    <!-- パスワード -->
                    <div class="form-group">
                        <label>パスワード</label>

                        <!--                        <p>パスワード表示</p>-->
                        <p class="form-control-static"><?php // echo $data['password'] ?>******</p>
                        <input name="password" type="hidden" value="<?= $data['password'] ?>">
                        <input name="password-confirm" type="hidden" value="<?= $data['password'] ?>">
                    </div>
                    <div class="box-footer text-center">
                        <div class="col-md-6">
                            <a class="btn btn-block btn-default"
                               href="index.php?a=user-edit&id=<?= getUserId() ?>">戻る</a>
                            <!-- <button class="btn btn-block btn-default">戻る</button> -->
                        </div>
                        <div class="col-md-6">
                            <!--                        <a class="btn btn-block btn-success" href="user-edit-thanks.html">登録する</a>-->
                            <input type="hidden" name="confirmed" value="1"/>
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
