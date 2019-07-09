<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%_adminuser}}".
 *
 * @property string $id
 * @property string $user_name
 * @property string $nick_name
 * @property string $password
 * @property string $email
 * @property string $profile
 */
class Adminuser extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%adminuser}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_name', 'nick_name', 'password', 'email'], 'required'],
            [['profile'], 'string'],
            [['user_name', 'nick_name', 'password'], 'string', 'max' => 128],
            [['email'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_name' => 'User Name',
            'nick_name' => 'Nick Name',
            'password' => 'Password',
            'email' => 'Email',
            'profile' => 'Profile',
        ];
    }
}
