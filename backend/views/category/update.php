<?php

  use yii\helpers\Html;

  /* @var $this yii\web\View */
  /* @var $model common\models\Category */

  $this->title = '修改分类: ' . $model->name;
  $this->params['breadcrumbs'][] = ['label' => '分类', 'url' => ['index']];
  $this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
  $this->params['breadcrumbs'][] = '修改';
?>
<header class="admin-index">
  <h1><?= Html::encode($this->title) ?></h1>
</header>

<?= $this->render('_form', [
  'model' => $model,
]) ?>

