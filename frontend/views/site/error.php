<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = nl2br(Html::encode($message));
$this->params['breadcrumbs'][] = nl2br(Html::encode($name));
?>
<?php \Yii::$app->session->setFlash('error', '<?= nl2br(Html::encode($message)) ?>');?>
<div class="site-error">
    <div class="grid">
        <div class="row space-top space-bot">
            <div style="text-align:center;">
                <h2>ИЗВИНИТЕ, СТРАНИЦА НЕ НАЙДЕНА</h2>
                <p>
                    <img src="images/404.png">
                </p>
                <div class="actionbutton">
                    <a href="/index"><i class=" icon-link"></i> ВЕРНУТЬСЯ НА ГЛАВНУЮ</a>
                </div>
            </div>
        </div>

    </div><!-- end grid -->
</div>
