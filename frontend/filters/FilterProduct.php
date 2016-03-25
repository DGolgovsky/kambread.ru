<?php

namespace frontend\filters;

use common\models\Product;
use yii\base\ActionFilter;
use yii\web\HttpException;

class FilterProduct extends ActionFilter
{
    public function beforeAction($action)
    {
        $id = \Yii::$app->request->get("id");
        $model = Product::findOne($id);

        if($model == null) {
            throw new  HttpException(404,'Unknown product');
            return false;
        }

        return parent::beforeAction($action);
    }

    public function afterAction($action,$result)
    {
        return parent::afterAction($action,$result);
    }
}
