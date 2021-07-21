<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "about_company".
 *
 * @property int $id
 * @property string|null $logo Логотип
 * @property string|null $address Адрес
 * @property string|null $phone Телефон номер
 * @property string|null $email email
 * @property string|null $coor_x Координация Х
 * @property string|null $coor_y Координация У
 */
class AboutCompany extends \yii\db\ActiveRecord
{
    public $file;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'about_company';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['address'], 'string'],
            [['logo', 'phone', 'email', 'coor_x', 'coor_y'], 'string', 'max' => 255],
            [['file'],'file'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'logo' => 'Логотип',
            'file' => 'Логотип',
            'address' => 'Адрес',
            'phone' => 'Телефон номер',
            'email' => 'email',
            'coor_x' => 'Координация Х',
            'coor_y' => 'Координация У',
        ];
    }

    public function getLogo()
    {
        if ($this->logo){
            return "<img src='/".$this->logo."' alt='Company Logo' style='width:100px;' />";
        }else{
            return "<img src='/images/logo.png' alt='Company Logo' style='width:100px;' />";
        }
    }

    public function uploadLogo()
    {
        if ($this->file && $this->validate()) {

            if($this->logo && file_exists($this->logo) ){
                unlink(Yii::getAlias($this->logo));
            }

            $fileName = 'images/logo' . '.' . $this->file->extension;
            $this->file->saveAs($fileName);
            $this->logo =  $fileName;
            $this->save(false);
        }
        
        return true;
    }
}
