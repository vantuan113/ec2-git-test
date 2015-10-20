<?php
/**
 * Created by PhpStorm.
 * User: Tuan
 * Date: 10/14/2015
 * Time: 17:30
 */
global $G;
$data = $G['data'];
$totalPage = round($G['total'] / 10);
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1> ダッシュボード
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> ダッシュボード</a></li>
        <!--<li class="active">Here</li>-->
    </ol>
</section>

<!-- Main content -->
<section class="content clearfix">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">ニュース記事一覧</h3>

                <div class="box-tools">
                    <ul class="pagination pagination-sm no-margin pull-right">
                        <li><a href="index.php?a=index&page=1">«</a></li>
                        <?php for ($i = 1; $i <= $totalPage; $i++): ?>
                            <li><a href="index.php?a=index&page=<?= $i ?>"><?= $i ?></a></li>
                        <?php endfor ?>
                        <li><a href="index.php?a=index&page=<?= $totalPage ?>">»</a></li>
                    </ul>
                </div>
            </div>

            <!-- /.box-header -->
            <div class="box-body">
                <table class="table table-hover table-striped">
                    <tbody>
                    <tr>
                        <th style="width: 15px">ID</th>
                        <th>タイトル</th>
                        <th style="width:8%">添付</th>
                        <th style="width: 12%">ステータス</th>
                        <th style="width: 10%">投稿日</th>
                    </tr>
                    <?php foreach ($data as $v): ?>
                        <tr>
                            <td><?= $v['id'] ?>.</td>
                            <td>
                                <a href="index.php?a=post-view&id=<?= $v['id'] ?>">
                                    <?= htmlspecialchars($v['title']) ?>
                                </a>
                            </td>
                            <td><i class="fa fa-paperclip"></i></td>
                            <td>
                                <?php if ($v['status'] == 2): ?>
                                    <span class="label label-warning">非公開</span>
                                <?php elseif ($v['status'] == 3): ?>
                                    <span class="label label-danger">予約</span>
                                <?php elseif ($v['status'] == 1): ?>
                                    <span class="label label-success">公開</span>
                                <?php endif ?>
                            </td>
                            <td>
                                <?php //$time = strtotime($v['created_date']) ?>
                                <?php $time = $v['created_date'] ?>
                                <?= date('Y.m.d', $time) ?>
                            </td>
                        </tr>
                    <?php endforeach ?>
                    </tbody>
                </table>
                <div class="box-footer">
                    <div class="box-tools">
                        <ul class="pagination pagination-sm no-margin pull-right">
                            <li><a href="index.php?a=index&page=1">«</a></li>
                            <?php for ($i = 1; $i <= $totalPage; $i++): ?>
                                <li><a href="index.php?a=index&page=<?= $i ?>"><?= $i ?></a></li>
                            <?php endfor ?>
                            <li><a href="index.php?a=index&page=<?= $totalPage ?>">»</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
</section>
<!-- /.content -->