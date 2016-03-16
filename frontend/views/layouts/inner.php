<?php
use yii\helpers\Html;
//use yii\bootstrap\Nav;
use frontend\assets\MainAsset;
MainAsset::register($this);
?>
<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?= Html::csrfMetaTags() ?>
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
    <!-- Header Starts -->
    <?php echo $this->render("//common/header") ?>
    <!-- #Header Starts -->
    <div class="inside-banner">
      <div class="container">
        <span class="pull-right"><a href="/">Home</a> / <?=$this->title ?></span>
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
    <?php echo $this->render("//common/footer") ?>
    <?php $this->endBody(); ?>
  </body>
</html>
<?php $this->endPage(); ?>