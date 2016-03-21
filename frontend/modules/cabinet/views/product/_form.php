<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

	<?php $form = ActiveForm::begin(); ?>

	<?= $form->field($model, 'name')->textInput()->textInput(['autofocus' => true]) ?>
	
	<?= $form->field($model, 'price')->textInput() ?>

	<?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

	<?= $form->field($model, 'new')->radioList(['No', 'Yes']) ?>

	<?= $form->field($model, 'type')->dropDownList([
		'Баранки',
		'Батоны',
		'Булочки',
		'Кексы',
		'Сухари',
		'Хлеб'
	]) ?>

	<?= $form->field($model, 'recommend')->radioList(['No', 'Yes']) ?>

	<div class="form-group">
        <?= Html::submitButton('Дальше', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	</div>

	<?php ActiveForm::end(); ?>

</div>