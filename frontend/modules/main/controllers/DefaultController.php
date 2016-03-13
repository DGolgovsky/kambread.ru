<?php

namespace app\modules\main\controllers;

use frontend\components\Common;
use yii\web\Controller;

class DefaultController extends Controller
{
  public function actionIndex() {
    $this->layout = "bootstrap";
    return $this->render('index');
  }

  public function actionService() {
    $locator = \Yii::$app->locator;
    $cache = $locator->cache;

    $cache->set("test", 1);
    print $cache->get("test");
  }

  public function actionEvent() {
    $component = \Yii::$app->common; //new Common();
    $component->on(Common::EVENT_NOTIFY,[$component,'notifyAdmin']);
    $component->sendMail("tech@kambread.ru","Уведомление","Текст уведомления");
    $component->off(Common::EVENT_NOTIFY,[$component,'notifyAdmin']);
  }

  public function actionPath() {
    // @yii - framework path
    // @app - back/front
    // @runtime - back/front runtime
    // @webroot - front/back/web
    // @web - url to web folder
    // @vendor
    // @bower
    // @npm
    // @frontend
    // @backend

    // print \Yii::getAlias('@debugPath');
  }
  public function actionLoginData() {
    print \Yii::$app->user->id;
    print \Yii::$app->user->identity->username;
  }
}
