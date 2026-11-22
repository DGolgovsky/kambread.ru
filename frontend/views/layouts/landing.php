<?php
use yii\helpers\Html;
use frontend\assets\AppAsset;

AppAsset::register($this);
Yii::$app->language = 'ru-RU';
?>
<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html lang="<?= \Yii::$app->language ?>">
<head>
    <meta charset="<?= \Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode('АО "Камышинский хлебокомбинат" - официальный сайт компании') ?></title>
    <?php $this->head(); ?>
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script>
  (adsbygoogle = window.adsbygoogle || []).push({
    google_ad_client: "ca-pub-1294568316727012",
    enable_page_level_ads: true
  });
</script>
</head>
<body>
<?php $this->beginBody(); ?>
<?php if (\Yii::$app->session->hasFlash('success')): ?>
    <?= \Yii::$app->session->getFlash('success') ?>
<?php endif; ?>
<?= $this->render("//common/header") ?>
<?= $content ?>
<?= $this->render("//common/footer") ?>
<?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage(); ?>

