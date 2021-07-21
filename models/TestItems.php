<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "test_items".
 *
 * @property int $id
 * @property int|null $test_id
 * @property string|null $name
 * @property int|null $count
 * @property string|null $answers
 * @property float|null $ball
 *
 * @property Results[] $results
 * @property Tests $test
 */
class TestItems extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'test_items';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'answers', 'ball','count'], 'required'],
            [['test_id', 'count'], 'integer'],
            [['ball'], 'number'],
            [['name', 'answers'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'test_id' => Yii::t('app', 'Test ID'),
            'name' => Yii::t('app', 'Name'),
            'count' => Yii::t('app', 'Count'),
            'answers' => Yii::t('app', 'Answers'),
            'ball' => Yii::t('app', 'Ball'),
        ];
    }

    /**
     * Gets query for [[Results]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getResults()
    {
        return $this->hasMany(Results::className(), ['test_item_id' => 'id']);
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
}
