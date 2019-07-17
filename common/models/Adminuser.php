<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "{{%adminuser}}".
 * @property int $id 自增 ID
 * @property string $username 用户名
 * @property string $nickname 昵称
 * @property string $password_hash 密码
 * @property string $email 邮箱
 * @property string $avatar 头像
 * @property int $level 级别
 * @property string $profile 介绍
 * @property string $auth_key 用户 key
 * @property string $password_reset_token 重置密码 token
 */
class Adminuser extends ActiveRecord implements IdentityInterface
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
      [['username', 'nickname'], 'required'],
      [['level'], 'integer'],
      [['profile'], 'string'],
      [['username', 'nickname'], 'string', 'max' => 80],
      [['password_hash', 'password_reset_token'], 'string', 'max' => 200],
      [['email', 'avatar'], 'string', 'max' => 120],
      [['auth_key'], 'string', 'max' => 32],
    ];
  }
  
  /**
   * {@inheritdoc}
   */
  public function attributeLabels()
  {
    return [
      'id' => 'ID',
      'username' => 'Username',
      'nickname' => 'Nickname',
      'password_hash' => 'Password Hash',
      'email' => 'Email',
      'avatar' => 'Avatar',
      'level' => 'Level',
      'profile' => 'Profile',
      'auth_key' => 'Auth Key',
      'password_reset_token' => 'Password Reset Token',
    ];
  }
  
  
  // 认证相关的代码
  public static function findIdentity($id)
  {
    return static ::findOne(['id' => $id]);
  }
  
  /**
   * {@inheritdoc}
   */
  public static function findIdentityByAccessToken($token, $type = null)
  {
    throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
  }
  
  /**
   * Finds user by username
   * @param string $username
   * @return static|null
   */
  public static function findByUsername($username)
  {
    return static ::findOne(['username' => $username]);
  }
  
  /**
   * Finds user by password reset token
   * @param string $token password reset token
   * @return static|null
   */
  public static function findByPasswordResetToken($token)
  {
    if (!static ::isPasswordResetTokenValid($token)) {
      return null;
    }
    
    return static ::findOne([
      'password_reset_token' => $token,
    ]);
  }
  
  /**
   * Finds user by verification email token
   * @param string $token verify email token
   * @return static|null
   */
  public static function findByVerificationToken($token)
  {
    return static ::findOne([
      'verification_token' => $token
    ]);
  }
  
  /**
   * Finds out if password reset token is valid
   * @param string $token password reset token
   * @return bool
   */
  public static function isPasswordResetTokenValid($token)
  {
    if (empty($token)) {
      return false;
    }
    
    $timestamp = (int)substr($token, strrpos($token, '_') + 1);
    $expire = Yii ::$app -> params['user.passwordResetTokenExpire'];
    return $timestamp + $expire >= time();
  }
  
  /**
   * {@inheritdoc}
   */
  public function getId()
  {
    return $this -> getPrimaryKey();
  }
  
  /**
   * {@inheritdoc}
   */
  public function getAuthKey()
  {
    return $this -> auth_key;
  }
  
  /**
   * {@inheritdoc}
   */
  public function validateAuthKey($authKey)
  {
    return $this -> getAuthKey() === $authKey;
  }
  
  /**
   * Validates password
   * @param string $password password to validate
   * @return bool if password provided is valid for current user
   */
  public function validatePassword($password)
  {
    return Yii ::$app -> security -> validatePassword($password, $this -> password_hash);
  }
  
  /**
   * Generates password hash from password and sets it to the model
   * @param string $password
   */
  public function setPassword($password)
  {
    $this -> password_hash = Yii ::$app -> security -> generatePasswordHash($password);
  }
  
  /**
   * Generates "remember me" authentication key
   */
  public function generateAuthKey()
  {
    $this -> auth_key = Yii ::$app -> security -> generateRandomString();
  }
  
  /**
   * Generates new password reset token
   */
  public function generatePasswordResetToken()
  {
    $this -> password_reset_token = Yii ::$app -> security -> generateRandomString() . '_' . time();
  }
  
  public function generateEmailVerificationToken()
  {
    $this -> verification_token = Yii ::$app -> security -> generateRandomString() . '_' . time();
  }
  
  /**
   * Removes password reset token
   */
  public function removePasswordResetToken()
  {
    $this -> password_reset_token = null;
  }
}
