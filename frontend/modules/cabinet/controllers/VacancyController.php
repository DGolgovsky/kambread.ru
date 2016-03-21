<?php

namespace app\modules\cabinet\controllers;

class VacancyController extends \yii\web\Controller
{
    public $layout = "inner";
    
    public function actionIndex()
    {
        return $this->render('index');
    }

}
