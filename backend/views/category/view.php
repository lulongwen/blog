<?php

  use yii\helpers\Html;
  use yii\widgets\DetailView;

  /* @var $this yii\web\View */
  /* @var $model common\models\Category */

  $this->title = '分类：' . $model->name;
  $this->params['breadcrumbs'][] = ['label' => '分类', 'url' => ['index']];
  $this->params['breadcrumbs'][] = $this->title;
  \yii\web\YiiAsset::register($this);
?>
<header class="admin-index">
  <h1><?= Html::encode($this->title) ?></h1>
  <div class="btn-group btn-group-sm extra">
    <?= Html::a('修改', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    <?= Html::a('删除', ['delete', 'id' => $model->id], [
      'class' => 'btn btn-danger',
      'data' => [
        'confirm' => '您确认删除这条记录吗?',
        'method' => 'post',
      ],
    ]) ?>
  </div>
</header>

<?= DetailView::widget([
  'model' => $model,
  'attributes' => [
    'id',
    'name',
    'position',
  ],
]) ?>

</div>
