<?php
/**
 * Created by PhpStorm.
 * User: Tuan
 * Date: 10/14/2015
 * Time: 17:49
 */
 global $G;
 $user = $G['user'];
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1> ユーザー <small></small> </h1>
    <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> ダッシュボード</a></li>
        <li class="active">ユーザー</li>
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
                <table class="table table-hover table-striped">
                    <tbody>
                    <tr>
                        <th>ユーザーID</th>
                    </tr>
                    <tr>
                        <td><a href="index.php?a=user-edit&id=<?php echo getUserId() ?>"><?php echo htmlspecialchars($user['email']) ?></a></td>
                    </tr>
                    </tbody>
                </table>
                <div class="box-footer">

                </div>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
</section>
<!-- /.content -->
