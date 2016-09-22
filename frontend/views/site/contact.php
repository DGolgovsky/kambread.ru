<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

$this->title = 'Контакты';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
        <h3><span class="glyphicon glyphicon-phone"></span> Связаться с нами</h3>
        </hr>
        <!-- Contact Info -->
        <dl class="dl-horizontal">
            <dt>Адрес</dt>
            <dd>403874 ул. Ленина 4, Камышин, Волгоградская область, Российская Федерация</dd>
            <dt>Прием заявок</dt>
            <dd>(84457) 9 64 56</dd>
            <dd>(937) 535 11 19</dd>
            <dt>Отдел маркетинга</dt>
            <dd>(84457) 9 39 84</dd>
            <dd>(937) 535 11 14</dd>
            <dd><a href="mailto:marketing@kambread.ru">marketing@kambread.ru</a></dd>
            <dd><a href="mailto:sales.department@kambread.ru">sales.department@kambread.ru</a></dd>
            <dt>Секретарь</dt>
            <dd>(84457) 9 64 64 тел/факс</dd>
            <dd><a href="mailto:secretary@kambread.ru">secretary@kambread.ru</a></dd>
            <dt>Отдел кадров</dt>
            <dd>(84457) 9 63 44</dd>
            <dd><a href="mailto:hr.department@kambread.ru">hr.department@kambread.ru</a></dd>
            <dt>Бухгалтерия</dt>
            <dd>(84457) 9 63 77</dd>
            <dd><a href="mailto:buhgaltery@kambread.ru">buhgaltery@kambread.ru</a></dd>
            <dt>Лаборатория и ОТК</dt>
            <dd>(84457) 9 64 05</dd>
            <dd><a href="mailto:laboratory@kambread.ru">laboratory@kambread.ru</a></dd>
        </dl>
        <!-- End Contact Info -->
    </div>
    <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
        <div class="enquiry">
            <h3><span class="glyphicon glyphicon-envelope"></span> Отправить отзыв</h3>
            <?php
            $form = \yii\bootstrap\ActiveForm::begin();
            ?>
            <?= $form->field($model, 'name')->textInput(['placeholder' => 'Ваше имя'])->label(false) ?>
            <?= $form->field($model, 'email')->textInput(['placeholder' => 'Ваш e-mail'])->label(false) ?>
            <?= $form->field($model, 'subject')->textInput(['placeholder' => 'Тема'])->label(false) ?>
            <?= $form->field($model, 'body')->textArea(['rows' => 5, 'placeholder' => 'Что Вы думаете?'])->label(false) ?>
            <?= \yii\helpers\Html::submitButton('Отправить', ['class' => 'btn btn-success']) ?>
            <?php \yii\bootstrap\ActiveForm::end(); ?>
        </div>
    </div>
</div>
<div class="row well">
    <iframe width="100%" height="350" frameborder="0" scrolling="yes" marginheight="0" marginwidth="0"
            src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d2558.8943616045126!2d45.4038037114014!3d50.10698423255289!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sru!2sru!4v1458632244816"
            width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
</div>
