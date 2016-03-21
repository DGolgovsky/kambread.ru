<?php
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;

?>
<!--[if lt IE 7]>
<p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
<![endif]-->
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
                <a href="/" ><img src="/images/logo.png"  alt="Главная"></a>
                <?php
                NavBar::begin([
                    'brandLabel' => '<a href="/" ><img src="/images/logo.png"  alt="Главная"></a>',
                    'brandUrl' => Yii::$app->homeUrl,
                    'options' => [
                        'class' => 'navbar-inverse navbar-fixed-top',
                    ],
                ]);
                $menuItems[] = ['label' => 'Главная', 'url' => ['/']];
                $menuItems[] = ['label' => 'Информация',
                    'items' => [
                        ['label' => 'О Компании',
                            'url' => ['/site/about']],
                        ['label' => 'Контакты',
                            'url' => ['/site/contact']],
                        ['label' => 'Партнёрам',
                            'url' => ['/site/partners']],
                        ['label' => 'Раскрытие информации',
                            'url' => ['http://disclosure.1prime.ru/portal/default.aspx?emId=3436107766']],
                    ],
                ];

                if (Yii::$app->user->isGuest) {
                    $menuItems[] =  ['label' => 'Вход', 'url' => ['/site/login']];
                    $menuItems[] =  ['label' => 'Регистрация', 'url' => ['/site/signup/']];
                } else {
                    $menuItems[] =  ['label' => 'Кабинет', 'url' => ['/cabinet']];
                    $menuItems[] = ['label' => 'Выход (' . Yii::$app->user->identity->username . ')',  'url' => ['/site/logout'], 'linkOptions' => ['data-method' => 'post']];
                }
                echo Nav::widget([
                    'options' => ['class' => 'navbar-nav navbar-right'],
                    'items' => $menuItems,
                ]);
                NavBar::end();
                ?>
            </div>
            <!-- #Nav Ends -->
        </div>
    </div>
</div>
