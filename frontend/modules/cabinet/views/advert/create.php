<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Advert */

$this->title = 'Новое объявление';
$this->params['breadcrumbs'][] = ['label' => 'Объявления', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="advert-create">
    <h1 style="color: black; align-content: center;">
        <?= Html::encode($this->title) ?>
    </h1>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
