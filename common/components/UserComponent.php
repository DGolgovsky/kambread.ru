<?php

namespace common\components;

use yii\base\Component;

class UserComponent extends Component
{
    public static function getUserImage($id, $original = false)
    {
        $base = \Yii::$app->params['baseUrl'] . '/uploads/users/';
        return $base . (($original) ? $id : 'small_' . $id) . '.jpg';
    }
}
