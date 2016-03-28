<?php
$this->title = 'Смена пароля';
$this->params['breadcrumbs'][] = ['label' => 'Кабинет', 'url' => ['/cabinet']];
$this->params['breadcrumbs'][] = ['label' => 'Профиль', 'url' => ['settings']];
$this->params['breadcrumbs'][] = 'Пароль';
?>
<div class="product-form">
    <h2 style="text-align: center"><small>Здесь Вы можете поменять пароль пользователя для входа. Просто введите его ниже.</small></h2>
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2"
    <?php $form = \yii\bootstrap\ActiveForm::begin(); ?>

    <?=$form->field($model,'password')->passwordInput() ?>
    <?=$form->field($model,'repassword')->passwordInput() ?>

    <?= \yii\helpers\Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
    <?php \yii\bootstrap\ActiveForm::end() ?>
    </div></div>
</div>
