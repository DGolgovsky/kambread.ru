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
	
	<?= $form->field($model, 'price')->textInput(['placeholder' => 'Цена']) ?>
	
	<?= $form->field($model, 'weight')->textInput(['placeholder' => 'Вес в граммах']) ?>

	<?= $form->field($model, 'description')->textArea(['rows' => 6, ['placeholder' => 'Описание']]) ?>

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
		<div class="row">
			<div class="col-lg-3">
				<?= Html::submitButton($model->isNewRecord ? 'Добавить изображение' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
			</div>
		</div>
	</div>

	<?php ActiveForm::end(); ?>

</div>