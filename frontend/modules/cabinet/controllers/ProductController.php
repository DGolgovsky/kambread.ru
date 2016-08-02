<?php

namespace app\modules\cabinet\controllers;

use Yii;
use common\models\Product;
use common\models\search\ProductSearch;
use yii\helpers\BaseFileHelper;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use Imagine\Image\Point;
use yii\imagine\Image;
use Imagine\Image\Box;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
{
	public $layout = "inner";
	
	/**
	 * Lists all Product models.
	 * @return mixed
	 */

	public function actionIndex()
	{
		$searchModel = new ProductSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->sort = [
            'defaultOrder' => [
                'updated_at' => SORT_DESC,
            ]];

        return $this->render('index', [
			'searchModel' => $searchModel,
			'dataProvider' => $dataProvider,
		]);
	}

	/**
	 * Displays a single Product model.
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
			$id = Yii::$app->request->post("product_id");
			$path = Yii::getAlias("@frontend/web/uploads/products/".$id."/general");
			BaseFileHelper::createDirectory($path);
			$model = Product::findOne($id);
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
				->resize(new Box(1280,824))
				->save($new_name, ['quality' => 85]);

			return true;
		}
	}

	/**
	 * Creates a new product model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate()
	{
		$model = new Product();

		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			return $this->redirect(['addimg', 'id' => $model->idproduct]);
		} else {
			return $this->render('create', [
				'model' => $model,
			]);
		}
	}

	/**
	 * Updates an existing product model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id
	 * @return mixed
	 */

	public function actionUpdate($id)
	{
		$model = $this->findModel($id);

		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			return $this->redirect(['view', 'id' => $model->idproduct]);
		} else {
			return $this->render('update', [
				'model' => $model,
			]);
		}
	}

	public function actionAddimg($id)
	{
		//$id = Yii::$app->locator->cache->get('id');
		$model = Product::findOne($id);
		$image = [];
		if($general_image = $model->general_image){
			$image[] =  '<img src="/uploads/products/' . $model->idproduct . '/general/small_' . $general_image . '" width=250>';
		}

		if(Yii::$app->request->isPost){
			$this->redirect(Url::to(['product/']));
		}

		$path = Yii::getAlias("@frontend/web/uploads/products/".$model->idproduct);
		$images_add = [];

		try {
			if(is_dir($path)) {
				$files = \yii\helpers\FileHelper::findFiles($path);

				foreach ($files as $file) {
					if (strstr($file, "small_") && !strstr($file, "general")) {
						$images_add[] = '<img src="/uploads/products/' . $model->idproduct . '/' . basename($file) . '" width=250>';
					}
				}
			}
		}
		catch(\yii\base\Exception $e){}


		return $this->render("addimg",['model' => $model,'image' => $image, 'images_add' => $images_add]);
	}

	/**
	 * Deletes an existing product model.
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
	 * Finds the product model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return product the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */

	protected function findModel($id)
	{
		if (($model = Product::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}
}