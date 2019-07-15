<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mludvik\tagsinput\TagsInputWidget;

use common\models\Category;
use common\models\User;


// all() 返回对象 column 返回列数据, indexBy 索引值
$category = Category ::find() -> select(['name', 'id']) -> orderBy('position') -> indexBy('id') -> column();

$user = User ::find() -> select(['username', 'id']) -> indexBy('id') -> column();

$status = ['0' => '草稿', '1' => '已发布', '2' => '已归档'];
$model -> status = '0';

/*
 创建时间和更新时间应该有系统自动创建，不需要显示
 <?= $form -> field($model, 'created_at') -> textInput()
  公用部分独立处理，放在 _form.php 里面

  use bizley\quill\Quill;
  $form -> field($model, 'content', [
    'options' => ['class' => 'quill-height']
  ]) -> widget(Quill::className(), [])
 */

?>
<div class="post-form">
  
  <?php $form = ActiveForm ::begin(); ?>
  
  <?= $form -> field($model, 'title') -> textInput(['maxlength' => true, 'autofocus' => true]) ?>
  
  <?= $form -> field($model, 'summary') -> textarea(['rows' => 6]) ?>
  
  <?= $form -> field($model, 'tags')
    -> widget(TagsInputWidget ::className(), [
    'options' => [
      'maxlenth' => '30',
      'class' => 'form-control',
      'placeholder' => '请输入标签回车确认'
    ]
  ]) ?>
  
  <?= $form -> field($model, 'userid') -> dropDownList($user, ['prompt' => '请选择作者']) ?>
  
  <?= $form -> field($model, 'categoryid') -> dropDownList($category, ['prompt' => '请选择分类']) ?>
  
  <?= $form -> field($model, 'status') -> radioList($status) ?>
  
  <?= $form -> field($model, 'content') -> widget('common\widgets\ueditor\Ueditor', [
      'options' => [
        // 'initialFrameWidth' => 850,
        'initialFrameHeight' => 600,
        //定制菜单
        // 'toolbars' => []
      ]
    ]) ?>
  
  
  <?= $form -> field($model, 'thumbnail') -> widget('common\widgets\file_upload\FileUpload', [
      'config' => [
        //图片上传的一些配置，不写调用默认配置
        // 'domain_url' => '/images',
      ]
    ]) ?>
  
  
  <div class="form-group">
    <?= Html ::submitButton(($model -> isNewRecord ? '创建' : '修改'), ['class' => 'btn btn-success']) ?>
  </div>
  
  <?php ActiveForm ::end(); ?>

</div>
