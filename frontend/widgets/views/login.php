<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

?>
<div id="loginpop" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="row">
                <div class="col-sm-12 login">
                    <h4>Авторизация</h4>
                    <?php
                    $form = ActiveForm::begin([
                        'enableAjaxValidation' => true,
                        'validationUrl' => Url::to(['/validate/index']),
                    ]);
                    ?>

                    <?= $form->field($model, 'username') ?>
                    <?= $form->field($model, 'password')->passwordInput() ?>
                    <?= $form->field($model, 'rememberMe')->checkbox() ?>

                    <?= Html::submitButton('Вход', ['class' => 'btn btn-success']) ?>

                    <?php
                    ActiveForm::end();
                    ?>
                </div>

            </div>
        </div>
    </div>
</div>