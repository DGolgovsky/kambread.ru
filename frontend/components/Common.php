<?php
namespace frontend\components;

use yii\base\Component;

class Common extends Component
{
    const EVENT_NOTIFY = 'notify_admin';

    public function sendMail($name, $email, $subject, $body) {
        if(\Yii::$app->mail->compose()
            ->setFrom(['web.notify@kambread.ru' => $email])
            ->setTo([\Yii::$app->params['supportEmail'] => $name])
            ->setSubject($subject)
            ->setTextBody($body)
            ->send()) {
            $this->trigger(self::EVENT_NOTIFY);
            return true;
        }
    }

    public function notifyAdmin($event) {
        print "Notify Admin";
    }
}
