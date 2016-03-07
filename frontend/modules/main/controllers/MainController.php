<?php
namespace app\modules\main\controllers;

use frontend\models\ContactForm;
use frontend\models\Image;
use frontend\models\SignupForm;
use yii\web\Response;
use yii\widgets\ActiveForm;

class MainController extends \yii\web\Controller
{
	public $layout = 'inner';

	public function actions()
	{
		return [
			'captcha' => [
				'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
            'test' => [
                'class' => 'frontend\actions\TestAction',
            ],
        ];
    }

	public function actionIndex()
    {    	
    	return $this->render('index');
    }

    public function actionRegister()
    {
    	$model = new SignupForm;
		// 1st: $model = new SignupForm(['scenario' => 'short_u_e_p']);
		// 2nd: $model->scenario = 'short_u_e_p'; // валидация по сценарию

    	if(\Yii::$app->request->isAjax && \Yii::$app->request->isPost) {
    		\Yii::$app->response->format = Response::FORMAT_JSON;
    		return ActiveForm::validate($model);
    	}

    	if($model->load(\Yii::$app->request->post()) && $model->signup()) {
    		print_r($model->getAttributes());
    		die;
    	}

    	return $this->render('register', ['model' => $model]);
    }

    public function actionContact()
    {
    	$model = new ContactForm();
    	if($model->load(\Yii::$app->request->post()) && $model->validate()) {
			$body = " <div>Сообщение от: <b> ".$model->name." </b></div>";
			$body .= " <div>Email: <b> ".$model->email." </b></div>";
			$body .= " <div>Текст: <b> ".$model->body." </b></div>";


            \Yii::$app->common->sendMail(
				$model->name,
				$model->email,
				$model->subject,
				$body
			);

            print "Send success";
            die;
        }

        return $this->render("contact", ['model' => $model]);
    }
}
