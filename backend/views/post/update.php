<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Post */

$this -> title = '更新文章: ' . $model -> title;
$this -> params['breadcrumbs'][] = ['label' => '文章列表', 'url' => ['index']];
$this -> params['breadcrumbs'][] = ['label' => $model -> title, 'url' => ['view', 'id' => $model -> id]];
$this -> params['breadcrumbs'][] = '更新';
?>

<header class="admin-index">
  <h1><?= Html ::encode($this -> title) ?></h1>
</header>

<!-- 渲染视图模版 _form.php -->
<?= $this -> render('_form', ['model' => $model]) ?>

