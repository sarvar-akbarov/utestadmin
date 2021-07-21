<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tests".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $description
 * @property int|null $is_premium
 * @property string|null $analyse
 * @property string|null $main_file
 * @property string|null $images
 * @property int|null $category_id
 * @property int|null $user_id
 *
 * @property Results[] $results
 * @property TestItems[] $testItems
 * @property Categories $category
 * @property User $user
 */
class Tests extends \yii\db\ActiveRecord
{

    public $analyse_file;
    public $main_file_file;
    public $images_file;
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tests';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'description'], 'required'],
            [['description','images'], 'string'],
            [['category_id', 'user_id', 'is_premium', 'has_gift'], 'integer'],
            [['name', 'analyse', 'main_file'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categories::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['analyse_file','main_file'],'file'],
            [['images_file'], 'file', 'extensions' => 'png, jpg, jpeg', 'maxFiles' => 5],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'is_premium' => Yii::t('app','Is Premium'),
            'analyse' => Yii::t('app', 'Analyse'),
            'analyse_file' => Yii::t('app', 'Analyse'),
            'main_file' => Yii::t('app', 'Main File'),
            'main_file_file' => Yii::t('app', 'Main File'),
            'images' => Yii::t('app', 'Images'),
            'images_file' => Yii::t('app', 'Images'),
            'category_id' => Yii::t('app', 'Category ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'has_gift' => Yii::t('app', 'Has Gift')
        ];
    }

    /**
     * Gets query for [[Results]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getResults()
    {
        return $this->hasMany(Results::className(), ['test_id' => 'id']);
    }

    /**
     * Gets query for [[TestItems]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTestItems()
    {
        return $this->hasMany(TestItems::className(), ['test_id' => 'id']);
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Categories::className(), ['id' => 'category_id']);
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

    public function uploadFiles()
    {
        if ($this->main_file_file) {
            if($this->main_file && file_exists($this->main_file) ){
                unlink(Yii::getAlias($this->main_file));
            }
            $fileName = 'uploads/test_files/'.$this->name.'_'.date('Y_m_d_H_i_s') . '.' . $this->main_file_file->extension;
            $this->main_file_file->saveAs($fileName);
            $this->main_file =  $fileName;
        }

        if ($this->analyse_file) {
            if($this->analyse && file_exists($this->analyse) ){
                unlink(Yii::getAlias($this->analyse));
            }
            $fileName = 'uploads/test_analyses/'.$this->name.'_'.date('Y_m_d_H_i_s') . '.' . $this->analyse_file->extension;
            $this->analyse_file->saveAs($fileName);
            $this->analyse =  $fileName;
        }

        if ($this->images_file) {
            $imgs = explode(',', $this->images);
            if(count($imgs) > 0){
                foreach($imgs as $img){
                    if($img && file_exists($img) ){
                        unlink(Yii::getAlias($img));
                    }
                }
            }
            $filenames = [];

            foreach ($this->images_file as $key=>$file) 
            {
                $fileName = 'uploads/test_images/'.$this->name.'_'.$key.'_'.date('Y_m_d_H_i_s') . '.' . $file->extension;
                $filenames[] = $fileName;
                $file->saveAs($fileName);
            }
            $this->images =  implode(',', $filenames);
        }
        $this->save(false);
    }

    public function beforeDelete()
    {
        if($this->main_file && file_exists($this->main_file) ){
            unlink(Yii::getAlias($this->main_file));
        }

        if($this->analyse && file_exists($this->analyse) ){
            unlink(Yii::getAlias($this->analyse));
        }

        $imgs = explode(',', $this->images);
        if(count($imgs) > 0){
            foreach($imgs as $img){
                if($img && file_exists($img) ){
                    unlink(Yii::getAlias($img));
                }
            }
        }
           
        return parent::beforeDelete();
    }

}
