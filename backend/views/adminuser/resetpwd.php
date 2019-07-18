<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model common\models\Adminuser */

$this -> title = '重置密码';
$this -> params['breadcrumbs'][] = ['label' => '管理员', 'url' => ['index']];
$this -> params['breadcrumbs'][] = $this -> title;
?>
<header class="admin-index">
  
  <h1><?= Html ::encode($this -> title) ?></h1>
</header>

<div class="adminuser-form">
  
  <?php $form = ActiveForm ::begin(); ?>
  
  <?= $form -> field($model, 'password') -> passwordInput(['maxlength' => true]) ?>
  
  <?= $form -> field($model, 'password2') -> passwordInput(['maxlength' => true]) ?>
  
  <div class="form-group">
    <?= Html ::submitButton('重置密码', ['class' => 'btn btn-success']) ?>
  </div>
  
  <?php ActiveForm ::end(); ?>

</div>
