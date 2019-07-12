<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use bizley\quill\Quill;
use mludvik\tagsinput\TagsInputWidget;
use common\widgets\file_upload\FileUpload;

/* @var $this yii\web\View */
/* @var $model common\models\Post */

// all() 返回对象 column 返回列数据
$category = \common\models\Category::find()
  -> select(['name', 'id'])
  -> orderBy('sort')-> indexBy('id')-> column();

$user = \common\models\User::find()
  -> select(['username', 'id'])
  -> indexBy('id')-> column();

$status = ['0' => '草稿', '1' => '已发布', '2' => '已归档'];

// 创建时间和更新时间应该有系统自动创建，不需要显示
//  <?= $form -> field($model, 'created_at') -> textInput()

?>
<div class="post-form">
  
  <?php $form = ActiveForm ::begin(); ?>
  
  <?= $form -> field($model, 'title')
     -> textInput(['maxlength' => true, 'autofocus' => true]) ?>

  <?= $form -> field($model, 'summary') -> textarea(['rows' => 6]) ?>
  
  <?= $form->field($model, 'tags')->widget(TagsInputWidget::className(), [
    'options' => [
      'maxlenth' => true,
      'class' => 'form-control maxlength-handler'
    ]
  ]) ?>
  
  <?= $form -> field($model, 'userid')
     -> dropDownList($user, ['prompt' => '请选择作者'])?>
  
  <?= $form -> field($model, 'categoryid')
     -> dropDownList($category, ['prompt' => '请选择分类']) ?>
  
  <?= $form -> field($model, 'status') -> radioList($status)?>
  
  <!-- field($model, 'content') -> textarea(['rows' => 6]) -->
  <?= $form -> field($model, 'content', [
    'options' => ['class' => 'quill-height']
  ]) -> widget(Quill::className(), []) ?>
  
  
  <?= $form -> field($model, 'thumbnail')
    -> widget('FileUpload', ['config' => [
      //图片上传的一些配置，不写调用默认配置
      // 'domain_url' => '/images',
    ]
  ]) ?>

  
  <div class="form-group">
    <?= Html ::submitButton(($model->isNewRecord ? '创建' :'修改'), ['class' => 'btn btn-success']) ?>
  </div>
  
  <?php ActiveForm ::end(); ?>

</div>
