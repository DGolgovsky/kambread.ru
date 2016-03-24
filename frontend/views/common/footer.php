<?php
if(Yii::$app->user->isGuest) {
    echo \frontend\widgets\Login::widget();
}
?>
<style>
    dl {
        text-indent: 0px;;
        margin-top: 0;
        margin-bottom: 10px;
    }
    dt, dd {
        line-height: 1.428571429;
    }
    dt {
        font-weight: normal;
    }
    dd {
        margin-left: 0;
    }
    .dl-horizontal dt {
        float: left;
        width: 120px;
        overflow: hidden;
        clear: left;
        text-align: left;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    .dl-horizontal dd {
        margin-left: 120px;
    }
    .dl-horizontal dd:before,
    .dl-horizontal dd:after {
        display: table;
        content: " ";
    }
    .dl-horizontal dd:after {
        clear: both;
    }
    .dl-horizontal dd:before,
    .dl-horizontal dd:after {
        display: table;
        content: " ";
    }
    .dl-horizontal dd:after {
        clear: both;
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
                <ul class="row">
                    <li class="col-lg-12 col-sm-12 col-xs-12">(84457) 9 64 64 &nbsp;
                        <span>Приемная</span>
                    </li>
                    <li class="col-lg-12 col-sm-12 col-xs-12">(84457) 9 39 84 &nbsp;
                        <span>Отдел маркетинга</span>
                    </li>
                    <li class="col-lg-12 col-sm-12 col-xs-12">(84457) 9 64 56 &nbsp;
                        <span>Отдел сбыта</span>
                    </li>
                    <li class="col-lg-12 col-sm-12 col-xs-12">(84457) 9 64 05 &nbsp;
                        <span>Лаборатория</span>
                    </li>
                </ul>
            </div>
            <div class="col-lg-3 col-sm-3 col-xs-12">
                <h4><span class="glyphicon glyphicon-envelope"></span> E-mail</h4>
                <dl class="text-left dl-horizontal">
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
