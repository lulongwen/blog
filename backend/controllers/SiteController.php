<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\AdminLoginForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
  public function behaviors()
  {
    return [
      'access' => [
        'class' => AccessControl ::className(),
        'rules' => [
          [
            'actions' => ['login', 'error'],
            'allow' => true,
          ],
          [
            'actions' => ['logout', 'index'],
            'allow' => true,
            'roles' => ['@'],
          ],
        ],
      ],
      'verbs' => [
        'class' => VerbFilter ::className(),
        'actions' => [
          'logout' => ['post'],
        ],
      ],
    ];
  }
  
  /**
   * {@inheritdoc}
   */
  public function actions()
  {
    return [
      'error' => [
        'class' => 'yii\web\ErrorAction',
      ],
    ];
  }
  
  /**
   * Displays homepage.
   * @return string
   */
  public function actionIndex()
  {
    return $this -> render('index');
  }
  
  // 页面用到的 LoginForm是前台的，要复制一份修改
  public function actionLogin()
  {
    if (!Yii ::$app -> user -> isGuest) {
      return $this -> goHome();
    }
    
    $model = new AdminLoginForm();
    if ($model -> load(Yii ::$app -> request -> post()) && $model -> login()) {
      // 登录成功，回到登录前的页面
      return $this -> goBack();
    } else {
      $model -> password = '';
      // 登录失败，页面显示错误，提示用户
      return $this -> render('login', [
        'model' => $model,
      ]);
    }
  }
  
  /**
   * Logout action.
   * @return string
   */
  public function actionLogout()
  {
    Yii ::$app -> user -> logout();
    
    return $this -> goHome();
  }
}
