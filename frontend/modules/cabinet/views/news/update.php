<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\product */

$this->title = 'Обновление:'.' '.$model->name;
$this->params['breadcrumbs'][] = ['label' => 'Кабинет', 'url' => ['/cabinet']];
$this->params['breadcrumbs'][] = ['label' => 'Новости', 'url' => ['/cabinet/news']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->idnews]];
$this->params['breadcrumbs'][] = 'Обновление';
?>
<div class="product-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>