<?php
use frontend\widgets\Alert;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
AppAsset::register($this);
?>

<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html lang="<?= \Yii::$app->language ?>">
<head>
    <meta charset="<?= \Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="google-site-verification" content="sZdpkUqsj_hA5kLMZRWTMHKezqWnJ9Ev3MaCziR9zN4" />
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
                'homeLink' => ['label' => 'Главная', 'url' => '/index'],
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
        <?= $content ?>
    </div>
</div>
<!-- #banner -->
<?php echo $this->render("//common/footer") ?>
<?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage(); ?>

