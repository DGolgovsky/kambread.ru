<?php
$this->title = 'Вакансии';
$this->params['breadcrumbs'][] = $this->title;
?>
<h3 class="text-center">
    <small>
        Узнать подробности Вы можете в отделе кадров по телефону: (84457) 9-63-44 или e-mail: <a
            href="mailto:hr.department@kambread.ru" target="_self">hr.department@kambread.ru</a>
    </small>
</h3>
<!-- Content Row -->
<div class="row" style="width:100%; min-height: 380px;" xmlns="http://www.w3.org/1999/html">
    <div class="col-lg-12">
        <div class="panel-group" id="accordion">
            <?php
            $index = 1;
            foreach ($model as $row):
            ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <div class="row">
                            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 text-center">
                                <h3 style="text-indent: 0px;"><?php if ($index < 10): echo '0'; endif; ?><?= $index++ ?>
                                    .</h3>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                <h3>
                                    <small><a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion"
                                              href=<?= "#collapse" . $index ?>><?= $row->name ?></a></small>
                                </h3>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 text-right">
                                <h3>
                                    <small>
                                        <span>Создано: <?= \frontend\components\Common::getCreationDate($row, 'updated_at') ?></span>
                                    </small>
                                </h3>
                            </div>
                        </div>
                    </h4>
                </div>
                <div id=<?= "collapse" . $index ?> class="panel-collapse collapse
                ">
                <div class="panel-body">
                    <?php $row->description = preg_replace("(\r\n|\n|\r)", "<BR/>", $row->description); ?>
                    <p style="text-indent: 20px;"><?= $row->description ?></p>
                </div>
            </div>
        </div>
        <!-- /.panel -->
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
    <!-- /.panel-group -->
</div>
<!-- /.col-lg-12 -->
</div>
<!-- /.row -->