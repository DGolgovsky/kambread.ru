<?php
if(Yii::$app->user->isGuest) {
    echo \frontend\widgets\Login::widget();
}
?>
<style>
    .foot dt {
        width: 100px;
        text-align: left;
        font-weight: normal;
    }
    .foot dd {
        margin-left: 0px;
    }
    .phones dt {
        width: 130px;
    }
</style>
<hr>
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-sm-3 col-xs-12">
                <h4><span class="glyphicon glyphicon-user"></span> Социальные сети</h4>
                <a href="http://facebook.com/kambread"><img src="/images/facebook.png" alt='Facebook'></a>
                <a href="http://ok.ru/group/52685470564514"><img src="/images/ok.png" alt='Одноклассники'></a>
                <a href="http://vk.com/kam.hleb"><img src="/images/vk.png" alt='ВКонтакте'></a>
            </div>
            <div class="col-lg-3 col-sm-3 col-xs-12">
                <h4><span class="glyphicon glyphicon-map-marker"></span> Адрес</h4>
                <p>403874, Россия, Волгоградская область,<br>г. Камышин, ул. Ленина, 4</p>
            </div>
            <div class="col-lg-3 col-sm-3 col-xs-12">
                <h4><span class="glyphicon glyphicon-earphone"></span> Телефоны</h4>
                <dl class="text-left dl-horizontal foot phones">
                    <dt>Приемная</dt>
                    <dd style="text-align: right">(84457) 9 64 64</dd>
                    <dt>Отдел маркетинга<dt>
                    <dd style="text-align: right">(84457) 9 39 84</dd>
                    <dt>Отдел сбыта</dt>
                    <dd style="text-align: right">(84457) 9 64 56</dd>
                    <dt>Лаборатория</dt>
                    <dd style="text-align: right">(84457) 9 64 05</dd>
                </dl>
            </div>
            <div class="col-lg-3 col-sm-3 col-xs-12">
                <h4><span class="glyphicon glyphicon-envelope"></span> E-mail</h4>
                <dl class="text-left dl-horizontal foot">
                    <dt>Отдел продаж</dt>
                    <dd style="text-align: right"><a href="mailto:marketing@kambread.ru" target="_self">marketing@kambread.ru</a></dd>
                    <dt>Отдел сбыта<dt>
                    <dd style="text-align: right"><a href="mailto:expedition@kambread.ru" target="_self">expedition@kambread.ru</a></dd>
                    <dt>Web-master</dt>
                    <dd style="text-align: right"><a href="mailto:support@kambread.ru" target="_self">support@kambread.ru</a></dd>
                </dl>
            </div>
        </div>
        <p style="text-align: center">Полный ассортимент продукции и цены Вы можете уточнить у менеджеров <a href="/contact">отдела маркетинга</a></p>
    </div>

