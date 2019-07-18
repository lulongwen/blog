<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this -> title = '修改用户: ' . $model -> username;
$this -> params['breadcrumbs'][] = ['label' => '用户管理', 'url' => ['index']];
$this -> params['breadcrumbs'][] = ['label' => $model -> username, 'url' => ['view', 'id' => $model -> id]];
$this -> params['breadcrumbs'][] = '修改';
?>
<header class="admin-index">
  
  <h1><?= Html ::encode($this -> title) ?></h1>
</header>

<?= $this -> render('_form', [
  'model' => $model,
]) ?>
