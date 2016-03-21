<?php

namespace app\modules\cabinet\controllers;

use common\models\User;
use frontend\models\ChangePasswordForm;
use yii\web\Controller;
use Yii;
use yii\web\UploadedFile;
use Imagine\Image\Box;
use Imagine\Image\Point;
use yii\imagine\Image;

/**
 * Default controller for the `cabinet` module
 */
class DefaultController extends Controller
{
    public $layout = "inner";
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        // return $this->redirect('/cabinet/product');
        return $this->render('index');
    }

    public function uploadAvatar()
    {
        if(Yii::$app->request->isPost) {
            $id = Yii::$app->user->id;
            $path = Yii::getAlias("@frontend/web/uploads/users");
            $file = UploadedFile::getInstanceByName('avatar');
            if($file) {
                $name = $id . '.jpg';
                $file->saveAs($path . DIRECTORY_SEPARATOR . $name);

                $image = $path . DIRECTORY_SEPARATOR . $name;
                $new_name = $path . DIRECTORY_SEPARATOR . "small_" . $name;

                Image::frame($image, 0, '666', 0)
                    ->thumbnail(new Box(200, 200))
                    ->save($new_name, ['quality' => 100]);

                return true;
            }
        }
    }

    public function actionNews()
    {
        return $this->render('news');
    }

    public function actionChangePassword()
    {
        $model = new ChangePasswordForm();

        if($model->load(\Yii::$app->request->post()) && $model->changePassword()) {
            return $this->refresh();
        }

        return $this->render('change-password',['model' => $model]);
    }

    public function actionSettings()
    {
        $model = User::findOne(\Yii::$app->user->id);
        $model->scenario = 'setting';

        if($model->load(\Yii::$app->request->post()) && $model->save()) {
            $this->uploadAvatar();
            Yii::$app->session->setFlash('success', 'Ваш профиль обновлён');
            return $this->refresh();
        }

        return $this->render('setting',['model' => $model]);
    }
}
