<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
// use yii\helpers\ArrayHelper;
use common\models\Adminuser;

/* @var $this yii\web\View */
/* @var $model common\models\Adminuser */

$model = Adminuser ::findOne($id);

$this -> title = '权限设置: ' . $model -> username;
$this -> params['breadcrumbs'][] = ['label' => '管理员', 'url' => ['index']];
$this -> params['breadcrumbs'][] = ['label' => $model -> username, 'url' => ['view', 'id' => $id]];
$this -> params['breadcrumbs'][] = '权限设置';
?>

<header class="admin-index">
  <h1><?= Html ::encode($this -> title) ?></h1>
</header>

<?php $form = ActiveForm ::begin(); ?>

<?= Html ::checkboxList('newPri', $AuthAssignmentArray, $allPrivilegesArray, ['style' => 'min-height:60px']); ?>

<div class="form-group">
  <?= Html ::submitButton('设置', ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm ::end(); ?>






