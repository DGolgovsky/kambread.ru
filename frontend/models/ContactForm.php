<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model
{
    public $name;
    public $email;
    public $subject;
    public $body;
    public $verifyCode;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['name', 'email', 'subject', 'body'], 'required'],
            // email has to be a valid email address
            ['email', 'email'],
            // verifyCode needs to be entered correctly
            ['verifyCode', 'captcha', 'captchaAction' => \yii\helpers\Url::to(['site/captcha'])],  // site/captcha
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Имя',
            'email' => 'Электронная почта',
            'subject' => 'Тема',
            'body' => 'Содержание',
            'verifyCode' => 'Верификация',
        ];
    }    

    /**
     * Sends an email to the specified email address using the information collected by this model.
     *
     * @param  string  $email the target email address
     * @return boolean whether the email was sent
     */
    public function sendEmail($email)
    {
        $body = " <div>Сообщение от: <b> ".$this->name." </b></div>";
        $body .= " <div>Email: <b> ".$this->email." </b></div>";
        $body .= " <div>Текст: <b> ".$this->body." </b></div>";

        return Yii::$app->common->sendMail('[Отзыв]', $this->name, $email, Yii::$app->params['marketEmail'], $this->subject, $body);
    }
}
