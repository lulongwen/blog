<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use bizley\quill\Quill;
use common\widgets\file_upload\FileUpload;

/* @var $this yii\web\View */
/* @var $model common\models\Post */
/* @var $form yii\widgets\ActiveForm */
?>
<style>
.quill-height {
    min-height: 600px;
    height: auto;
  }
  .ql-container {
    height: calc(600px - 42px);
    border-radius: 0;
  }
  </style>
<div class="post-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true, 'autofocus' => true]) ?>

    <?= $form->field($model, 'summary')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'userid')->textInput() ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'categoryid')->textInput() ?>

    <?= $form->field($model, 'categoryid')->dropDownList($cate) ?>

    <?= $form->field($model, 'tag')->widget(\aminkt\widgets\inputTag\InputTag::className(), [
      'options'=>[
        'maxlength' => true,
        'class'=>'form-control maxlength-handler'
      ]
    ]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'status')->inline(true)->radioList(['0'=>'不发布','1'=>'发布']) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'content', [
      'options' => [
        'class' => 'quill-height',
      ]
    ])->widget(Quill::className(), []) ?>

  <?= $form->field($model, 'thumbnail')-> widget('common\widgets\file_upload\FileUpload',
        [
        'config' => [
          //图片上传的一些配置，不写调用默认配置
          // 'domain_url' => '/images',
        ]
      ]) ?>

<?= $form->field($model, 'thumbnail')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'deleted_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
