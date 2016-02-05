<?
use yii\helpers\Html;
use yii\bootstrap\Nav;

\frontend\assets\MainAsset::register($this);
?>

<?
$this->beginPage();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?= Html::csrfMetaTags() ?>

    <?php $this->head() ?>
</head>
<body>
<? $this->beginBody(); ?>

<!-- Header Starts -->
<? echo $this->render("//common/head") ?>
<!-- #Header Starts -->

<div class="inside-banner">
    <div class="container">
        <span class="pull-right"><a href="#">Home</a> / <?=$this->title ?></span>
        <h2><?=$this->title ?></h2>
    </div>
</div>

<!-- banner -->

<!-- banner -->
<div class="container">
    <div class="spacer">
        <?=$content ?>
    </div>
</div>

<? echo $this->render("//common/footer") ?>

<? $this->endBody(); ?>
</body>
</html>

<? $this->endPage(); ?>

