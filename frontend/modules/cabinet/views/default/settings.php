<?php
$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Кабинет', 'url' => ['/cabinet']];
$this->params['breadcrumbs'][] = 'Профиль';
?>
<div class="row">
    <div class="col-lg-8 col-md-8 col-sm-8">
        <?php
        $form = \yii\bootstrap\ActiveForm::begin([
            'options' => ['enctype' => 'multipart/form-data']
        ]);
        ?>
        <?=$form->field($model,'name')->textInput(['autofocus' => true]) ?>
        <?=$form->field($model,'username') ?>
        <?=$form->field($model,'email') ?>
        <?=$form->field($model,'phone') ?>
        <?=\yii\helpers\Html::label('Фото профиля') ?>
        <?=\yii\helpers\Html::fileInput('avatar') ?>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-4">
        <?=\yii\helpers\Html::img(\common\components\UserComponent::getUserImage(\Yii::$app->user->id), ['width' => 200, 'class' => 'img-circle center-block img-responsive']) ?>
        <hr>
        <div class="bg-info center-block" style="width: 20em; padding: 10px;">
            <h3><small>Внимание!</small></h3>
            <p>На текущий момент пароль от сайта и от почтового ящика различаются. Для уточнения пароля от email свяжитесь с <a href="mailto:support@kambread.ru" target="_self">поддержкой</a> сайта.</p>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-4 col-sm-4 col-xs-4">
        <?= \yii\helpers\Html::a('Изменить пароль', ['/cabinet/change-password'], ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <div class="col-lg-4 col-sm-4 col-xs-4">
        <?= \yii\helpers\Html::submitButton('Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php \yii\bootstrap\ActiveForm::end() ?>
</div>
