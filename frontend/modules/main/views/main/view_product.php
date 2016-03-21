<?php
$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Продукция', 'url' => ['catalog']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-lg-3 col-sm-4 hidden-xs">
        <?php
        echo \frontend\widgets\NewWidget::widget();
        $product_title = \frontend\components\Common::getTitleProduct($model);
        ?>
    </div>
    <div class="col-lg-9 col-sm-8 ">
        <h2><?=\frontend\components\Common::getTitleProduct($model) ?></h2>
        <div class="row">
            <div class="col-lg-8">
                <div class="property-images">
                    <!-- Slider Starts -->
                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                        <!-- Indicators -->
                        <ol class="carousel-indicators hidden-xs">
                            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                            <?php
                            foreach(range(1,count($images)) as $s):
                                ?>
                                <li data-target="#myCarousel" data-slide-to="<?=$s ?>" class=""></li>
                                <?php
                            endforeach;
                            ?>
                        </ol>
                        <div class="carousel-inner">
                            <!-- Item 1 -->
                            <div class="item active">
                                <img src="<?=\frontend\components\Common::getImageProduct($model)[0] ?>"  class="properties" alt="<?=$product_title ?>" />
                            </div>
                            <?php
                            foreach($images as $image):
                                ?>
                                <div class="item">
                                    <img src="<?=$image ?>"  class="properties" alt="<?=$product_title ?>" />
                                </div>
                                <?php
                            endforeach;
                            ?>
                        </div>
                        <a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
                        <a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
                    </div>
                    <!-- #Slider Ends -->
                </div>
                <div class="spacer">
                    <h4><span class="glyphicon glyphicon-th-list"></span> Описание</h4>
                    <p><?=$model->description ?></p>
                    <h4><span class="glyphicon glyphicon-tasks"></span> Рецептура</h4>
                    <div class="listing-detail">
                        <span data-toggle="tooltip" data-placement="bottom" data-original-title="Содержание муки">
                            Мука
                        </span><br>
                        <span data-toggle="tooltip" data-placement="bottom" data-original-title="Соль">
                            Соль
                        </span><br>
                        <span data-toggle="tooltip" data-placement="bottom" data-original-title="Дрожжи">
                            Дрожжи
                        </span><br>
                        <span data-toggle="tooltip" data-placement="bottom" data-original-title="Масло">
                            Масло
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="col-lg-12  col-sm-6">
                    <div class="property-info">
                        <h6><span class="glyphicon glyphicon-ruble"></span> Стоимость</h6>
                        <p class="price">₽ <?=$model->price ?></p>
                        <div class="profile">
                            <span class="glyphicon glyphicon-user"></span> Агент продаж
                            <p>
                                <?=$model->user->name ?>
                                <br>
                                <?=$model->user->email ?>
                                <br>
                                <?=$model->user->phone ?>
                            </p>
                        </div>
                    </div>                    
                </div>
                <div class="col-lg-12 col-sm-6 ">
                    <div class="enquiry">
                        <h6><span class="glyphicon glyphicon-envelope"></span> Отправить отзыв</h6>
                        <?php
                        $form = \yii\bootstrap\ActiveForm::begin();
                        ?>
                        <?=$form->field($model_feedback,'email')->textInput(['value' => $current_user['email'], 'placeholder' => 'Ваш e-mail'])->label(false) ?>
                        <?=$form->field($model_feedback,'name')->textInput(['value' => $current_user['name'], 'placeholder' => 'Имя'])->label(false) ?>
						<?=$form->field($model_feedback,'text')->textarea(['rows' => 6, 'placeholder' => 'Что Вы думаете?'])->label(false) ?>
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
