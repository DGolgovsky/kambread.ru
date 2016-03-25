<?php

namespace app\modules\vacancy\controllers;

use app\models\Vacancy;
use yii\data\Pagination;
use yii\web\Controller;

/**
 * Default controller for the `vacancy` module
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
        $query = Vacancy::find()->groupBy('idvacancy')->orderBy('updated_at desc')->where('open=true');
        //$query->filterWhere(['like', 'name', ''])->orFilterWhere(['like', 'description', '']);

        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count()]);
        $pages->setPageSize(10);

        $model = $query->offset($pages->offset)->limit($pages->limit)->all();

        $request = \Yii::$app->request;
        return $this->render("index", ['model' => $model, 'pages' => $pages, 'request' => $request]);
    }
}
