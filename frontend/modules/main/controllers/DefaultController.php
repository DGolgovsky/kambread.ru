<?php

namespace app\modules\main\controllers;

use frontend\components\Common;
use yii\web\Controller;
use yii\db\Query;

class DefaultController extends Controller
{
	public function actionIndex()
	{
		$this->layout = "bootstrap";

		$query = new Query();
		$query_product = $query->from('product')->groupBy('idproduct')->orderBy('idproduct desc');
		$command = $query_product->limit(5);
		$result_general = $command->all();
		$count_general = $command->count();

		$featured = $query_product->limit(15)->all();
		$recommend_query  = $query_product->where("recommend= 1")->limit(5);
		$recommend = $recommend_query->all();
		$recommend_count = $recommend_query->count();

		return $this->render('index',[
			'result_general' => $result_general,
			'count_general' => $count_general,
			'featured' => $featured,
			'recommend' => $recommend,
			'recommend_count' => $recommend_count
		]);
	}
	
	public function actionService()
	{
		$locator = \Yii::$app->locator;
		$cache = $locator->cache;
		$cache->set("test",1);
		
		print $cache->get("test");
	}
	
	public function actionEvent()
	{
		$component = \Yii::$app->common; //new Common();
		$component->on(Common::EVENT_NOTIFY,[$component,'notifyAdmin']);
		$component->sendMail("Notify admin",$component->name,$component->subject,$component->body);
		$component->off(Common::EVENT_NOTIFY,[$component,'notifyAdmin']);
	}
	
	public function actionPath()
	{
		// @yii
        // @app
        //@runtime
        //@webroot
        //@web
        //@vendor
        //@bower
        //@npm
        // @frontend
        // @backend

        //print \Yii::getAlias('@test');

    }

    public function actionCacheTest()
	{
		$locator = \Yii::$app->locator;
		$locator->cache->set('test',1);
		print $locator->cache->get('test');
	}

	public function actionLoginData()
	{
		print \Yii::$app->user->identity->username;
	}
}
