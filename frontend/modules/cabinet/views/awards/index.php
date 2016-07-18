<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\AwardsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Редактор наград';
$this->params['breadcrumbs'][] = ['label' => 'Кабинет', 'url' => ['/cabinet']];
$this->params['breadcrumbs'][] = 'Награды';
?>
<div class="container">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 text-center">
        <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-primary']) ?>
    </div>
    <hr>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'idawards',
            'date',
            'description:ntext',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
