<?php
namespace app\modules\products\controllers;

use common\models\Product;
use frontend\filters\FilterProduct;
use yii\base\DynamicModel;
use yii\data\Pagination;
use yii\web\Controller;

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

	public function actionIndex($propert = '', $price = '', $type = '', $new = 0)
	{
		$query = Product::find();
		$query->where('status=true');
		$query->filterWhere(['ilike', 'name', $propert])
			->orFilterWhere(['ilike', 'description', $propert])
			->andFilterWhere(['type' => $type])
            ->andFilterWhere(['new' => $new]);

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
				\Yii::$app->common->sendMail('[Продукция]',$model_feedback->name, $model_feedback->email, \Yii::$app->params['marketEmail'], "По ".$model->name,$model_feedback->text);
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
