<?php
use yii\helpers\Html;
?>

<div class="properties-listing spacer">

    <div class="row">
        <div class="col-lg-3 col-sm-4 ">
            <?= Html::beginForm(\yii\helpers\Url::to('/main/main/find/'),'get') ?>
            <div class="search-form"><h4><span class="glyphicon glyphicon-search"></span> Search for</h4>
                <?=Html::textInput('propert', $request->get('propert'), ['class' => 'form-control', 'placeholder' => 'Search of Properties']) ?>
                <div class="row">
                    <div class="col-lg-12">
                        <?=Html::dropDownList('price', $request->get('price'),[
                            '0-150' => '$0 - $150',
                            '150-300' => '$150 - $300',
                            '300-450' => '$300 - $450',
                            '450' =>'$450 - above',
                        ],['class' => 'form-control', 'prompt' => 'Price']) ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <?=Html::dropDownList('apartment', $request->get('apartment'),[
                            'Apartment',
                            'Building',
                            'Office Space',
                        ],['class' => 'form-control', 'prompt' => 'Property']) ?>
                    </div>
                </div>
                <button class="btn btn-primary">Find Now</button>
                <?= Html::endForm() ?>

            </div>



            <div class="hot-properties hidden-xs">

                <?php echo \frontend\widgets\HotWidget::widget() ?>

            </div>


        </div>

        <div class="col-lg-9 col-sm-8">
            <div class="row">

                <?php
                foreach($model as $row):
                    $url = \frontend\components\Common::getUrlAdvert($row);
                    ?>
                    <!-- properties -->
                    <div class="col-lg-4 col-sm-6">
                        <div class="properties">
                            <div class="image-holder"><img src="<?=\frontend\components\Common::getImageAdvert($row)[0] ?>"  class="img-responsive" alt="properties">
                                <div class="status <?=($row['sold']) ? 'sold' : 'new' ?>"><?=\frontend\components\Common::getType($row) ?></div>
                            </div>
                            <h4><a href="<?=$url ?>" ><?=\frontend\components\Common::getTitleAdvert($row) ?></a></h4>
                            <p class="price">Price: $<?=$row['price'] ?></p>
                            <div class="listing-detail"><span data-toggle="tooltip" data-placement="bottom" data-original-title="Bed Room"><?=$row['bedroom'] ?></span> <span data-toggle="tooltip" data-placement="bottom" data-original-title="Living Room"><?=$row['livingroom'] ?></span> <span data-toggle="tooltip" data-placement="bottom" data-original-title="Parking"><?=$row['parking'] ?></span> <span data-toggle="tooltip" data-placement="bottom" data-original-title="Kitchen"><?=$row['kitchen'] ?></span> </div>
                            <a class="btn btn-primary" href="<?=$url ?>" >View Details</a>
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