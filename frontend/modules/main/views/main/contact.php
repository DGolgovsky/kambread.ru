<?php
$this->title = 'О компании';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row contact">
    <p>Дата основания предприятия - декабрь 1956 г.</p>
    <p>В 1993 году хлебокомбинат вышел из подчинения Министерства хлебопекарной промышленности, стал структурой муниципалитета. В августе 2006 года было создано ОАО «Камышинский хлебокомбинат» путем преобразования муниципального унитарного предприятия «Камышинский хлебокомбинат». Учредителем ОАО «Камышинский хлебокомбинат» является комитет по управлению имуществом Администрации городского округа – город Камышин.</p>
    <div>
        <p>На предприятии проводится проверка поступающего сырья, контроль всех этапов технологического производства. Контроль качества готовой продукции проводятся силами собственной лаборатории.</p>
        <p>ОАО «Камышинский хлебокомбинат» выпускает широкий ассортимент хлебобулочных изделий из натурального сырья. Вся продукция предприятия сертифицирована и производится согласно существующей нормативно-технической документации.</p>
    </div>
    <div class="col-lg-6 col-lg-offset-3 col-sm-6 col-sm-offset-3 col-xs-12 ">
        <h2>Оставить отзыв</h2>
        <?php
            $form = \yii\bootstrap\ActiveForm::begin();
        ?>
        <?= $form->field($model, 'name') ?>
        <?= $form->field($model, 'email') ?>
        <?= $form->field($model, 'subject') ?>
        <?= $form->field($model, 'body')->textArea(['rows' => 6]) ?>
        <?= $form->field($model, 'verifyCode')->widget(\yii\captcha\Captcha::className(), [
            'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
            'captchaAction' => \yii\helpers\Url::to(['main/captcha'])
        ]) ?>
        <?=\yii\helpers\Html::submitButton('Отправить',['class' => 'btn btn-success']) ?>
        <?php
            \yii\bootstrap\ActiveForm::end();
        ?>
    </div>
</div>