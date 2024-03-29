<?php

  use yii\helpers\Html;
  use yii\widgets\ActiveForm;

  use common\models\Comment;

  /* @var $this yii\web\View */
  /* @var $model common\models\Comment */
  /* @var $form yii\widgets\ActiveForm */

  $status = ['0' => '未审核', '1' => '已审核'];
  $remind = ['0' => '未提醒', '1' => '已提醒'];

  // echo '<pre>';
  // var_dump($model);exit();
?>

<div class="comment-form">

  <?php $form = ActiveForm::begin(); ?>

  <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>


  <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

  <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>


  <?= $form->field($model, 'remind')->radioList(Comment::getRemindArr()) ?>

  <?= $form->field($model, 'status')->radioList(Comment::getStatusArr()) ?>


  <div class="form-group">
    <?= Html::submitButton('保存', ['class' => 'btn btn-success']) ?>
  </div>

  <?php ActiveForm::end(); ?>

</div>