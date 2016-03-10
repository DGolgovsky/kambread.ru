<?php

namespace app\modules\cabinet;

/**
 * cabinet module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\cabinet\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->setLayoutPath('@frontend/views/layouts');
        // custom initialization code goes here
    }
}
