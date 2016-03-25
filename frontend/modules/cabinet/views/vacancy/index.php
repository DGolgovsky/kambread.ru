<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Редактор вакансий';
$this->params['breadcrumbs'][] = ['label' => 'Кабинет', 'url' => ['/cabinet']];
$this->params['breadcrumbs'][] = 'Вакансии';
?>
<div class="container">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 text-center">
        <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-primary']) ?>
    </div>
    <hr>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idvacancy',
            'group_id',
            'description:ntext',
            'created_at',
            'name',
            // 'updated_at',
            'open:boolean',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
