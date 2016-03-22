<?php
use yii\helpers\Html;
?>
<div class="row">
    <div class="col-lg-12 col-md-12 hidden-sm hidden-xs">
        <div id="slider" class="sl-slider-wrapper">
            <div class="sl-slider">
                <?php foreach($result_general as $row): ?>
                <div class="sl-slide" data-orientation="horizontal" data-slice1-rotation="-25" data-slice2-rotation="-25" data-slice1-scale="2" data-slice2-scale="2">
                    <div class="sl-slide-inner">
                        <div class="bg-img" style="background-image: url('<?=\frontend\components\Common::getImageProduct($row)[0] ?>')")"></div>
                    <h2><a href="<?=\frontend\components\Common::getUrlProduct($row) ?>"><?=\frontend\components\Common::getTitle($row) ?></a></h2>
                    <blockquote>
                        <p><?=\frontend\components\Common::substr($row['description'], 0, 50) ?></p>
                        <cite>₽ <?=$row['price'] ?></cite>
                    </blockquote>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <!-- /sl-slider -->
        <nav id="nav-dots" class="nav-dots">
            <?php if($count_general >= 1): ?>
                <span class="nav-dot-current"></span>
            <?php endif; ?>
            <?php
            if($count_general > 1):
                foreach(range(2,$count_general) as $line):
                    ?>
                    <span></span>
                    <?php
                endforeach;
            endif;
            ?>
        </nav>
    </div><!-- /slider-wrapper -->
</div>
<div class="container">
    <div class="properties-listing spacer">
        <a href="products" class="pull-right viewall">Посмотреть все</a>
        <h2>Каталог продукции</h2>
        <div id="owl-example" class="owl-carousel">
            <?php foreach($featured as $row): ?>
                <div class="properties">
                    <div class="image-holder">
                        <img src="<?=\frontend\components\Common::getImageProduct($row)[0] ?>"  class="img-responsive" alt="<?=\frontend\components\Common::getTitle($row) ?>"/>
                        <div class="status <?=($row['recommend']) ? 'recommend' : 'new' ?>">
                            <?=\frontend\components\Common::getTypeProduct($row) ?>
                        </div>
                    </div>
                    <h4>
                        <a href="<?=\frontend\components\Common::getUrlProduct($row) ?>" >
                            <?=\frontend\components\Common::getTitle($row) ?>
                        </a>
                    </h4>
                    <h4>
                        <p class="price">
                            Цена: ₽<?=$row['price'] ?>
                            Вес: <?=$row['weight'] ?> г
                        </p>
                    </h4>
                    <a class="btn btn-primary" href="<?=\frontend\components\Common::getUrlProduct($row) ?>">Подробнее</a>
                </div>
                <?php
            endforeach;
            ?>
        </div>
    </div>
    <div class="spacer"></div>
    <div class="row">
        <div class="col-lg-6 col-sm-9 recent-view">
            <h3>О компании</h3>
            <p class="fontsize: 14px;">Камышинский хлебокомбинат - ведущий производитель хлеба и хлебобулочных изделий в Камышинском районе.<br>
                Предприятие выпускает 10 видов хлеба и более 65 видов хлебобулочных изделий (булочные, бараночные, кондитерские, сухарные изделия), постоянно осуществляет усовершенствование технологии производства, качества продукции, улучшение ее внешнего вида.<br>
                Предприятие состоит из трех производственных подразделений:<br>
                - основное производство<br>
                - бараночный участок<br>
                - булочно-кондитерский участок<br>
                <a href="about" >Подробнее</a>
            </p>
        </div>
        <?php
        echo \frontend\widgets\NewsWidget::widget();
        ?>
    </div>
</div>
