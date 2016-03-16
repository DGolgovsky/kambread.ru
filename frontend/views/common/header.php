<?php
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
?>
<!-- views/common/Header navbar Starts -->

<div class="navbar-wrapper">
    <div class="navbar-inverse" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <!-- Nav Starts -->

            <div class="navbar-collapse collapse">
                <a href="/main" ><img src="/images/logo.png"  alt="Главная"></a>
                <?php
                $menuItems = [
                    ['label' => 'ГЛАВНАЯ', 'url' => '/main'],
                    ['label' => 'О КОМПАНИИ', 'url' => '#'],
                ];
                $guest = \Yii::$app->user->isGuest;
                if($guest) {
                    $menuItems[] =  ['label' => 'Войти', 'url' => ['/main/main/login']];
                    $menuItems[] =  ['label' => 'Регистрация', 'url' => ['/main/main/register/']];
                } else {
                    $menuItems[] =  ['label' => 'Кабинет', 'url' => ['/cabinet/product']];
                    $menuItems[] = ['label' => 'Выйти',  'url' => ['/site/logout'], 'linkOptions' => ['data-method' => 'post']];
                }
                echo Nav::widget([
                    'options' => ['class' => 'navbar-nav navbar-right'],
                    'items' => $menuItems,
                ]);
                ?>
            </div>
            <!-- #Nav Ends -->
        </div>
    </div>
</div>

