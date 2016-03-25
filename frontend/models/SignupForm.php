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
    public $phone;
    public $group;
    public $password;
    public $repassword;

    public function attributeLabels()
    {
        return [
            'name' => 'Имя',
            'username' => 'Логин',
            'email' => 'Электронная почта',
            'phone' => 'Номер телефона',
            'group' => 'Группа',
            'password' => 'Пароль',
            'repassword' => 'Подтвердить пароль',
        ];
    }
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

            ['phone', 'filter', 'filter' => 'trim'],
            ['phone', 'string', 'min' => 2, 'max' => 16],

            ['group', 'required'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            ['repassword', 'compare', 'compareAttribute' => 'password'],
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
            $user->phone = $this->phone;
            $user->group = $this->group;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            if ($user->save()) {
                return $user;
            }
        }

        return null;
    }
}
