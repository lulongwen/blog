<?php

namespace common\models;

use Yii;
use yii\helpers\Html;

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
  private $oldTag;
  public $tags;

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
      [['title', 'content', 'status'], 'required'],
      [['summary', 'content'], 'string'],
      [['userid', 'categoryid', 'status', 'created_at', 'updated_at', 'deleted_at'], 'integer'],
      [['title'], 'string', 'max' => 200],
      [['thumbnail'], 'string', 'max' => 120],
      [['username'], 'string', 'max' => 80],
    ];
  }
  

  public function attributeLabels()
  {
    return [
      'id' => 'ID',
      'title' => '标题',
      'summary' => '摘要',
      'content' => '内容',
      'thumbnail' => '缩略图',
      'userid' => '作者',
      'categoryid' => '分类',
      'status' => '状态',
      'tags' => '文章标签',
      'created_at' => '创建时间',
      'updated_at' => '更新时间',
      'deleted_at' => '删除时间',
    ];
  }


  // 文章表和标签表的关联关系
  public function getRelate() {
    return $this-> hasMany(PosTag::className(), ['post_id' => 'id']);
  }
  
  // 获取文章评论
  public function getComment() {
    return $this-> hasOne(CommentModel::className(), ['post_id' => 'id']);
  }



  // 获取分页
  public function getPages($query, $page=1, $pageSize=10, $search=null) {
    if ($search) {
      $query = $query-> andFilerWhere($search);
    }

    $data['count'] = $query-> count();
    if (!$data['count']) {
      return [
        'count' => 0,
        'page' => $page,
        'pageSize' => $pageSize,
        'start' => 0,
        'end' => 0,
        'data' => []
      ];
    }
    
    // 超过实际页数，不取 page为当前页
    $page = (ceil($data['count'] / $pageSize) < $page)
      ? ceil($data['count'] / $pageSize) : $page;
    
    // 当前页
    $data['page'] = $page;
    // 每页显示条数，起始页，末页
    $data['pageSize'] = $pageSize;
    $data['start'] = ($page -1) * $pageSize +1;
    $data['end'] = (ceil($data['count'] / $pageSize) == $page)
      ? $data['count'] : ($page -1) * $pageSize + $pageSize;
    
    $data['data'] = $query-> offset(($page-1) * $pageSize)
      -> limit($pageSize) -> asArray()-> all();
    
    return $data;
  }




  // 重写 beforeSave方法，提交数据库保存之前，先赋值
  public function beforeSave($insert) {
    // 调用父类的方法，保证原先的代码会执行
    if (parent::beforeSave($insert)) {
      // 新增的时候，2个时间都赋值
      if ($insert) {
        $this-> created_at = time();
        $this-> updated_at = time();
      }
      else {
        $this-> updated_at = time();
      }
      return true;
    }

    return false;
  }

  
  
  public function getStatus0() {
    // className() 表名，第二个参数，关联的条件
    return $this-> hasOne(PostStatus::className(), ['id' => 'status']);
  }
  
  public function getStatus2() {
    return '已发布';
  }


  public function getUser() {
    return $this-> hasOne(User::className(), ['id' => 'userid']);
  }
  
  public function getCategory() {
    return $this-> hasOne(Category::className(), ['id'=> 'categoryid']);
  }


  public function getComments() {
    return $this-> hasMany(Comment::className(), ['postid' => 'id']);
  }


  public function getCommentCount() {
    return Comment::find()-> where(['postid' => $this->id, 'status' => 2])-> count();
  }


  public function getActiveComments() {
    return $this-> hasMany(Comment::className(), ['postid' => 'id'])
      -> where('status= :status', [':status' => 1])
      -> orderBy('id DESC');
  }


  // public function afterFind() {
  //   // TODO: Change the autogenerated stub
  //   parent::afterFind();
  //   $this-> oldTag = $this-> tags;
  // }


  // public function afterSave($insert, $changedAttributes) {
  //   // TODO: Change the autogenerated stub
  //   parent::afterSave($insert, $changedAttributes);
  //   Tag::updateFrequency($this-> oldTag, $this->tags);
  // }


  // public function afterDelete() {
  //   parent::afterDelete(); // TODO: Change the autogenerated stub
  //
  //   Tag::updateFrequency($this-> tags, '');
  // }


  public function getUrl() {
    $params = ['post/detail', 'id' => $this->id, 'title' => $this->title];
    return Yii::$app-> urlManager-> createUrl($params);
  }


  public function getTagLink() {
    $links = [];
    $tags = Tag::string2array($this->tags);
    foreach($tags as $tag) {
      $links[] = Html::a(Html::encode($tag), ['post/index', 'PostSearch[tags]' => $tag]);
    }

    return $links;
  }


  // 截取字符串长度
  public function getBeginning($length=288) {
    $str = strip_tags($this->content);
    $temp = mb_strlen($str);
    $str = mb_substr($str, 0, $length, 'utf-8');

    return $str.(($temp > $length) ? '...' : '');
  }

}































