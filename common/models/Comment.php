<?php

  namespace common\models;

  use Yii;

  /**
   * This is the model class for table "{{%comment}}".
   *
   * @property int $id         评论自增 id
   * @property string $content 评论内容
   * @property int $userid     用户 id
   * @property string $email   邮箱
   * @property string $url     评论链接
   * @property int $postid     文章 id
   * @property int $remind     0 未提醒，1 已提醒
   * @property int $status     评论状态，0-未审核，1-已审核
   * @property int $created_at 评论创建日期
   * @property int $updated_at 修改日期
   * @property int $deleted_at 删除时间
   */
  class Comment extends \yii\db\ActiveRecord
  {
    // public $statusArray = ['0' => '未审核', '1' => '已审核'];

    public static function tableName() {
      return '{{%comment}}';
    }


    public function rules() {
      return [
        [['content'], 'required'],
        [['content'], 'string'],
        [['userid', 'postid', 'remind', 'status', 'created_at', 'updated_at', 'deleted_at'], 'integer'],
        [['email'], 'string', 'max' => 80],
        [['url'], 'string', 'max' => 120],
      ];
    }


    public function attributeLabels() {
      return [
        'id' => '评论id',
        'content' => '评论内容',
        'userid' => '用户id',
        'email' => '邮箱',
        'url' => '评论链接',
        'postid' => '文章',
        'remind' => '是否提醒', // 0 未提醒，1 已提醒
        'status' => '评论状态', // 0-未审核，1-已审核
        'created_at' => '创建日期',
        'updated_at' => '修改日期',
        'deleted_at' => '删除时间',
      ];
    }


    // beforeSave 自动设置时间
    public function beforeSave($insert) {
      // TODO: Change the autogenerated stub

      if (parent::beforeSave($insert)) {
        if ($insert) {
          $this->created_at = time();
        }
        $this-> updated_at = time();

        return true;
      };

      return false;
    }


    // 评论状态
    public static function getStatusArr() {
      return ['0' => '未审核', '1' => '已审核'];
    }
    // 评论状态，字符串
    public static function getStatusStr($status) {
      // var_dump(self::getStatusArr(), $status);
      return self::getStatusArr()[$status];
    }


    // 提醒状态
    public static function getRemindArr() {
      return ['0' => '未提醒', '1' => '已提醒'];
    }
    // 提醒状态，字符串
    public static function getRemindStr($status) {
      return self::getRemindArr()[$status];
    }




    // 关联文章
    public function getPost() {
      return $this->hasOne(Post::className(), ['id' => 'postid']);
    }


    // 关联用户
    public function getUser() {
      return $this-> hasOne(User::className(), ['id' => 'userid']);
    }


    // 截取字符串长度
    public function getBeginning($length = 20)
    {
      //去除 html标签
      $str = strip_tags($this -> content);
      $temp = mb_strlen($str);
      $str = mb_substr($str, 0, $length, 'utf-8');

      return $str . (($temp > $length) ? '...' : '');
    }


    // 设置评论状态为已审核
    public function approve() {
      $this-> status = 1;
      return $this->save() ? true : false;
    }

    // 查看有多少条待审核评论
    public static function getPendingCommentCount() {
      return Comment::find() -> where(['status' => 0]) -> count();
    }
    
    
    // 获取评论
    public static function findReplyComments($limit=10) {
      return Comment::find() ->where(['status' => 1])
        -> orderBy('created_at DESC')-> limit($limit) -> all();
    }

  }



















