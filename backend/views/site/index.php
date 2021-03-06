<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Кабинет';
$this->params['breadcrumbs'][] = $this->title;
?>
<h2 style="align-content: center">Добро пожаловать в личный кабинет</h2>
<div class="container">
    <p>
    <div class="row">
        <div class="col-lg-4 col-sm-4 col-xs-4">
            <?= Html::a('Продукция', ['/product'], ['class' => 'btn btn-primary']) ?>
        </div>
        <div class="col-lg-8 col-sm-8 col-xs-8">
            <span>Редактирование списка продукции</span>
        </div>
    </div>
    </p><p>
    <div class="row">
        <div class="col-lg-4 col-sm-4 col-xs-4">
            <?= Html::a('Документы', ['#'], ['class' => 'btn btn-primary disabled']) ?>
        </div>
        <div class="col-lg-8 col-sm-8 col-xs-8">
            <span>Документы на ознакомление и подпись</span>
        </div>
    </div>
    </p><p>
    <div class="row">
        <div class="col-lg-4 col-sm-4 col-xs-4">
            <?= Html::a('Новости', ['/news'], ['class' => 'btn btn-primary']) ?>
        </div>
        <div class="col-lg-8 col-sm-8 col-xs-8">
            <span>Редактирование списка новостей</span>
        </div>
    </div>
    </p><p>
    <div class="row">
        <div class="col-lg-4 col-sm-4 col-xs-4">
            <?= Html::a('Вакансии', ['/vacancy'], ['class' => 'btn btn-primary']) ?>
        </div>
        <div class="col-lg-8 col-sm-8 col-xs-8">
            <span>Редактирование списка вакантных позиций</span>
        </div>
    </div>
    </p><p>
    <div class="row">
        <div class="col-lg-4 col-sm-4 col-xs-4">
            <?= Html::a('Профиль', ['/cabinet/default/settings'], ['class' => 'btn btn-primary']) ?>
        </div>
        <div class="col-lg-8 col-sm-8 col-xs-8">
            <span>Редактирование параметров профиля пользователя</span>
        </div>
    </div>
    </p>
</div>
