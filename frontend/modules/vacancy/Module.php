<?php

namespace app\modules\vacancy;

/**
 * vacancy module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\vacancy\controllers';

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
