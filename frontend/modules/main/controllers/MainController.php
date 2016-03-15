<?php
namespace app\modules\main\controllers;

use common\models\Advert;
use common\models\LoginForm;
use frontend\filters\FilterAdvert;
use frontend\models\ContactForm;
use frontend\models\Image;
use frontend\models\SignupForm;
use Yii;
use yii\base\DynamicModel;
use yii\web\Response;
use yii\widgets\ActiveForm;

class MainController extends \yii\web\Controller
{
	public $layout = "inner";

	public function actions()
	{
		return [
			'captcha' => [
				'class' => 'yii\captcha\CaptchaAction',
				'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
			],
			'test' => [
				'class' => 'frontend\actions\TestAction',
			]
		];
	}

	public function behaviors()
	{
		return [
			[
				'only' => ['view-advert'],
				'class' => FilterAdvert::className(),
			]
		];
	}

	public function actionIndex()
	{
		return $this->render('index');
	}

	public function actionRegister()
	{

		$model = new SignupForm();
		// 1st: $model = new SignupForm(['scenario' => 'short_u_e_p']);
		// 2nd: $model->scenario = 'short_u_e_p'; // валидация по сценарию

		if(Yii::$app->request->isAjax && Yii::$app->request->isPost){
			if($model->load(Yii::$app->request->post())) {
				Yii::$app->response->format = Response::FORMAT_JSON;
				return ActiveForm::validate($model);
			}
		}

		if($model->load(Yii::$app->request->post()) && $model->signup()){

			Yii::$app->session->setFlash('success', 'Register Success');
		}

		return $this->render("register",['model' => $model]);
	}

	public function actionLogin()
	{
		$model = new LoginForm;

		if($model->load(Yii::$app->request->post()) && $model->login()) {
			$this->goBack();
		}

		return $this->render("login", ['model' => $model]);
	}

	public function actionLogout()
	{
		Yii::$app->user->logout();
		return $this->goHome();
	}

	public function actionContact()
	{
		$model = new ContactForm();
		if($model->load(Yii::$app->request->post()) && $model->validate()) {
			$body = " <div>Сообщение от: <b> ".$model->name." </b></div>";
			$body .= " <div>Email: <b> ".$model->email." </b></div>";
			$body .= " <div>Текст: <b> ".$model->body." </b></div>";
			Yii::$app->common->sendMail(
				'Feedback',
				$model->name,
				$model->email,
				$model->subject,
				$body
			);
			Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
			die;
		}
		return $this->render("contact", ['model' => $model]);
	}

	public function actionViewAdvert($id)
	{
		$model = Advert::findOne($id);

		$data = ['name', 'email', 'text'];
		$model_feedback = new DynamicModel($data);
		$model_feedback->addRule('name','required');
		$model_feedback->addRule('email','required');
		$model_feedback->addRule('text','required');
		$model_feedback->addRule('email','email');

		if(Yii::$app->request->isPost) {
			if ($model_feedback->load(Yii::$app->request->post()) && $model_feedback->validate()) {
				Yii::$app->common->sendMail($model_feedback->name, $model_feedback->email, "По ".$model->idadvert,$model_feedback->text);
			}
		}

		$user = $model->user;
		$images = \frontend\components\Common::getImageAdvert($model,false);

		$current_user = ['email' => '', 'username' => ''];

		if(!Yii::$app->user->isGuest) {
			$current_user['email'] = Yii::$app->user->identity->email;
			$current_user['username'] = Yii::$app->user->identity->username;
		}

		return $this->render('view_advert',[
			'model' => $model,
			'model_feedback' => $model_feedback,
			'user' => $user,
			'images' =>$images,
			'current_user' => $current_user
		]);
	}
}