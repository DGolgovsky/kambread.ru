<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Регистрация';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <div class="row">
        <div class="col-lg-6 col-lg-offset-3 col-sm-6 col-sm-offset-3 col-xs-11 col-xs-offset-1">
            <p>Please fill out the following fields to signup:</p>
            <?php
                $form = ActiveForm::begin([
                    'id' => 'form-signup',
                    'enableClientValidation' => true,
                    'enableAjaxValidation' => true,
                ]);
            ?>
            
            <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'username') ?>

            <?= $form->field($model, 'email') ?>

            <?= $form->field($model, 'phone') ?>

            <?= $form->field($model, 'group')->dropDownList([
                'Руководство',
                'Маркетинг',
                'Кадры',
                'Бухгалтерия',
                'Производство',
                'Остальные'
            ]) ?>

            <?= $form->field($model, 'password')->passwordInput() ?>

            <?= $form->field($model, 'repassword')->passwordInput() ?>

            <div class="form-group">
                <?= Html::submitButton('Подтвердить', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>