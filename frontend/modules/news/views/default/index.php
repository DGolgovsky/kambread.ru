<?php
$this->title = 'Новости';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <div class="spacer blog">
        <div class="row">
            <div class="col-lg-8 col-sm-12 ">
                <?php
                foreach($model as $row):
                    $url = \frontend\components\Common::getUrlNews($row);
                    ?>
                    <!-- news list -->
                    <div class="row">
                        <div class="col-lg-4 col-sm-4 "><a href="<?=$url ?>"  class="thumbnail"><img src="<?=\frontend\components\Common::getImageNews($row)[0] ?>"  alt="blog title"></a></div>
                        <div class="col-lg-8 col-sm-8 ">
                            <h3><a href="<?= $url ?>" ><?= \frontend\components\Common::getTitle($row) ?></a></h3>
                            <div class="info">Создано: <?= \frontend\components\Common::getCreationDate($row) ?></div>
                        <p><?=\frontend\components\Common::substr($row['description'], 0, 100) ?></p>
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
            <div class="col-lg-4 visible-lg">

                <!-- tabs -->
                <div class="tabbable">
                    <ul class="nav nav-tabs">
                        <li class=""><a href="#tab1" data-toggle="tab">Recent Post</a></li>
                        <li class=""><a href="#tab2" data-toggle="tab">Most Popular</a></li>
                        <li class="active"><a href="#tab3" data-toggle="tab">Most Commented</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane" id="tab1">
                            <ul class="list-unstyled">
                                <li>
                                    <h5><a href="blogdetail.html" >Real estate marketing growing</a></h5>
                                    <div class="info">Posted on: Jan 20, 2013</div>
                                </li>
                                <li>
                                    <h5><a href="blogdetail.html" >Real estate marketing growing</a></h5>
                                    <div class="info">Posted on: Jan 20, 2013</div>
                                </li>
                                <li>
                                    <h5><a href="blogdetail.html" >Real estate marketing growing</a></h5>
                                    <div class="info">Posted on: Jan 20, 2013</div>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-pane" id="tab2">
                            <ul  class="list-unstyled">
                                <li>
                                    <h5><a href="blogdetail.html" >Market update on new apartments</a></h5>
                                    <div class="info">Posted on: Jan 20, 2013</div>
                                </li>

                                <li>
                                    <h5><a href="blogdetail.html" >Market update on new apartments</a></h5>
                                    <div class="info">Posted on: Jan 20, 2013</div>
                                </li>

                                <li>
                                    <h5><a href="blogdetail.html" >Market update on new apartments</a></h5>
                                    <div class="info">Posted on: Jan 20, 2013</div>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-pane active" id="tab3">
                            <ul class="list-unstyled">
                                <li>
                                    <h5><a href="blogdetail.html" >Creative business to takeover the market</a></h5>
                                    <div class="info">Posted on: Jan 20, 2013</div>
                                </li>

                                <li>
                                    <h5><a href="blogdetail.html" >Creative business to takeover the market</a></h5>
                                    <div class="info">Posted on: Jan 20, 2013</div>
                                </li>
                            </ul>
                        </div>
                    </div>



                </div>
                <!-- tabs -->

            </div>
        </div>
    </div>
</div>
