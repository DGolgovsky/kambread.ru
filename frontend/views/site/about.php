<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'О компании';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container">
    <div class="row">
        <div class="col-xs-8">
            <p>Дата основания предприятия - декабрь 1956 г.</p>
            <p>
                В 1993 году хлебокомбинат вышел из подчинения Министерства хлебопекарной промышленности и стал структурой муниципалитета.
                В августе 2006 года было создано ОАО «Камышинский хлебокомбинат» путем преобразования муниципального унитарного предприятия «Камышинский хлебокомбинат».
                Учредителем ОАО «Камышинский хлебокомбинат» является комитет по управлению имуществом Администрации городского округа – город Камышин.
            </p>
            <p>На предприятии проводится проверка поступающего сырья, контроль всех этапов технологического производства.
                Контроль качества готовой продукции проводятся силами собственной лаборатории.
            </p>
            <p>
                ОАО «Камышинский хлебокомбинат» уже более 50 лет является ведущим производителем хлеба и хлебобулочных изделий на местном рынке.
                Cпециализируется как на их выпечке, так и на реализации, выпускает широкий ассортимент изделий из натурального сырья.
                Вся продукция предприятия сертифицирована и производится согласно существующей нормативно-технической документации.
            </p>
            <b>Виды продукции:</b>
            <ul>
                <li>хлеб пшеничный, ржано-пшеничный;</li>
                <li>хлеб диетический, с пряностями, булочки простые и сдобные, бублики, баранки, сушки (все в евроупаковке);</li>
                <li>булочки простые, сдобные, слоеные, с начинкой, батоны, рулеты, кексы, коржи;</li>
                <li>батончики, сдобы, сухарики.</li>
            </ul>
        </div>
        <div class="col-xs-4">
            <img src="images/about/awards/festival3.jpg" alt="Фестиваль" class="img-circle img-responsive">
        </div>
    </div>
</div>
<!-- Our Clients -->
<div class="section">
    <div class="container">
        <div class="section-title">
            <h3>С нами сотрудничают</h3>
        </div>
        <div class="clients-logo-wrapper text-center row">
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6"><a href="http://magnit-info.ru/" target="_blank"><img src="images/logos/logo-1.png" width="270px" alt="Магнит"></a></div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6"><a href="http://pokupochka.ru/" target="_blank"><img src="images/logos/logo-2.png" width="270px" alt="Покупочка"></a></div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6"><a href="http://tkman.ru/" target="_blank"><img src="images/logos/logo-3.png" width="270px" alt="МАН"></a></div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6"><a href="http://www.radezh.ru/" target="_blank"><img src="images/logos/logo-4.png" width="270px" alt="Радеж"></a></div>
        </div>
    </div>
</div>
<!-- End Our Clients -->

