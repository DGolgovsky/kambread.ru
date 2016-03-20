<?php

namespace frontend\themes\product;
use Yii;

class Theme extends \yii\base\Theme
{
    public $pathMap = [
        '@frontend/views'   => '@frontend/themes/product/views',
        '@frontend/modules' => '@frontend/themes/product/modules'
    ];

    public function init()
    {
        parent::init();
    }
}
