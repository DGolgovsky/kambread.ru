<?php
use yii\bootstrap\Nav;

?>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= \common\components\UserComponent::getUserImage(Yii::$app->user->id) ?>" class="img-circle"
                     alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?= Yii::$app->user->identity->username ?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->
        <?=
        Nav::widget(
            [
                'encodeLabels' => false,
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    '<li class="header">Меню</li>',
                    '<li class="active treeview">',
                    ['label' => '<i class="fa fa-pie-chart"></i> <span>Пользователи</span>', 'url' => ['/user/index?sort=id']],
                    ['label' => '<i class="fa fa-table"></i> <span>Продукция</span>', 'url' => ['/product/index?sort=idproduct']],
                    ['label' => '<i class="fa fa-edit"></i> <span>Новости</span>', 'url' => ['/news/index?sort=idnews']],
                    ['label' => '<i class="fa fa-file-code-o"></i> <span>Gii</span>', 'url' => ['/gii']],
                    ['label' => '<i class="fa fa-dashboard"></i> <span>Debug</span>', 'url' => ['/debug']],
                    '</li>',
                    [
                        'label' => '<span class="glyphicon glyphicon-lock"></span> Sing in', //for basic
                        'url' => ['/site/login'],
                        'visible' => Yii::$app->user->isGuest
                    ],
                ],
            ]
        );
        ?></section>
    <!-- /.sidebar -->
</aside>