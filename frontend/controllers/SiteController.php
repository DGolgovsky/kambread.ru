<?php
namespace frontend\controllers;

use common\models\LoginForm;
use frontend\components\Common;
use frontend\models\ContactForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use yii;
use yii\base\InvalidParamException;
use yii\db\Query;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\Response;
use yii\widgets\ActiveForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    public $layout = "inner";

    public function init()
    {
        //Yii::$app->view->registerJsFile('https://maps.googleapis.com/maps/api/js?sensor=false',['position' => \yii\web\View::POS_HEAD]);
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout = "landing";

        $query = new Query();
        $query_product = $query->from('product')->groupBy('idproduct')->orderBy('idproduct desc')->where('status=true');
        $command = $query_product->limit(5);
        $result_general = $command->all();
        $count_general = $command->count();

        $featured = $query_product
            ->where("new=true")
            ->orWhere("recommend=true")
            ->andWhere('status=true')
            ->limit(15)->all();

        /*$recommend_query  = $query_product->where("recommend=true")->limit(5);
        $recommend = $recommend_query->all();
        $recommend_count = $recommend_query->count();*/
        
        return $this->render('index',[
            'result_general' => $result_general,
            'count_general' => $count_general,
            'featured' => $featured/*,
            'recommend' => $recommend,
            'recommend_count' => $recommend_count*/
        ]);
        //return $this->redirect('/main');
    }

    public function actionPartners()
    {
        return $this->render('partners');
    }
    
    public function actionDisclosure()
	{
		return $this->redirect('http://disclosure.1prime.ru/portal/default.aspx?emId=3436107766');
	}

    public function actionMail()
    {
        return $this->redirect('http://mail.kambread.ru');
    }

    public function actionEvent()
    {
        $component = Yii::$app->common; //new Common();
        $component->on(Common::EVENT_NOTIFY,[$component,'notifyAdmin']);
        $component->sendMail("[Notify admin]",$component->name,$component->email, Yii::$app->params['adminEmail'],$component->subject,$component->body);
        $component->off(Common::EVENT_NOTIFY,[$component,'notifyAdmin']);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect('/cabinet');//goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();

        if(Yii::$app->request->isAjax && \Yii::$app->request->isPost) {
            if($model->load(\Yii::$app->request->post())) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }
        }

        if ($model->load(Yii::$app->request->post())) {
            if (Yii::$app->common->sendMail('[Отзыв]', $model->name, $model->email, Yii::$app->params['marketEmail'], $model->subject, $model->body)) {
                Yii::$app->session->setFlash('success', 'Сообщение успешно отправлено');
            } else {
                Yii::$app->session->setFlash('error', 'Не удалось отправить. Попробуйте позже');
            }
            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        // 1st: $model = new SignupForm(['scenario' => 'short_u_e_p']); // валидация по сценарию

        if(Yii::$app->request->isAjax && \Yii::$app->request->isPost) {
            if($model->load(\Yii::$app->request->post())) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }
        }

        if($model->load(\Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', 'Регистрация прошла успешно');
            return $this->refresh();
        }

        //TODO add send email request
        
        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                \Yii::$app->session->setFlash('success', 'Проверьте свой email для получения дальнейших инструкций');

                return $this->refresh();
            } else {
                \Yii::$app->session->setFlash('error', 'Что-то пошло не так...');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'Новый пароль сохранён.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
}
