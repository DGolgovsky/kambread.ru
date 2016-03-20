<?php

namespace common\models;

use frontend\components\Common;
use Yii;

/**
 * This is the model class for table "subscribe".
 *
 * @property integer $idsubscribe
 * @property string $email
 * @property string $date_subscribe
 */
class Subscribe extends \yii\db\ActiveRecord
{
    const EVENT_NOTIFICATION_ADMIN = 'new-notification-admin';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'subscribe';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date_subscribe'], 'safe'],
            [['email'], 'string', 'max' => 50],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique'],
        ];
    }

    public function init()
    {
        $this->on(self::EVENT_NOTIFICATION_ADMIN, [$this, 'notification']);
    }

    public function notification($event)
    {
        $model = User::find()->where(['roles' => 'admin'])->all();

        foreach($model as $r)
        {
            Common::sendMail('[New subscribe]',$r['name'], $r['email'],'New subscriber', '');
        }

        Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
        return $this->refresh();
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idsubscribe' => 'ID',
            'email' => 'Email',
            'date_subscribe' => 'Дата подписки',
        ];
    }

    /**
     * @inheritdoc
     * @return SubscribeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SubscribeQuery(get_called_class());
    }
}
