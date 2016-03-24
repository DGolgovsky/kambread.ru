<?php
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;
?>

<!--[if lt IE 7]>
<p class="chromeframe">Вы используете <strong>устаревший</strong> браузер. Пожалуйста <a href="http://browsehappy.com/">обновите Ваш браузер</a> или <a href="http://www.google.com/chromeframe/?redirect=true">активируйте Google Chrome Frame</a> для улучшения отображения.</p>
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
                <a class="navbar-brand" href="/index">Камышинский хлебокомбинат</a>
            </div>
            <!-- Nav Starts -->
            <div class="navbar-collapse collapse">
                <?php
                NavBar::begin([
                    'brandLabel' => '<a href="/index" ><img src="/images/bread_logo_new_gray.png" height="50px" alt="Главная"></a>',
                    'brandUrl' => Yii::$app->homeUrl,
                    'options' => [
                        'class' => 'navbar-inverse navbar-fixed-top',
                    ],
                ]);
                $menuItems[] = ['label' => 'Главная', 'url' => ['/site/index']];
                $menuItems[] = ['label' => 'Продукция', 'url' => ['/products']];
                $menuItems[] = ['label' => 'Информация',
                    'items' => [
                        ['label' => 'О Компании',
                            'url' => ['/site/about']],
                        ['label' => 'Контакты',
                            'url' => ['/site/contact']],
                        ['label' => 'Партнёрам',
                            'url' => ['/site/partners']],
                        ['label' => 'Вакансии',
                            'url' => ['/site/vacancies']],
                        ['label' => 'Новости',
                            'url' => ['/news']],
                        ['label' => 'Раскрытие информации',
                            'url' => ['/site/disclosure'],
							'linkOptions' => ['target' => '_blank']],
                    ],
                ];
                if (Yii::$app->user->isGuest) {
                    $menuItems[] =  ['label' => 'Вход', 'url' => ['/login']];
                } else {
                    $menuItems[] = ['label' => 'Кабинет',
                        'items' => [
                            ['label' => 'Главная',
                                'url' => ['/cabinet']],
                            ['label' => 'Продукция',
                                'url' => ['/cabinet/product']],
                            ['label' => 'Документы',
                                'url' => ['/cabinet/#']],
                            ['label' => 'Новости',
                                'url' => ['/cabinet/news']],
                            ['label' => 'Вакансии',
                                'url' => ['/cabinet/vacancy']],
                            ['label' => 'Профиль',
                                'url' => ['/cabinet/settings']],
                            ['label' => 'Почта',
                                'url' => ['/site/mail'],
                                'linkOptions' => ['target' => '_blank']],
                        ],
                    ];
                    $menuItems[] = ['label' => 'Выход (' . Yii::$app->user->identity->username . ')',  'url' => ['/site/logout'], 'linkOptions' => ['data-method' => 'post']];
                }
                echo Nav::widget([
                    'options' => ['class' => 'navbar-inverse navbar-nav navbar-right'],
                    'items' => $menuItems,
                ]);
                NavBar::end();
                ?>

            </div>
            <!-- #Nav Ends -->
        </div>
    </div>
</div>
