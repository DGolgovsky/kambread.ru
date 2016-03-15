<?php

namespace frontend\filters;

use common\models\Advert;
use yii\base\ActionFilter;
use yii\web\HttpException;

class FilterAdvert extends ActionFilter
{
    public function beforeAction($action)
    {
        $id = \Yii::$app->request->get("id");
        $model = Advert::findOne($id);

        if($model == null) {
            throw new  HttpException(404,'Unknown advert');
            return false;
        }

        return parent::beforeAction($action);
    }

    public function afterAction($action,$result)
    {
        return parent::afterAction($action,$result);
    }
}
