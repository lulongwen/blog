<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use common\models\User;

$class = $model-> isNewRecord ? 'btn btn-success' : 'btn btn-info';

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">
  
  <?php $form = ActiveForm ::begin(); ?>
  
  <?= $form -> field($model, 'username') -> textInput(['maxlength' => true])?>
  
  <?= $form -> field($model, 'email') -> textInput(['maxlength' => true])?>
  
  <?= $form -> field($model, 'status')
            -> dropDownList(User::allStatus(), ['prompt' => '请选择状态']) ?>
  
  <div class="form-group">
    <?= Html ::submitButton('保存', ['class' => $class]) ?>
  </div>
  
  <?php ActiveForm ::end(); ?>

</div>
