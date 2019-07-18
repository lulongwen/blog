<?php

namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * User model 验证功能和前台会员功能，比如查看文章，发表评论
 * This is the model class for table "blog_user".
 *
 * @property int $id 用户ID
 * @property string $username 用户名
 * @property string $auth_key 认证的 key
 * @property string $password_hash 密码
 * @property string $password_reset_token 重置密码token
 * @property string $email 邮箱
 * @property int $status 状态,10注册已验证，9注册未验证
 * @property string $avatar 用户头像
 * @property int $created_at 创建时间
 * @property int $updated_at 更新时间
 * @property string $verification_token 认证token
 * @property int $deleted_at 删除时间
 */
class User extends ActiveRecord implements IdentityInterface
{
  const STATUS_DELETED = 0;
  const STATUS_INACTIVE = 9;
  const STATUS_ACTIVE = 10;
  
  /**
   * {@inheritdoc}
   */
  public static function tableName()
  {
    return '{{%user}}';
  }
  
  /**
   * {@inheritdoc}
   */
  public function behaviors()
  {
    return [
      TimestampBehavior ::className(),
    ];
  }
  
  
  public function rules()
  {
    return [
      ['status', 'default', 'value' => self::STATUS_INACTIVE],
      ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_INACTIVE, self::STATUS_DELETED]],
      
      [['username', 'email'], 'required'],
      [['status', 'created_at', 'updated_at', 'deleted_at'], 'integer'],
      [['username', 'email'], 'string', 'max' => 30],
      [['auth_key'], 'string', 'max' => 32],
      [['password_hash', 'password_reset_token'], 'string', 'max' => 60],
      [['avatar'], 'string', 'max' => 120],
      [['verification_token'], 'string', 'max' => 180],
      [['username', 'email'], 'unique'],
      
      [['email'], 'email'],
      [['password_reset_token'], 'unique'],
  
      // [['status', 'created_at', 'updated_at', 'deleted_at'], 'safe'],
    ];
  }
  
  public function attributeLabels()
  {
    return [
      'id' => 'ID',
      'username' => '用户名',
      'auth_key' => '认证 KEY',
      'password_hash' => '密码',
      'password_reset_token' => '重置TOKEN',
      'email' => '邮箱',
      'status' => '认证状态',
      'avatar' => '头像',
      'created_at' => '创建时间',
      'updated_at' => '更新时间',
      'verification_token' => '验证TOKEN',
      'deleted_at' => '删除时间',
    ];
  }
  
  
  // 认证相关的代码
  public static function findIdentity($id)
  {
    return static ::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
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
    return static ::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
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
      'status' => self::STATUS_ACTIVE,
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
      'verification_token' => $token,
      'status' => self::STATUS_INACTIVE
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
  
  
  
  // 后台功能代码
  public static function allStatus() {
    return [self::STATUS_ACTIVE => '已认证', self::STATUS_INACTIVE => '未认证', self::STATUS_DELETED => '删除'];
  }
  
  public function getStatusStr() {
    return $this->status == self::STATUS_ACTIVE ? '已认证' : '未认证';
  }
}
