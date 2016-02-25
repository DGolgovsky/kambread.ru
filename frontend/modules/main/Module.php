<?php

namespace app\modules\main;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'app\modules\main\controllers';

    public function init()
    {
        parent::init();

        $this->setLayoutPath('@frontend/views/layouts');

        // custom initialization code goes here
    }
}
