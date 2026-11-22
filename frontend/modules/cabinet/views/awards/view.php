<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Awards */
$this->title = $model->date;
$this->params['breadcrumbs'][] = ['label' => 'Кабинет', 'url' => ['/cabinet']];
$this->params['breadcrumbs'][] = ['label' => 'Награды', 'url' => ['/cabinet/awards']];
$this->params['breadcrumbs'][] = 'Просмотр';
?>
<div class="awards-view">
    <div class="row text-center">
        <div class="col-lg-2 col-md-2 col-sm-3 col-xs-12">
            <p>
                <?= Html::a('Редактировать', ['update', 'id' => $model->idawards], [
                    'class' => 'btn btn-primary'
                ]) ?>
            </p>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-3 col-xs-4">
            <p>
                <?= Html::a('Изображения', ['addimg', 'id' => $model->idawards], [
                    'class' => 'btn btn-warning'
                ]) ?>
            </p>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-3 col-xs-4 col-xs-2">
            <p>
                <?= Html::a('Удалить', ['delete', 'id' => $model->idawards], [
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
    if (file_exists('uploads/awards/' . $model['idawards'] . '/general/small_' . $model['general_image'])):
        ?>
        <?= \yii\helpers\Html::img(\frontend\components\Common::getImageAward($model, true), ['width' => 200]) ?>
        <?php
    endif;
    ?>
    <div class="spacer"></div>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idawards',
            'date',
            'description:ntext',
        ],
    ]) ?>

    <div class="row">
        <div class="col-lg-2 col-lg-offset-2 col-sm-2 col-sm-offset-1 col-xs-3">
            <?= Html::a('< туда', ['view', 'id' => ($model->findOne($id = $model->idawards - 1) !== null) ? $id : $model->idawards], [
                'class' => ($id) ? 'btn btn-default' : 'btn btn-default disabled',
            ]);
            ?>
        </div>
        <div class="col-lg-2 col-lg-offset-4 col-sm-2 col-sm-offset-6 col-xs-3">
            <?= Html::a('сюда >', ['view', 'id' => ($model->findOne($model->idawards + 1) !== null) ? $id = $model->idawards + 1 : $id = $model->idawards], [
                'class' => ($id - $model->idawards) ? 'btn btn-default' : 'btn btn-default disabled',
            ]) ?>
        </div>
    </div>
</div>