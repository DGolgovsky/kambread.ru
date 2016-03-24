<div class="col-lg-5 col-lg-offset-1 col-md-5 col-md-offset-1 hidden-sm hidden-xs">
    <h3>Новости</h3>
    <div id="myCarousel" class="carousel slide" style="height: 350px;">
        <ol class="carousel-indicators">
            <?php
            if($result_count >= 1):
                ?>
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <?php
            endif;
            ?>
            <?php
            if($result_count > 1):
                foreach(range(1, $result_count-1) as $count):
                    ?>
                    <li data-target="#myCarousel" data-slide-to="<?=$count ?>"></li>
                    <?php
                endforeach;
            endif;
            ?>
        </ol>
        <!-- Carousel items -->
        <div class="carousel-inner">
            <?php
            $i = 0;
            foreach($result as $rec):
                ?>
                <div class="item <?=($i == 0) ? 'active' : '' ?>">
                    <div class="row">
                        <h5 style="text-indent: 20px;"><a href="<?=\frontend\components\Common::getUrlNews($rec) ?>" ><?=\frontend\components\Common::getTitle($rec) ?></a></h5>
                        <div class="pull-left bg-default" style="width: 20em; padding: 20px;">
                            <img src="<?=\frontend\components\Common::getImageNews($rec)[0] ?>"  class="img-responsive" alt="properties"/>
                            <a href="<?=\frontend\components\Common::getUrlNews($rec) ?>"  class="more">Подробнее</a>
                        </div>

                        <p><?= \frontend\components\Common::substr($rec['description'], 0, 70) ?></p>
                    </div>
                </div>
                <?php
                $i++;
            endforeach;
            ?>
        </div>
    </div>
</div>
