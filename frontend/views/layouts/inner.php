<?php
use frontend\widgets\Alert;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;

AppAsset::register($this);
Yii::$app->language = 'ru-RU';
?>
<?php $this->beginPage(); ?>
    <!DOCTYPE html>
    <html lang="<?= \Yii::$app->language ?>">
    <head>
        <meta charset="<?= \Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode('Камышинский хлебокомбинат|' . $this->title) ?></title>
	<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script>
  (adsbygoogle = window.adsbygoogle || []).push({
    google_ad_client: "ca-pub-1294568316727012",
    enable_page_level_ads: true
  });
</script>
        <?php $this->head(); ?>
    </head>
    <body>
    <?php $this->beginBody(); ?>
    <!-- views/common/Header Starts -->
    <?php echo $this->render("//common/header"); ?>
    <!-- #views/common/Header Ends -->
    <div class="inside-banner container">
    <span class="pull-left" style="margin-left: 40px;">
        <?= Breadcrumbs::widget([
            'homeLink' => ['label' => 'Главная', 'url' => '/'],
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?php if (\Yii::$app->session->hasFlash('success')): ?>
            <?= Alert::widget() ?>
        <?php endif; ?>
    </span>
        <h2 class="text-right" style="margin-right: 40px;margin-top: 13px;"><?= $this->title ?></h2>
    </div>

    <!-- banner -->
    <div class="container">
        <div class="spacer">
            <?= $content ?>
        </div>
    </div>
    <!-- #banner -->
    <?php echo $this->render("//common/footer"); ?>
    <?php $this->endBody(); ?>
    </body>
    </html>
<?php $this->endPage(); ?>
