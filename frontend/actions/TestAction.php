<?php
namespace frontend\actions;

use yii\base\Action;

class TestAction extends Action
{
    public $viewName = 'index';

    public function run()
    {
        return $this->controller->render("@frontend/actions/views/".$this->viewName);
    }
}
