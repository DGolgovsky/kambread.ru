<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Vacancy */

$this->title = 'Добавление позиции';
$this->params['breadcrumbs'][] = ['label' => 'Кабинет', 'url' => ['/cabinet']];
$this->params['breadcrumbs'][] = ['label' => 'Вакансии', 'url' => ['/cabinet/vacancy']];
$this->params['breadcrumbs'][] = 'Добавление';
?>
<div class="vacancy-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
