<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Comment */

$this -> title = '修改评论: ' . $model -> id;
$this -> params['breadcrumbs'][] = ['label' => '评论', 'url' => ['index']];
$this -> params['breadcrumbs'][] = ['label' => 'ID:' . $model -> id, 'url' => ['view', 'id' => $model -> id]];
$this -> params['breadcrumbs'][] = '修改';
?>
<header class="admin-index">
  <h1><?= Html ::encode($this -> title) ?></h1>
</header>


<?= $this -> render('_form', [
  'model' => $model,
]) ?>
