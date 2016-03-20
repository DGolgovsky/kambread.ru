<?php
if(Yii::$app->user->isGuest) {
    echo \frontend\widgets\Login::widget();
}
?>
<div class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-sm-3">
                <h4><span class="glyphicon glyphicon-user"></span> Социальные сети</h4>
                <a href="http://facebook.com/kambread"><img src="/images/facebook.png"  alt="Facebook"></a>
                <a href="http://ok.ru/group/52685470564514"><img src="/images/ok.png"  alt="Одноклассники"></a>
                <a href="http://vk.com/kam.hleb"><img src="/images/vk.png"  alt="ВКонтакте"></a>
            </div>
            <div class="col-lg-3 col-sm-3">
                <h4><span class="glyphicon glyphicon-map-marker"></span> Адрес</h4>
                <p>
                    403874, Россия, Волгоградская область,<br>г. Камышин, ул. Ленина, 4
            </div>
            <div class="col-lg-3 col-sm-3">
                <h4><span class="glyphicon glyphicon-earphone"></span> Телефоны</h4>
                <p>
                    (84457) 9 64 64 &nbsp; Приемная<br>
                    (84457) 9 39 84 &nbsp; Отдел маркетинга<br>
                    (84457) 9 64 56 &nbsp; Отдел сбыта<br>
                    (84457) 9 64 05 &nbsp; Лаборатория<br>
                </p>
            </div>
            <div class="col-lg-3 col-sm-3">
                <h4><span class="glyphicon glyphicon-envelope"></span> E-mail</h4>
                <ul class="row">
                    <li class="col-lg-12 col-sm-12 col-xs-2">
                            Отдел продаж&nbsp;
                            <span style="text-decoration:underline;">
                                <a href="mailto:market@kambread.ru" target="_self">market@kambread.ru</a>
                            </span>
                    </li>
                    <li class="col-lg-12 col-sm-12 col-xs-2">
                            Общий&nbsp;
                            <span style="text-decoration:underline;">
                                <a href="mailto:kam.khk@mail.ru" target="_self">market@kambread.ru</a>
                            </span>
                    </li>
                    <li class="col-lg-12 col-sm-12 col-xs-2">
                            Web-master&nbsp;
                            <span style="text-decoration:underline;">
                                <a href="mailto:support@kambread.ru" target="_self">market@kambread.ru</a>
                            </span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
