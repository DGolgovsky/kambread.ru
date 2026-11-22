<?php
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;

?>

<!--[if lt IE 9]>
<p class="chromeframe">Вы используете <strong>устаревший</strong> браузер. Пожалуйста <a href="http://browsehappy.com/">обновите
    Ваш браузер</a> или <a href="http://www.google.com/chromeframe/?redirect=true">активируйте Google Chrome Frame</a>
    для улучшения отображения.</p>
<![endif]-->
<!-- views/common/Header navbar Starts -->
<div class="container" style="background: url(images/bgmain.png);">
    <div class="row">
        <div class="hidden-sm hidden-xs hidden-md">
            <a href="/"><img src="/images/logo_color_rectangle_h100.png" height="100px" alt="Главная"
                             style="position: absolute"></a>
            <h3 class="text-right">
                <small>
                    <span class="contacts__info">г. Камышин, ул. Ленина, 4</span> <span class="divider">|</span>
                    <span class="contacts__info">Приемная: (84457) 9-64-64</span> <span class="divider">|</span>
                    <span class="contacts__info">Отдел маркетинга: (84457) 9-39-84; +7-937-535-11-14</span>
                </small>
            </h3>
        </div>
    </div>
</div>
<!-- Nav Starts -->
<?php
$menuItems[] = ['label' => 'ГЛАВНАЯ', 'url' => ['/']];
$menuItems[] = ['label' => 'ПРОДУКЦИЯ', 'url' => ['/products']];
$menuItems[] = ['label' => 'ИНФОРМАЦИЯ',
    'items' => [
        ['label' => 'О Компании',
            'url' => ['/site/about']],
        ['label' => 'Партнёрам',
            'url' => ['/site/partners']],
        ['label' => 'Контакты',
            'url' => ['/site/contact']],
        ['label' => 'Вакансии',
            'url' => ['/vacancy']],
        ['label' => 'Новости',
            'url' => ['/news']],
        ['label' => 'Раскрытие информации',
            'url' => ['/site/disclosure'],
            'linkOptions' => ['target' => '_blank']],
    ],
];
if (Yii::$app->user->isGuest) {
    $menuItems[] = ['label' => 'ВХОД', 'url' => ['/login']];
} else {
    $menuItems[] = ['label' => 'КАБИНЕТ',
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
            ['label' => 'Награды',
                'url' => ['/cabinet/awards']],
            ['label' => 'Профиль',
                'url' => ['/cabinet/settings']],
            ['label' => 'Почта',
                'url' => ['/site/mail'],
                'linkOptions' => ['target' => '_blank']],
        ],
    ];
    $menuItems[] = ['label' => 'ВЫХОД (' . Yii::$app->user->identity->username . ')', 'url' => ['/site/logout'], 'linkOptions' => ['data-method' => 'post']];
}
NavBar::begin([
    'options' => [
        'class' => 'navbar navbar-inner',
    ],
]);
echo Nav::widget([
    'options' => [
        'class' => 'navbar navbar-nav navbar-right',
    ],
    'items' => $menuItems,
]);
NavBar::end();
?>
<!-- #Nav Ends -->
