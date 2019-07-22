<?php

  use yii\helpers\Html;
  use yii\bootstrap\ActiveForm;

  $this->title = '管理员登录';
  $fieldOptions1 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-envelope form-control-feedback'></span>"
  ];

  $fieldOptions2 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback'></span>"
  ];

  /*
  $this yii\web\View
  $form yii\bootstrap\ActiveForm
  $model \common\models\LoginForm

  <div class="social-auth-links text-center">
  <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> FaceBook登录</a>
  <a href="#" class="btn btn-block btn-social btn-google-plus btn-flat"><i class="fa fa-google-plus"></i> Google 登录</a>
  </div>
  <!-- /.social-auth-links -->

  <a href="#">忘记密码</a><br>
  <a href="register.html" class="text-center">注册会员</a>
   */
?>

<div class="login-box">
  <h1 class="login-logo">珑文的管理后台</h1>

  <div class="login-box-body">

    <?php $form = ActiveForm::begin(['id' => 'login-form',
      'enableClientValidation' => false]); ?>

    <?= $form
      ->field($model, 'username', $fieldOptions1)
      ->label(false)
      ->textInput(['placeholder' => $model->getAttributeLabel('username')]) ?>

    <?= $form
      ->field($model, 'password', $fieldOptions2)
      ->label(false)
      ->passwordInput(['placeholder' => $model->getAttributeLabel('password')]) ?>

    <p>
      <?= $form->field($model, 'rememberMe')->checkbox() ?>
    </p>

    <?= Html::submitButton('登录', [
      'class' => 'btn btn-primary btn-block btn-flat',
      'name' => 'login-button']) ?>

    <?php ActiveForm::end(); ?>
  </div>
</div>
