<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "results".
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $test_id
 * @property int|null $test_item_id
 * @property string|null $user_answers
 * @property float|null $user_point
 *
 * @property Tests $test
 * @property TestItems $testItem
 * @property User $user
 */
class Results extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'results';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'test_id', 'test_item_id'], 'integer'],
            [['user_point'], 'number'],
            [['user_answers'], 'string', 'max' => 255],
            [['test_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tests::className(), 'targetAttribute' => ['test_id' => 'id']],
            [['test_item_id'], 'exist', 'skipOnError' => true, 'targetClass' => TestItems::className(), 'targetAttribute' => ['test_item_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'test_id' => Yii::t('app', 'Test ID'),
            'test_item_id' => Yii::t('app', 'Test Item ID'),
            'user_answers' => Yii::t('app', 'User Answers'),
            'user_point' => Yii::t('app', 'User Point'),
        ];
    }

    /**
     * Gets query for [[Test]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTest()
    {
        return $this->hasOne(Tests::className(), ['id' => 'test_id']);
    }

    /**
     * Gets query for [[TestItem]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTestItem()
    {
        return $this->hasOne(TestItems::className(), ['id' => 'test_item_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
