<?php
$this->title = $model->s_name;
$this->params['breadcrumbs'][] = ['label' => 'Продукция', 'url' => ['/products']];
$this->params['breadcrumbs'][] = 'Просмотр';
?>
<div class="row">
    <div class="col-lg-3 col-sm-4 hidden-xs">
        <?php
        echo \frontend\widgets\NewWidget::widget();
        $product_title = \frontend\components\Common::getTitle($model);
        ?>
    </div>
    <div class="col-lg-9 col-sm-8 ">
        <h3><?= $product_title ?></h3>
        <div class="row">
            <div class="col-lg-8">
                <div class="property-images">
                    <!-- Slider Starts -->
                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <!-- Item 1 -->
                            <div class="item active">
                                <img src="<?= \frontend\components\Common::getImageProduct($model, 0)[0] ?>"
                                     class="properties" alt='<?= $product_title ?>'/>
                            </div>
                        </div>
                    </div>
                    <!-- #Slider Ends -->
                </div>
                <div class="spacer">
                    <h4><span class="glyphicon glyphicon-th-list"></span> Описание</h4>
                    <?php $model->description = preg_replace("(\r\n|\n|\r)", "<BR/>", $model->description); ?>
                    <p><?= $model->description ?></p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="col-lg-12 col-sm-6">
                    <div class="property-info">
                        <h6><span class="glyphicon glyphicon-ruble"></span> Стоимость</h6>
                        <p class="price"><?= $model->price ?> &#8381;</p>
                        <h6><span class="glyphicon glyphicon-stats"></span> Вес</h6>
                        <p class="price">г <?= $model->weight ?></p>
                    </div>
                </div>
                <div class="col-lg-12 col-sm-6 ">
                    <div class="enquiry">
                        <h6><span class="glyphicon glyphicon-envelope"></span> Отправить заявку</h6>
                        <?php
                        $form = \yii\bootstrap\ActiveForm::begin();
                        ?>
                        <?= $form->field($model_feedback, 'email')->textInput(['value' => $current_user['email'], 'placeholder' => 'Ваш e-mail'])->label(false) ?>
                        <?= $form->field($model_feedback, 'name')->textInput(['value' => $current_user['name'], 'placeholder' => 'Ваше имя'])->label(false) ?>
                        <?= $form->field($model_feedback, 'text')->textarea(['rows' => 6, 'placeholder' => 'Текст сообщения'])->label(false) ?>
                        <button type="submit" class="btn btn-primary" name="Submit">Отправить сообщение</button>
                        <?php
                        \yii\bootstrap\ActiveForm::end();
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
