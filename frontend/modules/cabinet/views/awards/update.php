<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Awards */

$this->title = 'Обновление:' . ' ' . $model->date;
$this->params['breadcrumbs'][] = ['label' => 'Кабинет', 'url' => ['/cabinet']];
$this->params['breadcrumbs'][] = ['label' => 'Награды', 'url' => ['/cabinet/awards']];
$this->params['breadcrumbs'][] = ['label' => $model->date, 'url' => ['view', 'id' => $model->idawards]];
$this->params['breadcrumbs'][] = 'Обновление';
?>
<div class="news-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>