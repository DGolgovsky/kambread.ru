<?php

use frontend\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use frontend\assets\MainAsset;
use yii\widgets\Breadcrumbs;

MainAsset::register($this);
?>
<?php $this->beginPage(); ?>
    <!DOCTYPE html>
    <html lang="en">
<head>
    <meta charset="<?= \Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode('Камышинский хлебокомбинат') ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody(); ?>
<!-- views/common/Header Starts -->
<?php echo $this->render("//common/header") ?>
<!-- #views/common/Header Ends -->
<div class="inside-banner">
    <div class="container">
        <span class="pull-right">
            <?= Breadcrumbs::widget([
                'homeLink' => ['label' => 'Главная', 'url' => '/'],
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?php if(\Yii::$app->session->hasFlash('success')): ?>
                <?= Alert::widget() ?>
            <?php endif; ?>
        </span>
        <h2><?=$this->title ?></h2>
    </div>
</div>
<!-- banner -->
<div class="container">
    <div class="spacer">
        <?=$content ?>
    </div>
</div>
<?php echo $this->render("//common/footer") ?>
<?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage(); ?>

