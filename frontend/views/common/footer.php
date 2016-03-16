<?php
if(Yii::$app->user->isGuest) {
    echo \frontend\widgets\Login::widget();
}
?>
<div class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-sm-3">
                <h4><span class="glyphicon glyphicon-info-sign"></span> Информация</h4>
                <ul class="row">
                    <li class="col-lg-12 col-sm-12 col-xs-2"><a href="about.html" >О компании</a></li>
                    <li class="col-lg-12 col-sm-12 col-xs-2"><a href="agents.html" >Сотрудники</a></li>
                    <li class="col-lg-12 col-sm-12 col-xs-2"><a href="/main/main/find" >Продукция</a></li>
                    <li class="col-lg-12 col-sm-12 col-xs-2"><a href="/main/main/contact" >Отзыв</a></li>
                </ul>
            </div>

            <div class="col-lg-3 col-sm-3">
                <h4><span class="glyphicon glyphicon-user"></span> Социальные сети</h4>
                <a href="http://facebook.com/kambread"><img src="/images/facebook.png"  alt="Facebook"></a>
                <a href="http://ok.ru/group/52685470564514"><img src="/images/ok.png"  alt="Одноклассники"></a>
                <a href="#"><img src="/images/linkedin.png"  alt="linkedin"></a>
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
        </div>
    </div>
</div>
