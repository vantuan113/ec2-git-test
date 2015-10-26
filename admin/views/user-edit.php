<?php
/**
 * Created by PhpStorm.
 * User: Tuan
 * Date: 10/14/2015
 * Time: 17:50
 */
global $G;
$user = $G['user'];
$errors = $G['errors'];
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1> ユーザー
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> ダッシュボード</a></li>
        <li><a href="index.php?a=user">ユーザー</a></li>
        <li class="active">編集</li>
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
                <!-- アラート表示 -->
                <?php if (!empty($errors)): ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php foreach ($errors as $error): ?>
                        <p><i class="icon fa fa-ban"></i> <strong><?php echo htmlspecialchars($error) ?></strong></p>
                        <?php endforeach ?>
<!--                    <p><i class="icon fa fa-ban"></i> <strong>２つのパスワードがあってません</strong></p>-->

                </div>
                <?php endif ?>
                <form method="post">
                    <!-- ユーザーID -->
                    <div class="form-group">
                        <label>ユーザーID</label>
                        <input name="email" type="text" class="form-control" value="<?php echo $user['email'] ?>"
                               placeholder="Email">
                    </div>
                    <!-- パスワード -->
                    <div class="form-group">
                        <label>パスワード</label>
                        <input name="password" type="password" class="form-control" value="" placeholder="Password">
                        <p class="help-block">You can leave the box blank if you do not want to change password</p>
                    </div>
                    <!-- パスワード 確認用 -->
                    <div class="form-group">
                        <label>パスワード確認用</label>
                        <input name="password-confirm" type="password" class="form-control" value="" placeholder="Confirm password">
                    </div>

                    <div class="box-footer">
                        <!--                    <div class="col-md-6 col-xs-offset-3"> <a href="user-edit-check.html" class="btn btn-block btn-success">確認画面へ</a>-->
                        <button type="submit" class="btn btn-block btn-success">確認画面へ</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.box-body -->
    </div>
    </div>
</section>
<!-- /.content -->
