<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Продукция';
$this->params['breadcrumbs'][] = ['label' => 'Кабинет', 'url' => ['/cabinet']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 text-center">
        <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-primary']) ?>
    </div>
    <hr>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            //'idproduct',
            'description:ntext',
            'price',
            'weight',
            //'general_image',

            'new:boolean',
            'recommend:boolean',
            //'type:ntext',
            //'user.name',
            //'created_at:date',
            'updated_at:date',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
