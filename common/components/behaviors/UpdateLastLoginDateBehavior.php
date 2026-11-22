<?php
namespace common\components\behaviors;

use yii;
use yii\base\Behavior;

/**
 * Class UpdateLastLoginDateBehavior обновление даты последнего входа
 * @package common\components\behaviors
 *
 * @author Bondarenko Kirill <bondarenko.kirill@gmail.com>
 */
class UpdateLastLoginDateBehavior extends Behavior
{
    public function events()
    {
        return [
            yii\web\User::EVENT_AFTER_LOGIN => 'updateLastLoginDate',
        ];
    }

    public function updateLastLoginDate($event)
    {
        Yii::$app->db->createCommand()->update('user', [
            'last_login_date' => new yii\db\Expression('NOW()'),
        ], ['id' => $this->owner->identity->id])->execute();

        return true;
    }
}