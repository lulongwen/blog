<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Comment */

$this -> title = 'Create Comment';
$this -> params['breadcrumbs'][] = ['label' => 'Comments', 'url' => ['index']];
$this -> params['breadcrumbs'][] = $this -> title;
?>
<header class="admin-index">
  <h1><?= Html ::encode($this -> title) ?></h1>
</header>

<?= $this -> render('_form', [
  'model' => $model,
]) ?>


