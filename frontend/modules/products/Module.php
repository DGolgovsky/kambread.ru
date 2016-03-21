<?php

namespace app\modules\products;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'app\modules\products\controllers';

    public function init()
    {
        parent::init();

        $this->setLayoutPath('@frontend/views/layouts');

        // custom initialization code goes here
    }
}
