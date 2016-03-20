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
            ['name', 'filter', 'filter' => 'trim'],
            ['name', 'required'],
            ['name', 'string', 'min' => 2, 'max' => 32],

            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Такой пользователь уже зарегистрирован.'],
            ['username', 'string', 'min' => 2, 'max' => 16],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'min' => 6, 'max' => 32],
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
        $scenarios['short_n_u_e_p'] = ['name', 'username', 'email', 'password'];
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
