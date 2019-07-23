<?php
/**
 * Created by PhpStorm.
 * User: lulongwen
 * Date: 2019-05-30
 * Time: 07:38
 * 
 * frontend/models/PostForm.php
 * 文章表单 model 不需要关联数据库，但需要定义 form属性 和 验证的字段
 * 定义的 from属性要和数据库的字段保持一致
 * 并不是所有的属性都关联数据库的字段
 */

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\db\Query;

use common\models\Post;
use common\models\PostTag;
use backend\models\TagForm;


use yii\web\NotFoundHttpException;

class PostForm extends Model {
  public $id;
  public $title;
  public $content;
  public $summary;
  public $thumbnail;
  public $tags;
  public $status;
  public $categoryid;
  public $_lastError = '';

  public $userid;
  public $username;

  // 定义事件，创建成功和更新后的事件
  const EV_AFTER_CREATE = 'afterCreate';
  const EV_AFTER_UPDATE = 'afterUpdate';
  const EV_ADD_TAG = 'addTag';

  // 定义场景
  const SCENARIO_CREATE = 'create';
  const SCENARIO_UPDATE = 'update';


  public function scenarios() {
    $scenarios = [
      // 场景定义了 创建修改时，可以修改的的字段
      self::SCENARIO_CREATE => ['title', 'content', 'thumbnail', 'summary', 'status', 'categoryid', 'tag'],

      // 修改时的场景，修改时可以修改哪些字段
      self::SCENARIO_UPDATE => ['id', 'title', 'content', 'thumbnail', 'summary', 'status', 'categoryid', 'tag'],
    ];

    // 合并场景，并返回
    return array_merge(parent::scenarios(), $scenarios);
  }


  // 表单验证规则，依据数据库表的设计
  public function rules() {
    return [
      [['id', 'title', 'content', 'categoryid'], 'required'],
      [['summary', 'content'], 'string'],
      [['author_id', 'category_id', 'status', 'created_at', 'updated_at'], 'integer'],
      [['title'], 'string', 'max' => 200],
      [['thumbnail'], 'string', 'max' => 120],
      [['username', 'tags'], 'string', 'max' => 80],
      /* 表的关联
      [
        ['status'],
        'exist',
        'skipOnError' => true,
        'targetClass' => Poststatus::className(),
        'targetAttribute' => ['status' => 'id']
      ],
      */
    ];
    
  }

  // 表单属性
  public function attributeLabels() {
    return [
      'id' => 'ID',
      'title' => '文章标题',
      'summary' => '文章描述',
      'content' => '文章内容',
      'thumbnail' => '缩略图',
      'userid' => '作者',
      'username' => '用户名',
      'categoryid' => '文章分类',
      'tags' => '文章标签',
      'status' => '是否发布',
    ];
  }


  // 获取文章数据
  public static function getList($where, $page=1, $pageSize=5, $orderBy=['id' => SORT_DESC]) {
    $model = new Post();
    // 查询的字段, 查询语句
    $select = ['id', 'title', 'summary', 'thumbnail', 'category_id',
    'author_id', 'username', 'status', 'created_at', 'updated_at'];

    $query = $model-> find() -> select($select)
      -> where($where) -> with('relate.tag', 'comment')
      -> orderBy($orderBy);

    // 获取分页数据，格式化数据
    $res = $model-> getPages($query, $page, $pageSize);
    $res['data'] = self::_formatList($res['data']);

    return $res;
  }


  // 通过 id 获取文章详情，文章关联标签，需要把标签给取出来
  public function getDetail($id) {
    // Post::find() -> where(['id' => $id]) -> asArray() -> one();
    $res = Post::find()
      -> with('relate.tag', 'comment')
      -> where(['id' => $id]) -> asArray() -> one();

    // 如果没有找到数据 404，针对随便输入 id的问题
    if (!$res) throw new NotFoundHttpException('文章不存在', 404);

    echo '<pre>';
    print_r($res); exit(0);

    // 处理标签格式
    $res['tags'] = [];
    if (isset($res['relate']) && !empty($res['relate'])) {
      foreach($res['relate'] as $list) {
        $res['tags'][] = $list['tag']['name'];
      }
    }

    if (isset($res['comment'])) {
      foreach($res['comment'] as $key=> $val) {
        if ($key === 'pv') $res['pv'] = $val;
      }
    }

    unset($res['relate']);
    return $res;
  }


  // 创建文章，涉及到多表操作，文章表，标签表，状态表
  public function create() {
    // 多表操作，用事务处理，让数据保持完整
    $transaction = Yii::$app-> db-> beginTransaction();

    try {
      // 所有的数据处理，都放在 models里面，逻辑处理放在 Form里面
      $model = new Post();
      // 把数据设置到 new Post里面，$model是数据库的字段
      $model -> setAttributes($this-> attributes);

      // 字段不能满足数据库的要求，要自定义字段
      // $model-> summary =  $this-> _getSummary(); // 如果没有描述，截取前120个字符
      $model-> userid = Yii::$app-> user-> identity-> id;
      $model-> username = Yii::$app-> user-> identity-> username;
      // $model-> created_at = time();
      // $model-> updated_at = time();

      if (!$model-> save()) throw new \Exception('文章保存失败'. $model-> getErrors());

      // 创建成功，要用 id跳转到对应的页面
      $this-> id = $model-> id;

      // 调用事件的数据，比如，保存文章后添加积分，事件要有一个参数去实现
      $data = array_merge($this-> getAttributes(), $model-> getAttributes());
      // 调用事件，文章创建完成后去做的很多事情，观察者模式去实现事件
      $this-> _evAfterCreate($data);

      $transaction -> commit();
      return true;
    }
    catch( \Exception $err) {
      // 失败就回滚
      $transaction -> rollBack();
      $this-> _lastError = $err-> getMessage();
      return null;
    }
  }

  // 创建完成后执行的事件，比如，用户发布文章添加积分
  private function _evAfterCreate($data) {
    // 添加事件，需要调用的方法
    // _eventAddTag 事件注册到 EVENT_AFTER_CREATE  类，  对应的方法名          数据
    // $this-> on(self::EV_AFTER_CREATE, [$this, self::EV_ADD_TAG], $data);
    $this-> on(self::EV_AFTER_CREATE, [$this, '_evAddTag'], $data);
    
    // 第二个事件，可以添加多个事件
    // $this-> on(self::EVENT_AFTER_CREATE,[$this, self::EV_ADD_TWO], $data);

    // 触发事件, off 取消事件
    $this-> trigger(self::EV_AFTER_CREATE);
  }


  // 添加标签
  public function _evAddTag($event) {
    // print_r($event-> data);
    // 保存标签
    $tag = new TagForm();
    // 调用传参数的字段 tags
    $tag -> tag = $event -> data['tags'];
    $tagid = $tag-> saveTag();

    // 删除原来的关联关系，用在修改时
    PostTag::deleteAll(['postid' => $event-> data['id']]);

    // 批量保存文章和标签的关联关系，如果没有关联 return
    if (!empty($tagid)) {
      foreach($tagid as $key => $val) {
        $row[$key]['postid'] = $this-> id;
        $row[$key]['tagid'] = $val;
      }
      // 批量保存
      $res = (new Query()) -> createCommand()
        -> batchInsert(PostTag::tableName(), ['postid', 'tagid'], $row)
        -> execute();

      if (!$res) die('保存关联标签失败');
    }
  }


  // 如果没有描述，就截取文章作为描述
  private function _getSummary($start=0, $end=120, $charset='utf-8') {
    if (empty($this->content)) return null;
    // 去除空格，过滤 html标签
    $str = str_replace(' ', '', strip_tags($this-> content));

    return mb_substr($str, $start, $end, $charset);
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