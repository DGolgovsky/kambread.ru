<?php
$this->title = 'Новости';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <div class="spacer blog">
        <div class="row">
            <div class="col-lg-12 col-sm-12 col-xs-12">
                <?php
                foreach($model as $row):
                    $url = \frontend\components\Common::getUrlNews($row);
                    ?>
                    <!-- news list -->
                    <div class="row">
                        <div class="col-lg-4 col-sm-4 "><a href="<?=$url ?>"  class="thumbnail"><img src="<?=\frontend\components\Common::getImageNews($row)[0] ?>"  alt='blog title'></a></div>
                        <div class="col-lg-8 col-sm-8 ">
                            <h3><a href="<?= $url ?>" ><?= \frontend\components\Common::getTitle($row) ?></a></h3>
                            <div class="info"><span class="glyphicon glyphicon-time"></span> Создано: <?= \frontend\components\Common::getCreationDate($row) ?></div>
                            <?php $row['description'] = preg_replace("(\r\n|\n|\r)", "<BR/>", $row['description']); ?>
                        <p><?=\frontend\components\Common::substr($row['description'], 0, 600) ?></p>
                        </div>
                </div>
                <!-- #news list -->
                    <?php
                endforeach;
                ?>
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
