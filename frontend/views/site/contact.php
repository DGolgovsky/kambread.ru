<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;

$this->title = 'Контакты';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row contact">
	<div class="col-lg-6 col-sm-6 col-xs-12">
		<h3><span class="glyphicon glyphicon-phone"></span> Связаться с нами</h3>
		</hr>
		<!-- Contact Info -->
		<dl>
			<dt>Address:</dt>
			<dd>403874 ул. Ленина 4, Камышин, Волгоградская область, Российская Федерация</dd>
			<dt>Phone:</dt>
			<dd>+7 84457 9 39 84</dd>
			<dt>Fax:</dt>
			<dd>+7 84457 9 64 64</dd>
			<dt>Email:</dt>
			<dd><a href="mailto:market@kambread.ru">market@kambread.ru</a></dd>
		</dl>
		<!-- End Contact Info -->
	</div>
	<div class="col-lg-6 col-sm-6 col-xs-12">
		<div class="enquiry">
			<h3><span class="glyphicon glyphicon-envelope"></span> Отправить отзыв</h3>
			<?php
			$form = \yii\bootstrap\ActiveForm::begin();
			?>
			<?=$form->field($model,'name')->textInput(['placeholder' => 'Ваше имя'])->label(false) ?>
			<?=$form->field($model,'email')->textInput(['placeholder' => 'Ваш e-mail'])->label(false) ?>
			<?=$form->field($model,'subject')->textInput(['placeholder' => 'Тема'])->label(false) ?>
			<?=$form->field($model,'body')->textArea(['rows' => 3, 'placeholder' => 'Что Вы думаете?'])->label(false) ?>
			<?=\yii\helpers\Html::submitButton('Отправить',['class' => 'btn btn-success']) ?>
			<?php \yii\bootstrap\ActiveForm::end(); ?>
		</div>
	</div>
</div>
<div class="spacer"></div>
<div class="well">
	<iframe width="100%" height="350" frameborder="0" scrolling="yes" marginheight="0" marginwidth="0" src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d2558.8943616045126!2d45.4038037114014!3d50.10698423255289!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sru!2sru!4v1458632244816" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
</div>
