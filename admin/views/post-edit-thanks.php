<?php
/**
 * Created by PhpStorm.
 * User: Tuan
 * Date: 10/15/2015
 * Time: 15:18
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
        <li><a href="#">確認</a></li>
        <li class="active">完了</li>
    </ol>
</section>

<!-- Main content -->
<section class="content clearfix">
    <div class="col-md-12">
        <div class="box">
            <div class="box-body text-center">
                <h2>記事の投稿が完了しました</h2>
            </div>
            <div class="box-footer">
                <div class="col-md-6 col-xs-offset-3">
                    <a href="index.php" class="btn btn-block btn-default">トップへ</a>
                    <!-- <button class="btn btn-block btn-default">トップへ</button> -->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
