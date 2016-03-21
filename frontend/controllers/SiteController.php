<?php
namespace frontend\controllers;

use Yii;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\base\InvalidParamException;
use yii\widgets\ActiveForm;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\components\Common;
use yii\db\Query;
use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\Map;
use dosamigos\google\maps\overlays\Marker;
/**
 * Site controller
 */
class SiteController extends Controller
{
    public $layout = "inner";

    public function init()
    {
        Yii::$app->view->registerJsFile('https://maps.googleapis.com/maps/api/js?sensor=false',['position' => \yii\web\View::POS_HEAD]);
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
        $this->layout = "bootstrap";

        $query = new Query();
        $query_product = $query->from('product')->groupBy('idproduct')->orderBy('idproduct desc');
        $command = $query_product->limit(5);
        $result_general = $command->all();
        $count_general = $command->count();

        $featured = $query_product
            ->Where("new=1")
            ->orWhere("recommend=1")
            ->limit(15)->all();

        $recommend_query  = $query_product->where("recommend=1")->limit(5);
        $recommend = $recommend_query->all();
        $recommend_count = $recommend_query->count();

        return $this->render('index',[
            'result_general' => $result_general,
            'count_general' => $count_general,
            'featured' => $featured,
            'recommend' => $recommend,
            'recommend_count' => $recommend_count
        ]);
        //return $this->redirect('/main');
    }

    public function actionPartners()
    {
        return $this->render('partners');
    }

	public function actionVacancies()
    {
        return $this->render('vacancies');
    }

	public function actionDisclosure()
	{
		return $this->redirect('http://disclosure.1prime.ru/portal/default.aspx?emId=3436107766');
	}

    public function actionEvent()
    {
        $component = \Yii::$app->common; //new Common();
        $component->on(Common::EVENT_NOTIFY,[$component,'notifyAdmin']);
        $component->sendMail("Notify admin",$component->name,$component->subject,$component->body);
        $component->off(Common::EVENT_NOTIFY,[$component,'notifyAdmin']);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
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
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
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
        $model = new ContactForm();
        $coords = '50.10725112018604, 45.40386139521479';

        $coord = new LatLng(['lat' => $coords[0], 'lng' => $coords[1]]);
        $map = new Map([
            'center' => $coord,
            'zoom' => 16,
        ]);

        $marker = new Marker([
            'position' => $coord,
            'title' => 'ОАО Камышинский хлебокомбинат',
        ]);

        $map->addOverlay($marker);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {
            return $this->render('about', [
                'model' => $model,
                'map' => $map,
            ]);
        }
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

        if($model->load(\Yii::$app->request->post())) {
            Yii::$app->session->setFlash('success', 'Регистрация прошла успешно');
            return $this->refresh();
        }

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
                \Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->refresh();
            } else {
                \Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
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
            Yii::$app->session->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
}
