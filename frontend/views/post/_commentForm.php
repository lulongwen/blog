<?php
/**
 * Created by PhpStorm.
 * User: lulongwen
 * Date: 2019-07-16
 * Time: 22:05
 */
use yii\helpers\Html;
use yii\widgets\ActiveForm;

// '#' => 'comments' 提交后的定位点
$options = [
  'action' => ['post/detail', 'id' => $id, '#' => 'comments'],
  'method' => 'post'
];
?>

<div class="comment-form">
    <?php $form = ActiveForm::begin($options); ?>

    <?= $form->field($comment, 'content')->textarea(['rows' => 3]) ?>

    <div class="form-group">
  <!-- $comment-> isNewRecord ? '新增': '修改' -->
        <?= Html::submitButton('保存', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
