<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\product */

$this->title = 'Новая продукция';
$this->params['breadcrumbs'][] = ['label' => 'Кабинет', 'url' => ['/cabinet']];
$this->params['breadcrumbs'][] = ['label' => 'Продукция', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
