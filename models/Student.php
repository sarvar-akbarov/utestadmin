<?php

namespace app\models;

use Yii;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "student".
 *
 * @property int $id
 * @property string|null $phone Телефон номер
 * @property string|null $telegram_id
 * @property string|null $fio ФИО
 * @property int|null $status Статус пользователя
 * @property float|null $balance
 * @property string|null $registrated_date
 *
 * @property Results[] $results
 */
class Student extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'student';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status'], 'integer'],
            [['balance'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['phone', 'fio'], 'string', 'max' => 255],
            [['telegram_id'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'phone' => Yii::t('app', 'Phone'),
            'telegram_id' => Yii::t('app', 'Telegram ID'),
            'fio' => Yii::t('app', 'Fio'),
            'status' => Yii::t('app', 'Status'),
            'balance' => Yii::t('app', 'Balance'),
            'registrated_date' => Yii::t('app', 'Registrated Date'),
        ];
    }

    /**
     * Gets query for [[Results]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getResults()
    {
        return $this->hasMany(Results::className(), ['student_id' => 'id']);
    }
}
