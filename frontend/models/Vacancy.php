<?php

namespace app\models;

use common\models\User;
use frontend\components\Common;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "vacancy".
 *
 * @property integer $idvacancy
 * @property integer $group_id
 * @property string $description
 * @property integer $created_at
 * @property string $name
 * @property integer $updated_at
 * @property boolean $open
 */
class Vacancy extends \yii\db\ActiveRecord
{
    public static $dates = ['updated_at', 'created_at'];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vacancy';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className()
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['open', 'name', 'description'], 'required'],
            [['group_id', 'created_at', 'updated_at'], 'integer'],
            [['description'], 'string'],
            [['open'], 'boolean'],
            [['name'], 'string', 'max' => 255],
            ['name', 'filter', 'filter' => 'trim'],
            //['description', 'filter', 'filter' => 'trim'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idvacancy' => 'ID позиции',
            'group_id' => 'ID группы',
            'description' => 'Описание',
            'created_at' => 'Создано',
            'name' => 'Наименование',
            'updated_at' => 'Обновлено',
            'user.name' => 'Добавлено',
            'open' => 'Открыта',
        ];
    }

    public function getTitle()
    {
        return Common::getTitle($this);
    }

    /**
     * @inheritdoc
     * @return VacancyQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new VacancyQuery(get_called_class());
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'group_id']);
    }

    public function afterValidate()
    {
        $this->group_id = Yii::$app->user->identity->getId();
    }

    public function afterSave($insert, $changedAttributes)
    {
        Yii::$app->locator->cache->set('id', $this->idvacancy);
    }
}
