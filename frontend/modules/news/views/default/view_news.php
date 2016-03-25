<?php
$this->title = 'Просмотр новости';
$this->params['breadcrumbs'][] = ['label' => 'Новости', 'url' => ['/news']];
$this->params['breadcrumbs'][] = 'Просмотр';
?>
<div class="container">
    <div class="row">
        <div class="col-lg-8">
            <!-- news detail -->
            <h2><?=\frontend\components\Common::getTitle($model) ?></h2>
            <div class="info"><span class="glyphicon glyphicon-time"></span> Создано: <?= \frontend\components\Common::getCreationDate($model) ?></div>
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
        </div>
        <div class="col-lg-4 visible-lg">
            <div id="hypercomments_widget"></div>
            <script type="text/javascript">
                _hcwp = window._hcwp || [];
                _hcwp.push({widget:"Stream", widget_id: 72610});
                (function() {
                    if("HC_LOAD_INIT" in window)return;
                    HC_LOAD_INIT = true;
                    var lang = (navigator.language || navigator.systemLanguage || navigator.userLanguage || "ru").substr(0, 2).toLowerCase();
                    var hcc = document.createElement("script"); hcc.type = "text/javascript"; hcc.async = true;
                    hcc.src = ("https:" == document.location.protocol ? "https" : "http")+"://w.hypercomments.com/widget/hc/72610/"+lang+"/widget.js";
                    var s = document.getElementsByTagName("script")[0];
                    s.parentNode.insertBefore(hcc, s.nextSibling);
                })();
            </script>
            <a href="http://hypercomments.com" class="hc-link" title="comments widget">comments powered by HyperComments</a>
        </div>
    </div>
    <hr>
    <div class="row">
        <?php $model->description = preg_replace("(\r\n|\n|\r)", "<BR/>", $model->description); ?>
        <p><?php echo $model->description; ?></p>
        <!-- news detail -->
    </div>
</div>
