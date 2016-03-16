<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Advert */

$this->title = 'Обновление: ' . ' ' . $model->idadvert;
$this->params['breadcrumbs'][] = ['label' => 'Объявления', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idadvert, 'url' => ['view', 'id' => $model->idadvert]];
$this->params['breadcrumbs'][] = 'Обновление';
?>
<div class="advert-update">
    <h1 style="color: black; align-content: center;">
        <?= Html::encode($this->title) ?>
    </h1>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>