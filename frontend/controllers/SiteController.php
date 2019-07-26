<?php

namespace frontend\controllers;

use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;

use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl; // ACF 权限控制

use common\models\LoginForm;
use common\models\Chat;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;

use frontend\models\SignupForm;
use frontend\models\ContactForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
  /**
   * {@inheritdoc}
   */
  public function behaviors()
  {
    return [
      'access' => [
        'class' => AccessControl ::className(),
        'only' => ['logout', 'signup'],
        // 设置规则
        'rules' => [
          [
            // 指定动作
            'actions' => [''],
            // 是否允许
            'allow' => true,
            // 适用这个规则的角色, ? 访客,  @ 注册的用户
            'roles' => ['?'],
          ],
          [
            // 指定动作，退出必须是 注册的用户
            'actions' => ['logout'],
            'allow' => true,
            'roles' => ['@'], // 角色
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
  
  public function actions()
  {
    return [
      'error' => [
        'class' => 'yii\web\ErrorAction',
      ],
      'captcha' => [
        'class' => 'yii\captcha\CaptchaAction',
        'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
      ],
    ];
  }
  
  public function actionIndex()
  {
    return $this -> render('index');
  }
  
  // 添加留言
  public function actionChatCreate()
  {
    $model = new Chat();
    $model -> content = Yii ::$app -> request -> post('content');
    // 保存成功
    if ($model -> validate() && $model -> create()) {
      return json_encode(['status' => true]);
    }
    
    return json_decode(['status' => false, 'message' => '状态发布失败']);
  }
  
  public function actionLogin()
  {
    // 屏蔽登陆页
    // return $this->redirect(['site/index']);
    
    if (!Yii ::$app -> user -> isGuest) {
      return $this -> goHome();
    }
    
    $model = new LoginForm();
    if ($model -> load(Yii ::$app -> request -> post()) && $model -> login()) {
      return $this -> goBack();
    } else {
      $model -> password = '';
      
      return $this -> render('login', [
        'model' => $model,
      ]);
    }
  }
  
  // 登录页
  public function actionLogin2()
  {
    $model = new Fans();
    if (Yii ::$app -> request -> isPost) {
      $post = Yii ::$app -> request -> post();
      if ($model -> login($post)) {
        Yii ::$app -> session -> setFlash('info', '添加成功');
      }
    }
    
    // $model->userpass = '';
    // $model->repass = '';
    return $this -> render("login", ['model' => $model]);
  }
  
  /**
   * Logs out the current user.
   * @return mixed
   */
  public function actionLogout()
  {
    Yii ::$app -> user -> logout();
    
    return $this -> goHome();
  }
  
  /**
   * Displays contact page.
   * @return mixed
   */
  public function actionContact()
  {
    $model = new ContactForm();
    if ($model -> load(Yii ::$app -> request -> post()) && $model -> validate()) {
      if ($model -> sendEmail(Yii ::$app -> params['adminEmail'])) {
        Yii ::$app -> session -> setFlash('success',
          'Thank you for contacting us. We will respond to you as soon as possible.');
      } else {
        Yii ::$app -> session -> setFlash('error', 'There was an error sending your message.');
      }
      
      return $this -> refresh();
    } else {
      return $this -> render('contact', [
        'model' => $model,
      ]);
    }
  }
  
  /**
   * Displays about page.
   * @return mixed
   */
  public function actionAbout()
  {
    return $this -> render('about');
  }
  
  /**
   * Signs user up.
   * @return mixed
   */
  public function actionSignup()
  {
    // 禁止注册
    return $this-> redirect('index');

    $model = new SignupForm();
    if ($model -> load(Yii ::$app -> request -> post()) && $model -> signup()) {
      Yii ::$app -> session -> setFlash('success',
        'Thank you for registration. Please check your inbox for verification email.');
      return $this -> goHome();
    }
    
    return $this -> render('signup', [
      'model' => $model,
    ]);
  }
  
  /**
   * Requests password reset.
   * @return mixed
   */
  public function actionRequestPasswordReset()
  {
    $model = new PasswordResetRequestForm();
    if ($model -> load(Yii ::$app -> request -> post()) && $model -> validate()) {
      if ($model -> sendEmail()) {
        Yii ::$app -> session -> setFlash('success', 'Check your email for further instructions.');
        
        return $this -> goHome();
      } else {
        Yii ::$app -> session -> setFlash('error',
          'Sorry, we are unable to reset password for the provided email address.');
      }
    }
    
    return $this -> render('requestPasswordResetToken', [
      'model' => $model,
    ]);
  }
  
  /**
   * Resets password.
   * @param string $token
   * @return mixed
   * @throws BadRequestHttpException
   */
  public function actionResetPassword($token)
  {
    try {
      $model = new ResetPasswordForm($token);
    } catch (InvalidArgumentException $e) {
      throw new BadRequestHttpException($e -> getMessage());
    }
    
    if ($model -> load(Yii ::$app -> request -> post()) && $model -> validate() && $model -> resetPassword()) {
      Yii ::$app -> session -> setFlash('success', 'New password saved.');
      
      return $this -> goHome();
    }
    
    return $this -> render('resetPassword', [
      'model' => $model,
    ]);
  }
  
  /**
   * Verify email address
   * @param string $token
   * @throws BadRequestHttpException
   * @return yii\web\Response
   */
  public function actionVerifyEmail($token)
  {
    try {
      $model = new VerifyEmailForm($token);
    } catch (InvalidArgumentException $e) {
      throw new BadRequestHttpException($e -> getMessage());
    }
    if ($user = $model -> verifyEmail()) {
      if (Yii ::$app -> user -> login($user)) {
        Yii ::$app -> session -> setFlash('success', 'Your email has been confirmed!');
        return $this -> goHome();
      }
    }
    
    Yii ::$app -> session -> setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
    return $this -> goHome();
  }
  
  /**
   * Resend verification email
   * @return mixed
   */
  public function actionResendVerificationEmail()
  {
    $model = new ResendVerificationEmailForm();
    if ($model -> load(Yii ::$app -> request -> post()) && $model -> validate()) {
      if ($model -> sendEmail()) {
        Yii ::$app -> session -> setFlash('success', 'Check your email for further instructions.');
        return $this -> goHome();
      }
      Yii ::$app -> session -> setFlash('error',
        'Sorry, we are unable to resend verification email for the provided email address.');
    }
    
    return $this -> render('resendVerificationEmail', [
      'model' => $model
    ]);
  }
}
