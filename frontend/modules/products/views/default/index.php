<?php
use yii\helpers\Html;

$this->title = 'Каталог продукции';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="properties-listing">
    <div class="row">
        <div class="col-lg-3 col-sm-4 ">
            <?= Html::beginForm(\yii\helpers\Url::to('products'),'get') ?>
            <div class="search-form">
                <h4><span class="glyphicon glyphicon-search"></span> Параметры поиска</h4>
                <?=Html::textInput('propert', $request->get('propert'), [
                    'class' => 'form-control',
                    'placeholder' => 'Название'
                ])
                ?>
                <div class="row">
                    <div class="col-lg-12">
                        <?=Html::dropDownList('price', $request->get('price'),[
                            '0-10' => '0₽ - 10₽',
                            '11-20' => '11₽ - 20₽',
                            '21-30' => '21₽ - 30₽',
                            '31' => '31₽ - выше',
                        ],['class' => 'form-control', 'prompt' => 'Цена']) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <?=Html::dropDownList('type', $request->get('type'),[
                            'Баранки' => 'Баранки',
                            'Батоны' => 'Батоны',
                            'Булочки' => 'Булочки',
                            'Кексы' => 'Кексы',
                            'Сухари' => 'Сухари',
                            'Хлеб' => 'Хлеб',
                            'Эксклюзивная' => 'Эксклюзивная'
                        ],['class' => 'form-control', 'prompt' => 'Вид']) ?>
                    </div>
                </div>
                <?=Html::checkbox('new', $request->get('new'), [
                    'unchecked',
                    'label' => 'Новинка'
                ])
                ?>
                <hr>
                <button class="btn btn-primary">Найти</button>
                <?= Html::endForm() ?>
            </div>
            <div class="new-properties hidden-xs">
                <?php echo \frontend\widgets\NewWidget::widget() ?>
            </div>
        </div>
        <div class="col-lg-9 col-sm-8">
            <div class="row">
                <?php
                foreach($model as $row):
                    $url = \frontend\components\Common::getUrlProduct($row);
                    ?>
                    <!-- properties -->
                    <div class="col-lg-4 col-sm-6">
                        <div class="properties">
                            <div class="image-holder">
                                <img src="<?=\frontend\components\Common::getImageProduct($row)[0] ?>"  class="img-responsive" alt='properties'>
                                <div class="status <?=($row['new']) ? 'new' : 'recommend' ?>"><?=\frontend\components\Common::getTypeProduct($row) ?></div>
                            </div>
                            <h4 style="height: 42px;"><a href="<?=$url ?>" ><?=\frontend\components\Common::getS_Title($row) ?></a></h4>
                            <h4 class="text-center">
                                <p style="text-indent: 0px;" class="price text-center">Цена: <?= $row['price'] ?> &#8381;</p>
                                <p style="text-indent: 0px;">Вес: <?=$row['weight'] ?> г</p>
                            </h4>
                            <a class="btn btn-primary" href="<?=$url ?>" >Детальнее</a>
                        </div>
                    </div>
                    <?php
                endforeach;
                ?>
                <!-- properties -->
                <div class="clearfix"></div>
                <!-- properties -->
                <div class="center">
                    <?php echo \yii\widgets\LinkPager::widget([
                        'pagination' => $pages
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</div>
