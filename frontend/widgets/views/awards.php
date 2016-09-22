<div class="row">
    <div class="col-md-8 col-sm-12 col-xs-12">
        <h3 class="text-center">
            <small>Достижения и результаты деятельности предприятия</small>
        </h3>
        <dl class="dl-horizontal">
            <?php use frontend\components\Common;

            foreach ($result as $res): ?>
                <dt class="about-page"><?= $res['date'] ?></dt>
                <dd><?= $res['description'] ?></dd>
            <?php endforeach; ?>
        </dl>
    </div>
    <div class="col-md-4 hidden-sm hidden-xs">
        <!-- Slider Starts -->
        <div id="myCarousel" class="carousel slide" data-ride="carousel" style="width:100%; height:450px">
            <!-- Indicators -->
            <ol class="carousel-indicators hidden-xs">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <?php
                foreach (range(1, count($result_img) - 1) as $s):
                    ?>
                    <li data-target="#myCarousel" data-slide-to="<?= $s ?>" class=""></li>
                    <?php
                endforeach;
                ?>
            </ol>
            <div class="carousel-inner">
                <?php
                $i = 0;
                foreach ($result_img as $row):
                    ?>
                    <div class="item <?= ($i == 0) ? 'active' : '' ?>">
                        <img src="<?= \frontend\components\Common::getImageAward($row)[0] ?>"
                             class="img-responsive center-block" alt=""/>
                    </div>
                    <?php
                    $i++;
                endforeach;
                ?>
            </div>
        </div>
        <!-- #Slider Ends -->
    </div>
</div>

