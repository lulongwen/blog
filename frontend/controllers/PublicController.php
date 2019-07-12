<?php

namespace frontend\controllers;
use Yii;

use common\models\User;

// public 不要继承 BaseController 会造成重定向循环
class PublicController extends \yii\web\Controller
{
  public $layout = false;
  
  public function actionIndex()
  {
    return $this -> render('index');
  }
  
  // 登录
  public function actionLogin()
  {
    $model = new User();
    if (Yii::$app-> request-> isPost) {
      $post = Yii::$app-> request-> post();
      if ($model-> login($post)) {
        return $this-> redirect(['post/index']);
      }
    }
    
    return $this -> render('login', ['model' => $model]);
  }
  
  // 退出 清除 session
  public function actionLogout()
  {
    Yii::$app-> session-> removeAll();
    $login = isset(Yii::$app-> session['admin']['isLogin']);
    if (!$login) {
      return $this-> redirect(['public/login']);
    }
    return $this -> goBack();
  }
  
  // 注册账号
  public function actionSignup() {
    $model = new User();
    return $this->render('signup', ['model' => $model]);
  }
  
  // 找回密码
  public function actionSeekpassword() {
  
  }
  
  // 重置密码
  public function actionUpdatepassword() {
  
  }
}
