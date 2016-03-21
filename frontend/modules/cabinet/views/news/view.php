<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\News */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Кабинет', 'url' => ['/cabinet']];
$this->params['breadcrumbs'][] = ['label' => 'Новости', 'url' => ['/cabinet/news']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-view">
    //TODO add next/preview buttons
    <p>
        <?= Html::a('Обновить', ['update', 'id' => $model->idnews], [
            'class' => 'btn btn-primary'
        ]) ?>
    </p>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'idproduct',
            'name',
            //'price',
            //'user_id',
            //'general_image',
            'description:ntext',
            //'new',
            //'type:ntext',
            //'recommend',
            'user.name',
            'created_at:date',
            //'updated_at:date',
        ],
    ]) ?>
    <p>
        <?= Html::a('Удалить', ['delete', 'id' => $model->idnews], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
</div>