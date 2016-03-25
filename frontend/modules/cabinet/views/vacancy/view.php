<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Vacancy */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Кабинет', 'url' => ['/cabinet']];
$this->params['breadcrumbs'][] = ['label' => 'Вакансии', 'url' => ['/cabinet/vacancy']];
$this->params['breadcrumbs'][] = 'Просмотр';
?>
<div class="vacancy-view">
    <div class="row text-center">
        <div class="col-lg-2 col-md-2 col-sm-3 col-xs-12">
            <p>
                <?= Html::a('Редактировать', ['update', 'id' => $model->idvacancy], [
                    'class' => 'btn btn-primary'
                ]) ?>
            </p>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-3 col-xs-4 col-xs-2">
            <p>
                <?= Html::a('Удалить', ['delete', 'id' => $model->idvacancy], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Вы уверены, что хотите удалить эту позицию?',
                        'method' => 'post',
                    ],
                ]) ?>
            </p>
        </div>
    </div>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idvacancy',
            'name',
            'description:ntext',
            'open:boolean',
            //'group_id',
            'created_at:date',
            'updated_at:date',
        ],
    ]) ?>

</div>
