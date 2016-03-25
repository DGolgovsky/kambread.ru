<?php
if(Yii::$app->user->isGuest) {
    echo \frontend\widgets\Login::widget();
}
?>
<style>

     .footer dl {
        text-indent: 0px;;
        margin-top: 0;
        margin-bottom: 10px;
    }
     .footer dt {
        float: left;
        width: 100px;
        text-align: left;
        font-weight: normal;
    }
     .footer dd {
        margin-left: 0px;
    }
    
    .phones dt {
        width: 130px;
    }
</style>
<div class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-sm-3 col-xs-12">
                <h4><span class="glyphicon glyphicon-user"></span> Социальные сети</h4>
                <a href="http://facebook.com/kambread"><img src="/images/facebook.png"  alt="Facebook"></a>
                <a href="http://ok.ru/group/52685470564514"><img src="/images/ok.png"  alt="Одноклассники"></a>
                <a href="http://vk.com/kam.hleb"><img src="/images/vk.png"  alt="ВКонтакте"></a>
            </div>
            <div class="col-lg-3 col-sm-3 col-xs-12">
                <h4><span class="glyphicon glyphicon-map-marker"></span> Адрес</h4>
                <p>403874, Россия, Волгоградская область,<br>г. Камышин, ул. Ленина, 4</p>
            </div>
            <div class="col-lg-3 col-sm-3 col-xs-12">
                <h4><span class="glyphicon glyphicon-earphone"></span> Телефоны</h4>
                <dl class="text-left dl-horizontal footer phones">
                    <dt>Приемная</dt>
                    <dd>(84457) 9 64 64</dd>
                    <dt>Отдел маркетинга<dt>
                    <dd>(84457) 9 39 84</dd>
                    <dt>Отдел сбыта</dt>
                    <dd>(84457) 9 64 56</dd>
                    <dt>Лаборатория</dt>
                    <dd>(84457) 9 64 05</dd>
                </dl>
            </div>
            <div class="col-lg-3 col-sm-3 col-xs-12">
                <h4><span class="glyphicon glyphicon-envelope"></span> E-mail</h4>
                <dl class="text-left dl-horizontal footer">
                    <dt>Отдел продаж</dt>
                    <dd><a href="mailto:market@kambread.ru" target="_self">market@kambread.ru</a></dd>
                    <dt>Общий<dt>
                    <dd><a href="mailto:kam.khk@mail.ru" target="_self">kam.khk@mail.ru</a></dd>
                    <dt>Web-master</dt>
                    <dd><a href="mailto:support@kambread.ru" target="_self">support@kambread.ru</a></dd>
                </dl>
            </div>
        </div>
    </div>
</div>
