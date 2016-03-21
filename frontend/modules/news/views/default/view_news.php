<?php
$this->title = 'Просмотр новости';
$this->params['breadcrumbs'][] = ['label' => 'Новости', 'url' => ['/news']];
$this->params['breadcrumbs'][] = 'Просмотр';
?>
<div class="container">
    <div class="spacer blog">
        <div class="row">
            <div class="col-lg-8">
                <!-- news detail -->
                <h2><?=\frontend\components\Common::getTitle($model) ?></h2>
                <div class="info">Создано: <?= \frontend\components\Common::getCreationDate($model) ?></div>
                <div class="property-images">
                    <!-- Slider Starts -->
                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                        <!-- Indicators -->
                        <ol class="carousel-indicators hidden-xs">
                            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                            <?php
                            foreach(range(1,count($images)) as $s):
                                ?>
                                <li data-target="#myCarousel" data-slide-to="<?=$s ?>" class=""></li>
                                <?php
                            endforeach;
                            ?>
                        </ol>
                        <div class="carousel-inner">
                            <!-- Item 1 -->
                            <div class="item active">
                                <img src="<?=\frontend\components\Common::getImageNews($model)[0] ?>"  class="thumbnail img-responsive" alt="<?=\frontend\components\Common::getTitle($model) ?>" />
                            </div>
                            <?php
                            foreach($images as $image):
                                ?>
                                <div class="item">
                                    <img src="<?=$image ?>"  class="thumbnail img-responsive" alt="<?=\frontend\components\Common::getTitle($model) ?>" />
                                </div>
                                <?php
                            endforeach;
                            ?>
                        </div>
                        <a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
                        <a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
                    </div>
                    <!-- #Slider Ends -->
                </div>
                <br>
                <p><?php echo $model->description; ?></p>
                <!-- news detail -->
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
