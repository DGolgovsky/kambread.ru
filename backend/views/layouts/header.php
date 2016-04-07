<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;

/* @var $this \yii\web\View */
/* @var $content string */
?>

<header class="main-header">
    <a href="<?=Yii::$app->homeUrl ?>" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>К</b>ХК</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Кабинет</b> КХК</span>
    </a>

    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?=\common\components\UserComponent::getUserImage(Yii::$app->user->id) ?>" class="user-image" alt="User Image"/>
                        <span class="hidden-xs"><?=Yii::$app->user->identity->name ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="<?=\common\components\UserComponent::getUserImage(Yii::$app->user->id) ?>" class="img-circle" alt="User Image">
                            <p>
                                <?=Yii::$app->user->identity->name ?>
                                <small>Зарегистрирован <?=Yii::$app->formatter->asDate(Yii::$app->user->identity->created_at, 'd MMMM yyyy') ?></small>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <?= Html::a(
                                    'Профиль',
                                    ['/site/profile'],
                                    ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
                                ) ?>
                            </div>
                            <div class="pull-right">
                                <?= Html::a(
                                    'Выход',
                                    ['/site/logout'],
                                    ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
                                ) ?>
                            </div>
                        </li>
                    </ul>
                </li>
                <!-- Control Sidebar Toggle Button -->
                <li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li>
            </ul>
        </div>

    </nav>
</header>