<div class="product-form">
    <?php $form = \yii\bootstrap\ActiveForm::begin(); ?>

    <?=$form->field($model,'password')->passwordInput() ?>
    <?=$form->field($model,'repassword')->passwordInput() ?>

    <?= \yii\helpers\Html::submitButton('Change password', ['class' => 'btn btn-primary']) ?>
    <?php \yii\bootstrap\ActiveForm::end() ?>
</div>
