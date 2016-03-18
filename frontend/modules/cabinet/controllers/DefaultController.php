<?php

namespace app\modules\cabinet\controllers;

use yii\web\Controller;

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
}
