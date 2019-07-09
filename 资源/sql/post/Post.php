<?php

namespace common\models;

use Yii;
use yii\helpers\Html;

/**
 * This is the model class for table "post". 数据库表的字段
 *
 * @property int $id
 * @property string $title
 * @property string $content
 * @property string $tags 标签云
 * @property int $status
 * @property int $create_time 创建时间
 * @property int $update_time 修改时间
 * @property int $author_id
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * {@inheritdoc}
     * 依据数据库表的结构来生成的
     */
    public function rules()
    {
        return [
            [['title', 'content', 'status', 'author_id'], 'required'],
            [['content', 'tags'], 'string'],
            [['status', 'create_time', 'update_time', 'author_id'], 'integer'],
            [['title'], 'string', 'max' => 128],
        ];
    }

    /**
     * {@inheritdoc}
     */
    /*public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'content' => 'Content',
            'tags' => 'Tags',
            'status' => 'Status',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
            'author_id' => 'Author ID',
        ];
    }*/
	
		public function attributeLabels() {
			return [
				'id' => 'ID',
				'title' => '标题',
				'content' => '内容',
				'tags' => '标签',
				'status' => '状态',
				'create_time' => '创建时间',
				'update_time' => '修改时间',
				'author_id' => '作者',
			];
		}
    
    // 获取作者
    public function getAuthor() {
      return $this->hasOne(Adminuser::className(), ['id' => 'author_id']);
    }
    
    // 获取 url
    public function getUrl() {
      return Yii::$app->urlManager->createUrl([
        'post/detail',
        'id' => $this->id,
        'title' => $this->title // 生成页面的标题
      ]);
    }
    
    // 获取内容，默认 288个字符
    public function getBeginning($length=288) {
      $tmpStr = strip_tags($this->content);
      $tmpLen = mb_strlen($tmpStr);
      
      $tmpStr = mb_substr($tmpStr, 0, $length, 'utf-8');
      return $tmpStr.(($tmpLen>$length) ? '...' : '');
    }
    
    // 获取标签页
  	public function getTagLinks() {
    	$links = array();
    	foreach(Tag::string2array($this->tags) as $tag) {
    		$links[] = Html::a(Html::encode($tag), array('post/index', 'PostSearch[tags]' => $tag));
			}
    	return $links;
		}
		
		//
		public function getCommentCount() {
    	return Comment::find()->where(['post_id' => $this->id, 'status' => 2])-> count();
		}
}


















