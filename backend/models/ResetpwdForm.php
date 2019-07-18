<?php
/**
 * Created by PhpStorm.
 * User: lulongwen
 * Date: 2019-07-18
 * Time: 09:20
 */

namespace backend\models;

use yii\base\Model;
use common\models\Adminuser;
use yii\helpers\VarDumper;

/**
 * Signup form
 */
class ResetpwdForm extends Model
{
  public $password;
  public $password2;
  
  public function rules()
  {
    return [
      ['password', 'required'],
      ['password', 'string', 'min' => 6],
      
      ['password2','compare','compareAttribute'=>'password',
        'message'=>'两次输入的密码不一致！'],
    ];
  }
  
  public function attributeLabels()
  {
    return [
      'password' => '密码',
      'password_repeat'=>'确认密码',
    ];
  }
  
  
  /**
   * Signs user up.
   *
   * @return User|null the saved model or null if saving fails
   */
  public function resetPassword($id)
  {
    if (!$this->validate()) {
      return null;
    }
    
    $admuser = Adminuser::findOne($id);
    $admuser->setPassword($this->password);
    $admuser->removePasswordResetToken();
    
    return $admuser->save() ? true : false;
  }
}