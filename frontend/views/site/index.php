<?php
use frontend\components\Common;
?>
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 contacts">
            <h3 class="text-right">
                <small>
                    <span class="contacts__info"><a href="contact" title="Контакты">Контакты</a></span> <span class="divider">|</span>
                    <span class="contacts__info">Приемная:</span>
                    <span class="contacts__info">(84457) 9-64-64</span> <span class="divider">|</span>
                    <span class="contacts__info">Отдел продаж: (84457) 9-39-84</span>
                </small>
            </h3>
        </div>
    </div>
</div>
<!-- slider-wrapper -->
<div id="slider" class="sl-slider-wrapper">
    <div class="sl-slider">
        <?php foreach($result_general as $row): ?>
            <div class="sl-slide" data-orientation="horizontal" data-slice1-rotation="-25" data-slice2-rotation="-25" data-slice1-scale="2" data-slice2-scale="2">
                <div class="sl-slide-inner">
                    <div class="bg-img" style="background-image: url('<?= Common::getImageProduct($row)[0] ?>')"></div>
                    <h2>
                        <a href="<?= Common::getUrlProduct($row) ?>">
                            <?= Common::getTitle($row) ?>
                        </a>
                    </h2>
                    <blockquote>
                        <?php $row['description'] = preg_replace("(\r\n|\n|\r)", "<BR/>", $row['description']); ?>
                        <p><?= Common::substr($row['description'], 0, 150) ?></p>
                        <cite><?= $row['price'] ?> &#8381;</cite>
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
</div>
<!-- /slider-wrapper -->
<div class="spacer"></div>
<div class="container">
    <section class="advantages container text-center">
        <h2 class="title" style="margin-left: 50px;">
            <div id="bl-new-production">
                <h2 class="lined" style="color: #964812; margin-bottom: 30px;">
                    <span>Наши преимущества<i></i><i></i></span>
                </h2>
            </div>
        </h2>
        <div class="row">
            <div class="col-lg-2 col-md-2 hidden-sm hidden-xs">
                <img src="/images/advantages/advantages-1.png" alt="" class="img-responsive center-block">
                C 1956 года<br>на рынке
            </div>
            <div class="col-lg-2 col-md-2 col-sm-3 hidden-xs">
                <img src="/images/advantages/advantages-2.png" alt="" class="img-responsive center-block">
                Работает<br>более 300 чел
            </div>
            <div class="col-lg-2 col-md-2 col-sm-3 col-xs-4">
                <img src="/images/advantages/advantages-3.png" alt="" class="img-responsive center-block">
                Используем только<br>российское сырье
            </div>
            <div class="col-lg-2 col-md-2 col-sm-3 col-xs-4">
                <img src="/images/advantages/advantages-4.png" alt="" class="img-responsive center-block">
                Всегда свежий<br>хлеб и выпечка
            </div>
            <div class="col-lg-2 col-md-2 col-sm-3 col-xs-4">
                <img src="/images/advantages/advantages-5.png" alt="" class="img-responsive center-block">
                Лидер региона<br>по продажам
            </div>
            <div class="col-lg-2 col-md-2 hidden-sm hidden-xs">
                <img src="/images/advantages/advantages-6.png" alt="" class="img-responsive center-block">
                Строго соблюдаем<br>график доставки
            </div>
        </div>
    </section>
    <div class="row">
        <div class="properties-listing spacer">
            <h2 style="margin-left: 50px;">
                <div id="bl-new-production">
                    <h2 class="lined" style="color: #964812; margin-bottom: 30px;">
                        <span>Наша продукция<i></i><i></i></span>
                    </h2>
                </div>
            </h2>
            <div id="owl-example" class="owl-carousel">
                <?php foreach($featured as $row): ?>
                    <div class="properties">
                        <div class="image-holder">
                            <img src="<?=Common::getImageProduct($row)[0] ?>" class="img-responsive" alt='<?=Common::getS_Title($row) ?>' style="height: 131.;">
                            <div class="status <?=($row['new']) ? 'new' : 'recommend' ?>"><?= Common::getTypeProduct($row) ?></div>
                        </div>
                        <h4 style="height: 42px;;"><a href="<?=Common::getUrlProduct($row) ?>"><?= Common::getS_Title($row) ?></a></h4>
                        <h4 class="text-center">
                            <p style="text-indent: 0px;" class="price">Цена: <?= $row['price'] ?> &#8381;</p>
                            <p style="text-indent: 0px;" class="price">Вес: <?=$row['weight'] ?> г</p>
                        </h4>
                        <a class="btn btn-primary" href="<?= Common::getUrlProduct($row) ?>">Подробнее</a>
                    </div>
                    <?php
                endforeach;
                ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <h3>О компании</h3>
            <p class="text-left" style="text-indent: 30px; margin-bottom: 5px;">
                Камышинский хлебокомбинат - ведущий производитель хлеба и хлебобулочных изделий в Камышинском районе.
            </p>
            <p style="text-indent: 30px; margin-bottom: 5px;">
                Предприятие выпускает 10 видов хлеба и более 65 видов хлебобулочных изделий (булочные, бараночные,
                кондитерские, сухарные изделия), постоянно осуществляет усовершенствование технологии производства, качества продукции, улучшение ее внешнего вида.
            </p>
            <h3 style="text-indent: 30px; margin-bottom: 5px;"><small>Наши преимущества:</small></h3>
            <ul>
                <li>новейшее высокотехнологичное оборудование</li>
                <li>собственная лаборатория для контрля качества продукции</li>
                <li>гибкая система скидок для покупателей</li>
                <li>широкий ассортимент продукции</li>
                <li>только натуральное экологически чистое сырье</li>
            </ul>
            <a href="about" >Подробнее о нас</a>
        </div>
        <?php
        echo \frontend\widgets\NewsWidget::widget();
        ?>
    </div>
</div>
