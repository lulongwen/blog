<?php

namespace common\models;

use common\models\PostTag;
use common\models\PostStatus;

use Yii;
use yii\helpers\Html;
use yii\helpers\Url;

use yii\web\NotFoundHttpException;

/**
 * This is the model class for table "{{%post}}".
 * @property int $id 自增 id
 * @property string $title 标题
 * @property string $summary 摘要
 * @property string $content 文章内容
 * @property string $thumbnail 缩略图
 * @property int $userid 作者 id
 * @property int $username 作者
 * @property int $categoryid 分类 id
 * @property int $status 是否发布，0-未发布，1-已发布
 * @property int $created_at 创建时间
 * @property int $updated_at 更新时间
 * @property int $deleted_at 删除时间
 */
class Post extends \yii\db\ActiveRecord
{
  // private $_oldTags; // 声明一个私有变量


  public static function tableName()
  {
    return '{{%post}}';
  }


  public function rules()
  {
    return [
      [['title', 'content', 'status'], 'required'],
      [['summary', 'content', 'username'], 'string'],
      [['userid', 'categoryid', 'status', 'created_at', 'updated_at', 'deleted_at'], 'integer'],
      [['title'], 'string', 'max' => 200],
      [['thumbnail'], 'string', 'max' => 120]
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
      'userid' => '作者ID',
      'username' => '作者',
      'categoryid' => '分类',
      'status' => '状态',
      'created_at' => '创建时间',
      'updated_at' => '更新时间',
      'deleted_at' => '删除时间',
    ];
  }


  /**
   relate.tag
    getRelate
    getTag
   *
   * @throws NotFoundHttpException
   */
  public function getViewById($id) {
    // 文章关联标签，需要把标签也给取出来
    $res = Post::find()
      -> with('relate.tag', 'postStatus')
      -> where(['id'  => $id])
      -> asArray()-> one();

    if (!$res) throw new NotFoundHttpException('文章不存在', 404);

    return $this-> _formatRelate($res);
  }

  // 处理标签格式，简洁的数据格式
  public function _formatRelate($data) {
    // echo '<pre>';
    // var_dump($data); exit();

    // $res['tags'] = ['标签1','标签2','标签3'];
    $data['tags'] = [];
    $data['pv'] = 1;

    if (isset($data['relate']) && !empty($data['relate'])) {
      foreach($data['relate'] as $item) {
        $data['tags'][] = $item['tag']['name'];
      }
    }

    if (isset($data['postStatus']) && !empty($data['postStatus'])) {
      // 要加上默认的 1
      $data['pv'] = $data['postStatus']['pv'] + 1;
    }
    unset($data['relate'], $data['postStatus']);

    return $data;
  }


  // 上一篇 下一篇
  public function getAbout($id) {

    $res = Post::find() -> where(['>', 'id', $id])-> one();
    if($res){
      $next['url'] = Url::to(['post/detail','id'=>$res->id]);
      $next['title'] = $res->title;
    }else{
      $next['url'] = '/index';
      $next['title'] = '珑文的博客';
    }

    $res = Post::find()->where(['<', 'id', $id])->orderBy('id desc')->one();
    if($res){
      $prev['url'] = Url::to(['post/detail','id'=>$res->id]);
      $prev['title'] = $res->title;
    }else{
      $prev['url'] = Url::to(['post/index']);
      $prev['title'] = '珑文的文章';
    }

    return ['prev' => $prev, 'next' => $next];
  }



  // 文章和文章状态表的关联 post.sql & post_status.sql
  public function getPostStatus() {
    return $this-> hasOne(PostStatus::className(), ['postid' => 'id']);
  }


  // 文章表和标签表的关联关系，一对多的关系
  public function getRelate()
  {
    return $this -> hasMany(PostTag ::className(), ['postid' => 'id']);
  }


  // 获取文章评论
  public function getComments()
  {
    return $this -> hasMany(Comment ::className(), ['postid' => 'id']);
  }


  // 获取文章已审核的评论
  public function getAuditComments()
  {
    return $this -> hasMany(Comment ::className(), ['postid' => 'id'])
      -> where('status = :status', [':status' => 1])
      -> orderBy('id DESC');
  }


  // 获取已审核的评论的数量
  public function getCommentCount()
  {
    return Comment ::find() -> where(['postid' => $this -> id, 'status' => 1]) -> count();
  }


  // 获取分页
  public function getPages($query, $page = 1, $pageSize = 10, $search = null)
  {
    if ($search) {
      $query = $query -> andFilerWhere($search);
    }

    $data['count'] = $query -> count();
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
    $page = (ceil($data['count'] / $pageSize) < $page) ? ceil($data['count'] / $pageSize) : $page;

    // 当前页
    $data['page'] = $page;
    // 每页显示条数，起始页，末页
    $data['pageSize'] = $pageSize;
    $data['start'] = ($page - 1) * $pageSize + 1;
    $data['end'] = (ceil($data['count'] / $pageSize) == $page) ? $data['count'] : ($page - 1) * $pageSize + $pageSize;

    $data['data'] = $query -> offset(($page - 1) * $pageSize) -> limit($pageSize) -> asArray() -> all();

    return $data;
  }


  public function getStatus0()
  {
    // className() 表名，第二个参数，关联的条件
    return $this -> hasOne(PostStatus ::className(), ['id' => 'status']);
  }


  public function getStatusArray()
  {
    return ['0' => '草稿', '1' => '已发布', '2' => '已归档'];
  }


  public function getUser()
  {
    return $this -> hasOne(User ::className(), ['id' => 'userid']);
  }


  public function getCategory()
  {
    return $this -> hasOne(Category ::className(), ['id' => 'categoryid']);
  }



  // 重写 beforeSave方法，提交数据库保存之前，先赋值
  public function beforeSave($insert)
  {
    // 调用父类的方法，保证原先的代码会执行
    if (parent ::beforeSave($insert)) {
      // 新增的时候，2个时间都赋值
      if ($insert) {
        $this -> created_at = time();
      }
      $this -> updated_at = time();
      return true;
    }

    return false;
  }



  // 获取文章后，在文章读取以后
  // 现将修改前的标签 保存到 _oldTags
  public function afterFind() {
    // TODO: Change the autogenerated stub
    // 重写方法时，都要调用父类的同名方法
    parent::afterFind();
    // $this-> _oldTags = $this-> tags;
  }

  // 文章保存后，新增标签
  public function afterSave($insert, $changedAttributes) {
    // TODO: Change the autogenerated stub
    parent::afterSave($insert, $changedAttributes);
    // Tag::updateFrequency($this-> _oldTags, $this->tags);
  }

  // 文章删除后，删除标签
  public function afterDelete() {
    parent::afterDelete(); // TODO: Change the autogenerated stub
    // 删除后更新标签，newtag为 空字符串
    // Tag::updateFrequency($this-> tags, '');
  }





  // 前台功能
  public function getUrl()
  {
    $params = ['post/detail', 'id' => $this -> id, 'title' => $this -> title];
    return Yii ::$app -> urlManager -> createUrl($params);
  }


  public function getTagLink()
  {
    $links = [];
    $tags = Tag ::string2array($this -> tags);
    foreach ($tags as $tag) {
      $links[] = Html ::a(Html ::encode($tag), ['post/index', 'PostSearch[tags]' => $tag]);
    }

    return $links;
  }


  // 截取字符串长度
  public function getBeginning($length = 288)
  {
    $str = strip_tags($this -> content);
    $temp = mb_strlen($str);
    $str = mb_substr($str, 0, $length, 'utf-8');

    return $str . (($temp > $length) ? '...' : '');
  }




  // PostForm
  // 获取文章数据
  public static function getList($where, $page=1, $pageSize=5, $orderBy=['id' => SORT_DESC]) {
    $model = new Post();
    // 查询的字段, 查询语句
    $select = ['id', 'title', 'summary', 'thumbnail', 'categoryid',
      'userid', 'status', 'created_at', 'updated_at'];

    $query = $model-> find() -> select($select)
      -> where($where)// -> with('relate.tag', 'comment')
      -> orderBy($orderBy);

    // 获取分页数据，格式化数据
    $res = $model-> getPages($query, $page, $pageSize);
    $res['data'] = self::_formatList($res['data']);

    return $res;
  }

  // 格式化数据 &$item
  private static function _formatList($data) {
    foreach($data as &$item) {
      $item['tag'] = [];
      if (isset($item['relate']) && !empty($item['relate'])) {
        foreach($item['relate'] as $tag) {
          $item['tag'][] = $tag['tag']['name'];
        }
      }

      // 遍历完成后删除格式化前的字段,关联的数据表
      unset($item['relate']);
    }

    return $data;
  }
}































