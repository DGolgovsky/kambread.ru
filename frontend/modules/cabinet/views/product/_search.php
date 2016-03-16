<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Search\productSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idproduct') ?>

    <?= $form->field($model, 'price') ?>

    <?= $form->field($model, 'address') ?>

    <?= $form->field($model, 'fk_agent_detail') ?>

    <?= $form->field($model, 'name') ?>

    <?php // echo $form->field($model, 'livingroom') ?>

    <?php // echo $form->field($model, 'parking') ?>

    <?php // echo $form->field($model, 'kitchen') ?>

    <?php // echo $form->field($model, 'general_image') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'location') ?>

    <?php // echo $form->field($model, 'hot') ?>

    <?php // echo $form->field($model, 'sold') ?>

    <?php // echo $form->field($model, 'type') ?>

    <?php // echo $form->field($model, 'recommend') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Найти', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Сброс', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>