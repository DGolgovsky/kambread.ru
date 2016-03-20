<div class="hot-properties hidden-xs">
    <h4>Посмотрите также</h4>
    <?php
    foreach($result as $res ):
        ?>
        <div class="row">
            <div class="col-lg-4 col-sm-5">
                <img src="<?=\frontend\components\Common::getImageProduct($res)[0] ?>" class="img-responsive img-circle" alt="properties"/>
            </div>
            <div class="col-lg-8 col-sm-7">
                <h5><a href="<?=\frontend\components\Common::getUrlProduct($res) ?>" ><?=\frontend\components\Common::getTitleProduct($res) ?></a></h5>
                <p class="price">₽<?=$res['price'] ?></p>
            </div>
        </div>
        <?php
    endforeach;
    ?>
</div>
