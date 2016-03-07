<div class="container">
	<div class="spacer">
		<div class="row register">
			<div class="col-lg-6 col-lg-offset-3 col-sm-6 col-sm-offset-3 col-xs-12 ">
				<?php
					$form = \yii\bootstrap\ActiveForm::begin([
						'enableClientValidation' => true,
						'enableAjaxValidation' => true,
						]);
				?>
				<?php
					echo $form->field($model, 'username');
				?>
				<?php
					echo $form->field($model, 'email');
				?>
				<?php
					echo $form->field($model, 'password')->passwordInput();
				?>
				<?php
					echo $form->field($model, 'repassword')->passwordInput();
				?>
				<?php
					echo \yii\helpers\Html::submitButton('Register', ['class' => 'btn btn-success']);
				?>
				<?php
					\yii\bootstrap\ActiveForm::end();
				?>
			</div>
		</div>
	</div>
</div>