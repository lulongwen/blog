<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%post}}".
 * @property int $id 自增 id
 * @property string $title 标题
 * @property string $summary 摘要
 * @property string $content 文章内容
 * @property string $thumbnail 缩略图
 * @property int $userid 作者 id
 * @property string $username 用户名
 * @property int $categoryid 分类 id
 * @property int $status 是否发布，0-未发布，1-已发布
 * @property int $created_at 创建时间
 * @property int $updated_at 更新时间
 * @property int $deleted_at 删除时间
 */
class Post extends \yii\db\ActiveRecord
{
  /**
   * {@inheritdoc}
   */
  public static function tableName()
  {
    return '{{%post}}';
  }
  
  /**
   * {@inheritdoc}
   */
  public function rules()
  {
    return [
      [['summary', 'content'], 'string'],
      [['userid', 'categoryid', 'status', 'created_at', 'updated_at', 'deleted_at'], 'integer'],
      [['title'], 'string', 'max' => 200],
      [['thumbnail'], 'string', 'max' => 120],
      [['username'], 'string', 'max' => 80],
    ];
  }
  
  /**
   * {@inheritdoc}
   */
  public function attributeLabels()
  {
    return [
      'id' => 'ID',
      'title' => '标题',
      'summary' => '摘要',
      'content' => '内容',
      'thumbnail' => '缩略图',
      'userid' => '作者ID',
      'username' => '作者',
      'categoryid' => '分类 ID',
      'status' => '状态',
      'created_at' => '创建时间',
      'updated_at' => '更新时间',
      'deleted_at' => '删除时间',
    ];
  }
  
  
  public function getStatus0() {
    // className() 表名，第二个参数，关联的条件
    return $this-> hasOne(PostStatus::className(), ['id' => 'status']);
  }
}
