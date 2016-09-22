<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['placeholder' => 'Наименование'])->textInput(['autofocus' => true]) ?>

    <?= $form->field($model, 's_name')->textInput(['placeholder' => 'Краткое наименование (30 символов)'])->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'price')->textInput(['placeholder' => 'Цена']) ?>

    <?= $form->field($model, 'weight')->textInput(['placeholder' => 'Вес в граммах']) ?>

    <?= $form->field($model, 'description')->widget(\yii\redactor\widgets\Redactor::className()) ?>

    <?= $form->field($model, 'new')->checkbox() ?>

    <?= $form->field($model, 'recommend')->checkbox() ?>

    <?= $form->field($model, 'status')->checkbox() ?>

    <?= $form->field($model, 'type')->dropDownList([
        'Баранки' => 'Баранки',
        'Батоны' => 'Батоны',
        'Булочки' => 'Булочки',
        'Кексы' => 'Кексы',
        'Сухари' => 'Сухари',
        'Хлеб' => 'Хлеб',
        'Эксклюзивная' => 'Эксклюзивная'
    ]) ?>

    <p class="text-info">Внимание! Новинка имеет приоритет перед рекомендацией.</p>
    <div class="form-group">
        <div class="row">
            <div class="col-lg-3">
                <?= Html::submitButton($model->isNewRecord ? 'Добавить изображение' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
            <?php if (!$model->isNewRecord) { ?>
                <div class="col-lg-2 col-md-2 col-sm-3 col-xs-4">
                    <p>
                        <?= Html::a('Изображения', ['addimg', 'id' => $model->idproduct], [
                            'class' => 'btn btn-warning'
                        ]) ?>
                    </p>
                </div>
            <?php } ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>