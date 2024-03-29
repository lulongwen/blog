<?php
namespace frontend\widgets\hot;
/**
 * 热门浏览组件
 */
use Yii;
use common\models\Post;
use common\models\PostStatus;

use yii\base\Widget;
use yii\helpers\Url;
use yii\db\Query;

class HotWidget extends Widget {
    public $title = '热门浏览'; // 文章列表的标题
    public $limit = 10; // 显示条数
    
    public function run() {
      // a Comment，b Post
      $res = (new Query())
        ->select('a.pv, b.id, b.title')
        // 查询那张表
        ->from(['a'=>PostStatus::tableName()])
        // 左链接， where 条件 orderBy 排序 浏览量并且 id，防止重复
        ->join('LEFT JOIN',['b'=> Post::tableName()],'a.postid = b.id')
        ->where('b.status = 1')
        ->orderBy('pv DESC, id DESC')
        ->limit($this->limit)
        ->all();
      
        $data['title'] = $this->title;
        $data['body'] = $res ?: [];
        // $data['more'] = Url::to(['post/index','sort'=>'hot']);
        
        return $this->render('hot',['data'=> $data]);
    }
}