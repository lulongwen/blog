<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use common\models\User;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this -> title = $model -> username;
$this -> params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this -> params['breadcrumbs'][] = $this -> title;
\yii\web\YiiAsset ::register($this);
?>
<header class="admin-index">
  <h1><?= Html ::encode($this -> title) ?></h1>
  <div class="btn-group btn-group-sm extra">
    <?= Html ::a('修改', ['update', 'id' => $model -> id], ['class' => 'btn btn-info']) ?>
    <?= Html ::a('删除', ['delete', 'id' => $model -> id], [
      'class' => 'btn btn-danger',
      'data' => [
        'confirm' => 'Are you sure you want to delete this item?',
        'method' => 'post',
      ],
    ]) ?>
  </div>
</header>

<?= DetailView ::widget([
  'model' => $model,
  'attributes' => [
    'id',
    'username',
    // 'auth_key',
    // 'password_hash',
    // 'password_reset_token',
    'email:email',
    [
      'attribute' => 'status',
      'value' => function($model) {
        return User::allStatus()[$model-> status];
      }
    ],
    'avatar',
    'created_at',
    'updated_at',
    // 'verification_token',
    'deleted_at',
  ],
]) ?>
