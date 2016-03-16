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
            <div class="navbar-collapse  collapse">
                <?php
                $menuItems = [
                    ['label' => 'ГЛАВНАЯ', 'url' => '/main'],
                    ['label' => 'О КОМПАНИИ', 'url' => '#'],
                    ['label' => 'КОНТАКТЫ', 'url' => '/main/main/contact'],
                ];
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
<!-- #views/common/Header navbar Ends -->
<div class="container">
    <!-- Header Starts -->
    <div class="header">
        <a href="/main" ><img src="/images/logo.png"  alt="Главная"></a>
        <?php
        $menuItems = [];
        $guest = \Yii::$app->user->isGuest;
        if($guest) {
            $menuItems[] =  ['label' => 'Войти', 'url' => '#', 'linkOptions' => ['data-target' => '#loginpop', 'data-toggle' => "modal"]];
        } else {
            $menuItems[] =  ['label' => 'Менеджер объявлений', 'url' => ['/cabinet/advert']];
            $menuItems[] = ['label' => 'Выйти',  'url' => ['/site/logout'], 'linkOptions' => ['data-method' => 'post']];
        }
        echo Nav::widget([
            'options' => ['class' => 'pull-right'],
            'items' => $menuItems,
        ]);
        ?>
    </div>
    <!-- #Header Endss -->
</div>
