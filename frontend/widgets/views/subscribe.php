<?php
$form = \yii\bootstrap\ActiveForm::begin([
    'enableAjaxValidation' => true,
    'validationUrl' => \yii\helpers\Url::to(['/validate/subscribe']),
    'options' => ['class' => 'form-inline']
]);
?>
<?=$form->field($model,'email')->textInput(['placeholder' => 'Enter Your email address'])->label(false) ?>

<?=\yii\helpers\Html::submitButton('Notify Me!', ['class' => 'btn btn-success']) ?>

<?php
\yii\bootstrap\ActiveForm::end();
?>