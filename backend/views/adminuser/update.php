<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Adminuser */

$this -> title = '修改管理员: ' . $model -> username;
$this -> params['breadcrumbs'][] = ['label' => '管理员', 'url' => ['index']];
$this -> params['breadcrumbs'][] = ['label' => $model -> id, 'url' => ['view', 'id' => $model -> id]];
$this -> params['breadcrumbs'][] = '修改';
?>
<header class="admin-index">
  <h1><?= Html ::encode($this -> title) ?></h1>
</header>

<?= $this -> render('_form', [
  'model' => $model,
]) ?>


