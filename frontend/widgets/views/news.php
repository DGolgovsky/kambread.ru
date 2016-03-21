<div class="col-lg-5 col-lg-offset-1 col-sm-3 recommended">
    <h3>Новости</h3>
    <div id="myCarousel" class="carousel slide">
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
                        <div class="col-lg-4">
                            <img src="<?=\frontend\components\Common::getImageNews($rec)[0] ?>"  class="img-responsive" alt="properties"/>
                        </div>
                        <div class="col-lg-8">
                            <h5>
                                <a href="<?=\frontend\components\Common::getUrlNews($rec) ?>" ><?=\frontend\components\Common::getTitle($rec) ?></a>
                            </h5>
                            <p><?=$rec['description'] ?></p>
                            <a href="<?=\frontend\components\Common::getUrlNews($rec) ?>"  class="more">Подробнее</a>
                        </div>
                    </div>
                </div>
                <?php
                $i++;
            endforeach;
            ?>
        </div>
    </div>
</div>
</div>