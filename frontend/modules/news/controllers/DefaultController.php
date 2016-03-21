<?php

namespace app\modules\news\controllers;

use common\models\News;
use yii\data\Pagination;
use yii\web\Controller;

/**
 * Default controller for the `news` module
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
        $this->layout = 'inner';

        $query = News::find();
        $query->filterWhere(['like', 'name', ''])
            ->orFilterWhere(['like', 'description', '']);

        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count()]);
        $pages->setPageSize(6);

        $model = $query->offset($pages->offset)->limit($pages->limit)->all();

        $request = \Yii::$app->request;
        return $this->render("index", ['model' => $model, 'pages' => $pages, 'request' => $request]);
    }

    public function actionViewNews($id)
    {
        $model = News::findOne($id);

        $images = \frontend\components\Common::getImageNews($model, false);

        return $this->render('view_news',[
            'model' => $model,
            'images' =>$images,
        ]);
    }
}
