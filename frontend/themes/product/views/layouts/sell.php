<?php
use frontend\widgets\Alert;
use yii\widgets\Breadcrumbs;

$this->beginContent('@app/views/layouts/bootstrap.php');
$this->title = 'Продукция';
?>
<div class="inside-banner">
    <div class="container">
        <span class="pull-right">
            <?= Breadcrumbs::widget([
                'homeLink' => ['label' => 'Главная', 'url' => '/'],
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= Alert::widget() ?>
        </span>
        <h2><?=$this->title ?></h2>
    </div>
</div>
<div class="container">
    <?=$content ?>
</div>
<?php $this->endContent(); ?>

