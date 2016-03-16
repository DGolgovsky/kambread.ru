<?php
namespace frontend\models;

use common\models\User;
use yii\base\Model;
use Yii;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $name;
    public $username;
    public $email;
    public $password;
    public $repassword;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['name', 'string', 'min' => 2, 'max' => 255],
            ['username', 'filter', 'filter' => 'trim'],
            [['username', 'password'], 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Такой пользователь уже зарегистрирован.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Такой email уже зарегистрирован.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
            ['repassword', 'compare', 'compareAttribute' => 'password'],
            /*['type', 'frontend\validators\TypeproductValidator'],*/
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['short_u_e'] = ['username', 'email'];
        $scenarios['short_u_e_p'] = ['username', 'email', 'password'];
        $scenarios['short_e_p'] = ['email', 'password'];
        return $scenarios;
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if ($this->validate()) {
            $user = new User();
            $user->name = $this->name;
            $user->username = $this->username;
            $user->email = $this->email;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            if ($user->save()) {
                return $user;
            }
        }

        return null;
    }
}
