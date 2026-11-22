<?php

namespace backend\controllers;

use common\controllers\AuthController;
use common\models\User;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

class UserController extends AuthController
{
    public function actionIndex()
    {
        \Yii::$app->view->title = "User Manager";
        $dataProvider = new ActiveDataProvider([
            'query' => User::find()
        ]);

        return $this->render("index", ['dataProvider' => $dataProvider]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}