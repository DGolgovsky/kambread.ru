<?php
use yii\helpers\Html;
//use yii\bootstrap\Nav;
use frontend\assets\MainAsset;
MainAsset::register($this);
$this->title = 'Камышинский хлебокомбинат';
?>
<?php $this->beginPage(); ?>
    <!DOCTYPE html>
    <html lang="en">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody(); ?>
<?php if(Yii::$app->session->hasFlash('success')): ?>
    <?php
    $success = Yii::$app->session->getFlash('success');
    echo \yii\bootstrap\Alert::widget([
        'options' => [
            'class' => 'alert-info'
        ],
        'body' => $success
    ])
    ?>
<?php endif; ?>
<!-- views/common/Header Starts -->
<?php echo $this->render("//common/header") ?>
<!-- #views/common/Header Ends -->
<div class="inside-banner">
    <div class="container">
        <span class="pull-right"><a href="/">Home</a> / <?=$this->title ?></span>
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

