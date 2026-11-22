<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\product */

$this->title = $model->s_name;
$this->params['breadcrumbs'][] = ['label' => 'Кабинет', 'url' => ['/cabinet']];
$this->params['breadcrumbs'][] = ['label' => 'Продукция', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Просмотр', 'url' => ['view', 'id' => $model->idproduct]];
$this->params['breadcrumbs'][] = 'Обновление';
?>
<div class="product-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>