<?
namespace frontend\components;

use yii\base\Component;

class Common extends Component{

    const EVENT_NOTIFY = 'notify_admin';

    public function sendMail($email,$subject,$body,$name=''){
        /*\Yii::$app->mail->compose()
            ->setFrom([ \Yii::$app->params['supportEmail'] => \Yii::$app->name])
            ->setTo([$email => $name])
            ->setSubject($subject)
            ->setTextBody($body)
            ->send();*/

        $this->trigger(self::EVENT_NOTIFY);
    }

    public function notifyAdmin($event){
        print "Notify Admin";
    }
}