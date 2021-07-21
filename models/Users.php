<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string|null $login Логин
 * @property string|null $phone Телефон номер
 * @property string|null $password Пароль
 * @property string|null $fio ФИО
 * @property string|null $avatar Аватар пользователя
 * @property int|null $status Статус пользователя
 * @property int|null $permission
 *
 * @property Blog[] $blogs
 * @property Contact[] $contacts
 */
class Users extends \yii\db\ActiveRecord
{
    public $file;
    public $new_password;

    const ADMIN = 1;
    const MODERATOR = 2;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['login','phone','fio'],'required'],
            [['new_password'],'required','when' => function($model){
                return $model->isNewRecord;
            }],
            [['status', 'permission'], 'integer'],
            [['file'],'file'],
            [['login', 'phone', 'password', 'fio', 'avatar', 'new_password'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'login' => 'Логин',
            'phone' => 'Телефон номер',
            'password' => 'Пароль',
            'new_password' => 'Пароль',
            'fio' => 'ФИО',
            'avatar' => 'Аватар пользователя',
            'file' => 'Аватар пользователя',
            'status' => 'Статус пользователя',
            'permission' => 'Permission',
        ];
    }

    /**
     * Gets query for [[Blogs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBlogs()
    {
        return $this->hasMany(Blog::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Contacts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getContacts()
    {
        return $this->hasMany(Contact::className(), ['user_id' => 'id']);
    }

    public function beforeSave($insert)
    {
        if ($this->new_password)
        {
            $this->password = Yii::$app->security->generatePasswordHash($this->new_password);
        }
        return parent::beforeSave($insert);
    }

    public function getAvatar()
    {
        if ($this->avatar){
            return "<img src='/".$this->avatar."' alt='Аватар пользователя' style='width:100px;' />";
        }else{
            return "<img src='/images/user.png' alt='Аватар пользователя' style='width:100px;' />";
        }
    }

    public function getImage()
    {
        if ($this->avatar){
            return  '/'.$this->avatar;
        }else{
            return '/images/user.png';
        }
    }

    public function uploadAvatar()
    {
        if ($this->file && $this->validate()) {

            if($this->avatar && file_exists($this->avatar) ){
                unlink(Yii::getAlias($this->avatar));
            }

            $fileName = 'uploads/avatars/'. $this->fio . '.' . $this->file->extension;
            $this->file->saveAs($fileName);
            $this->avatar =  $fileName;
            $this->save(false);
        }
        return true;
    }

    public static function getPermission()
    {
        return [
            self::ADMIN => Yii::t('app','Admin'),
            self::MODERATOR => Yii::t('app','Moderator'),
        ];
    }

    public function isAdmin()
    {
        return $this->permission == self::ADMIN;
    }

    public function isModerator()
    {
        return $this->permission == self::MODERATOR;
    }

}
