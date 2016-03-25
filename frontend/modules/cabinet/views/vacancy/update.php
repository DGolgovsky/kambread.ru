<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Vacancy */

$this->title = 'Обновление:'.' '.$model->name;
$this->params['breadcrumbs'][] = ['label' => 'Кабинет', 'url' => ['/cabinet']];
$this->params['breadcrumbs'][] = ['label' => 'Вакансии', 'url' => ['/cabinet/vacancy']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->idvacancy]];
$this->params['breadcrumbs'][] = 'Обновление';
?>
<div class="vacancy-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
