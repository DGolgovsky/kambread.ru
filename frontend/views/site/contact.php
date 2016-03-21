<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;

$this->title = 'Контакты';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-contact">
	<p>If you have business inquiries or other questions, please fill out the following form to contact us. Thank you.</p>
	<div class="row">
		<div class="col-lg-6 col-lg-offset-3 col-sm-6 col-sm-offset-3 col-xs-12 ">
			<h2>Оставить отзыв</h2>
			<?php $form = \yii\bootstrap\ActiveForm::begin(['id' => 'contact-form']); ?>
			<?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>
			<?= $form->field($model, 'email') ?>
			<?= $form->field($model, 'subject') ?>
			<?= $form->field($model, 'body')->textArea(['rows' => 6]) ?>
			<?= $form->field($model, 'verifyCode')->widget(\yii\captcha\Captcha::className(), [
				'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
				'captchaAction' => \yii\helpers\Url::to(['/site/captcha'])
			]) ?>
			<div class="form-group">
				<?= Html::submitButton('Отправить', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
			</div>
			<?php
			\yii\bootstrap\ActiveForm::end();
			?>
		</div>
	</div>
</div>
