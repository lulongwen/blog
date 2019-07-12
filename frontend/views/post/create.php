<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Post */

$this -> title = '创建文章';
$this -> params['breadcrumbs'][] = ['label' => '文章列表', 'url' => ['index']];
$this -> params['breadcrumbs'][] = $this -> title;
?>

<h1><?= Html ::encode($this -> title) ?></h1>

<?= $this -> render('_form', ['model' => $model]) ?>

