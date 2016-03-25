<?php
namespace app\modules\products\controllers;

use common\models\Product;
use frontend\components\Common;
use frontend\filters\FilterProduct;
//use frontend\models\Image;
//use frontend\models\SignupForm;
use yii\base\DynamicModel;
use yii\data\Pagination;
use yii\web\Controller;
use yii\db\Query;

//use yii\web\Response;
//use yii\widgets\ActiveForm;

class DefaultController extends Controller
{
	public $layout = "inner";

	public function actions()
	{
		return [
			'page' => [
				'class' => 'yii\web\ViewAction',
				'layout' => 'inner',
			]
		];
	}

	public function behaviors()
	{
		return [
			[
				'only' => ['view-product'],
				'class' => FilterProduct::className(),
			]
		];
	}

	public function actionIndex($propert = '', $price = '', $type = '')
	{
		$this->layout = 'inner';

		$query = Product::find();
		$query->filterWhere(['like', 'name', $propert])
			->orFilterWhere(['like', 'description', $propert])
			->andFilterWhere(['type' => $type]);

		if($price) {
			$prices = explode("-",$price);

			if(isset($prices[0]) && isset($prices[1])) {
				$query->andWhere(['between', 'price', $prices[0], $prices[1]]);
			} else {
				$query->andWhere(['>=', 'price', $prices[0]]);
			}
		}

		$countQuery = clone $query;
		$pages = new Pagination(['totalCount' => $countQuery->count()]);
		$pages->setPageSize(6);

		$model = $query->offset($pages->offset)->limit($pages->limit)->all();

		$request = \Yii::$app->request;
		return $this->render("index", ['model' => $model, 'pages' => $pages, 'request' => $request]);
	}

	//TODO add replacer '\n' -> <br>
	public function actionViewProduct($id)
	{
		$model = Product::findOne($id);

		$data = ['name', 'email', 'text'];
		$model_feedback = new DynamicModel($data);
		$model_feedback->addRule('name','required');
		$model_feedback->addRule('email','required');
		$model_feedback->addRule('text','required');
		$model_feedback->addRule('email','email');

		if(\Yii::$app->request->isPost) {
			if ($model_feedback->load(\Yii::$app->request->post()) && $model_feedback->validate()) {
				\Yii::$app->common->sendMail('[Продукция]',$model_feedback->name, $model_feedback->email, "По ".$model->name,$model_feedback->text);
				\Yii::$app->session->setFlash('success', 'Сообщение успешно отправлено');
				return $this->refresh();
			}
		}

		$user = $model->user;
		$images = \frontend\components\Common::getImageProduct($model,false);

		$current_user = ['email' => '', 'name' => ''];

		if(!\Yii::$app->user->isGuest) {
			$current_user['email'] = \Yii::$app->user->identity->email;
			$current_user['name'] = \Yii::$app->user->identity->name;
		}

		return $this->render('view_product',[
			'model' => $model,
			'model_feedback' => $model_feedback,
			'user' => $user,
			'images' =>$images,
			'current_user' => $current_user,
		]);
	}
}
