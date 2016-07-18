<?php

namespace app\modules\cabinet\controllers;

use common\controllers\AuthController;
use Yii;
use common\models\Awards;
use common\models\search\AwardsSearch;
use yii\helpers\BaseFileHelper;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use Imagine\Image\Point;
use yii\imagine\Image;
use Imagine\Image\Box;

/**
 * AwardsController implements the CRUD actions for Awards model.
 */
class AwardsController extends Controller
{

    public $layout = "inner";

    /**
     * Lists all Awards models.
     * @return mixed
     */

    public function actionIndex()
    {
        $searchModel = new AwardsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Awards model.
     * @param integer $id
     * @return mixed
     */

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionFileUploadGeneral()
    {
        if(Yii::$app->request->isPost) {
            $id = Yii::$app->request->post("awards_id");
            $path = Yii::getAlias("@frontend/web/uploads/awards/".$id."/general");
            BaseFileHelper::createDirectory($path);
            $model = Awards::findOne($id);
            $model->scenario = 'addimg';

            $file = UploadedFile::getInstance($model,'general_image');
            $name = 'general.'.$file->extension;
            $file->saveAs($path .DIRECTORY_SEPARATOR .$name);

            $image  = $path .DIRECTORY_SEPARATOR .$name;
            $new_name = $path .DIRECTORY_SEPARATOR."small_".$name;

            $model->general_image = $name;
            $model->save();

            $size = getimagesize($image);
            $width = $size[0];
            $height = $size[1];

            Image::frame($image, 0, '666', 0)
                ->crop(new Point(0, 0), new Box($width, $height))
                ->resize(new Box(1000,644))
                ->save($new_name, ['quality' => 100]);

            return true;
        }
    }

    public function actionFileUploadImages()
    {
        if(Yii::$app->request->isPost){
            $id = Yii::$app->request->post("awards_id");
            $path = Yii::getAlias("@frontend/web/uploads/awards/".$id);
            BaseFileHelper::createDirectory($path);
            $file = UploadedFile::getInstanceByName('images');
            $name = time().'.'.$file->extension;
            $file->saveAs($path .DIRECTORY_SEPARATOR .$name);

            $image = $path .DIRECTORY_SEPARATOR .$name;
            $new_name = $path .DIRECTORY_SEPARATOR."small_".$name;

            $size = getimagesize($image);
            $width = $size[0];
            $height = $size[1];

            Image::frame($image, 0, '666', 0)
                ->crop(new Point(0, 0), new Box($width, $height))
                ->resize(new Box(1000,644))
                ->save($new_name, ['quality' => 100]);

            sleep(1);
            return true;
        }
    }

    /**
     * Creates a new Awards model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Awards();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['addimg']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Awards model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idawards]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionAddimg($id)
    {
        //TODO Fix file cache locator service
        //$id = Yii::$app->locator->cache->get('id');
        $model = Awards::findOne($id);
        $image = [];
        if($general_image = $model->general_image){
            $image[] =  '<img src="/uploads/awards/' . $model->idawards . '/general/small_' . $general_image . '" width=250>';
        }

        if(Yii::$app->request->isPost){
            $this->redirect(Url::to(['awards/']));
        }

        $path = Yii::getAlias("@frontend/web/uploads/awards/".$model->idawards);
        $images_add = [];

        try {
            if(is_dir($path)) {
                $files = \yii\helpers\FileHelper::findFiles($path);

                foreach ($files as $file) {
                    if (strstr($file, "small_") && !strstr($file, "general")) {
                        $images_add[] = '<img src="/uploads/awards/' . $model->idawards . '/' . basename($file) . '" width=250>';
                    }
                }
            }
        }
        catch(\yii\base\Exception $e){}


        return $this->render("addimg",['model' => $model,'image' => $image, 'images_add' => $images_add]);
    }

    /**
     * Deletes an existing Awards model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Awards model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Awards the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */

    protected function findModel($id)
    {
        if (($model = Awards::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}