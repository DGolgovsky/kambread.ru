<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\News */
$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Кабинет', 'url' => ['/cabinet']];
$this->params['breadcrumbs'][] = ['label' => 'Новости', 'url' => ['/cabinet/news']];
$this->params['breadcrumbs'][] = 'Просмотр';
?>
<div class="news-view">
    <div class="row text-center">
        <div class="col-lg-2 col-md-2 col-sm-3 col-xs-12">
            <p>
                <?= Html::a('Редактировать', ['update', 'id' => $model->idnews], [
                    'class' => 'btn btn-primary'
                ]) ?>
            </p>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-3 col-xs-4">
            <p>
                <?= Html::a('Изображения', ['addimg', 'id' => $model->idnews], [
                    'class' => 'btn btn-warning'
                ]) ?>
            </p>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-3 col-xs-4 col-xs-2">
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
    </div>
    <?php
    if(file_exists('uploads/news/'.$model['idnews'].'/general/small_general.jpg')):
        ?>
        <?= \yii\helpers\Html::img(\frontend\components\Common::getImageNews($model, true), ['width' => 200]) ?>
        <?php
    endif;
    ?>
    <div class="spacer"></div>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'idnews',
            'name',
            'description:ntext',            
            'status:boolean',
            'user.name',
            'created_at:date',
            'updated_at:date',
        ],
    ]) ?>

    <div class="row">
        <div class="col-lg-2 col-lg-offset-2 col-sm-2 col-sm-offset-1 col-xs-3">
            <?=Html::a('< туда', ['view', 'id' => ($model->findOne($id = $model->idnews - 1) !== null) ? $id : $model->idnews], [
                'class' => ($id) ? 'btn btn-default' : 'btn btn-default disabled',
            ]);
            ?>
        </div>
        <div class="col-lg-2 col-lg-offset-4 col-sm-2 col-sm-offset-6 col-xs-3">
            <?= Html::a('сюда >', ['view', 'id' => ($model->findOne($model->idnews + 1) !== null) ? $id = $model->idnews + 1: $id = $model->idnews], [
                'class' => ($id - $model->idnews) ? 'btn btn-default' : 'btn btn-default disabled',
            ]) ?>
        </div>
    </div>
</div>