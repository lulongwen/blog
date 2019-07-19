<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Adminuser */

$this -> title = '新建管理员';
$this -> params['breadcrumbs'][] = ['label' => '管理员', 'url' => ['index']];
$this -> params['breadcrumbs'][] = $this -> title;
?>
<header class="admin-index">
  <h1><?= Html ::encode($this -> title) ?></h1>
</header>

<?php $form = ActiveForm ::begin(); ?>

<?= $form -> field($model, 'username') -> textInput(['maxlength' => true]) ?>

<?= $form -> field($model, 'nickname') -> textInput(['maxlength' => true]) ?>

<?= $form -> field($model, 'password') -> passwordInput(['maxlength' => true]) ?>

<?= $form -> field($model, 'password2') -> passwordInput(['maxlength' => true]) ?>

<?= $form -> field($model, 'email') -> textInput(['maxlength' => true]) ?>

<?= $form -> field($model, 'avatar') -> textInput(['maxlength' => true]) ?>

<?= $form -> field($model, 'level') -> radioList([
  '1' => '普通用户', '2' => '会员用户'
],['maxlength' => true]) ?>

<?= $form -> field($model, 'profile') -> textarea(['rows' => 6]) ?>

<div class="form-group">
  <?= Html ::submitButton('保存', ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm ::end(); ?>
