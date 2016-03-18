<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Кабинет';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-lg-6 col-lg-offset-3 col-sm-6 col-sm-offset-3 col-xs-12 ">
    <div class="cabinet-default-index">
        <h2>Добро пожаловать в личный кабинет</h2>
        <p>
            <span>
            <?= Html::a('Продукция', ['/cabinet/product'], ['class' => 'btn btn-primary']) ?>
        </span>

        <span>
            <?= Html::a('Документы', ['#'], ['class' => 'btn btn-primary']) ?>
            </span>
        </p>

        <p>
            <?= Html::a('Новости', ['#'], ['class' => 'btn btn-primary']) ?>
        </p>

        <p>
            <?= Html::a('Профиль', ['#'], ['class' => 'btn btn-primary']) ?>
        </p>
    </div>
</div>