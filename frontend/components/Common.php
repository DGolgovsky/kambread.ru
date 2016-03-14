<?php
namespace frontend\components;

use yii\base\Component;
use yii\helpers\Url;

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

	public static function getTitleAdvert($data) {
		return $data['bedroom'].' Bed Rooms and '.$data['kitchen'].' Kitchen Room Aparment on Sale';
	}

	public static function getImageAdvert($data,$general = true,$original = false) {
		$image = [];
		$base = Url::base();
		if($original) {
			$image[] = $base.'uploads/adverts/'.$data['idadvert'].'/general/'.$data['general_image'];
		} else {
			$image[] = $base.'uploads/adverts/'.$data['idadvert'].'/general/small_'.$data['general_image'];
		}
		return $image;
	}

	public static function substr($text,$start=0,$end=50) {
		return mb_substr($text,$start,$end);
	}
}
