<?php
namespace frontend\widgets\hot;
/**
 * 热门浏览组件
 */
use Yii;
use common\models\CommentModel;
use common\models\PostModel;

use yii\base\Widget;
use yii\helpers\Url;
use yii\db\Query;

class HotWidget extends Widget {
    public $title = '热门浏览'; // 文章列表的标题
    public $limit = 8; // 显示条数
    
    public function run() {
      // a CommentModel，b PostModel
      $res = (new Query())
        ->select('a.pv, b.id, b.title')
        ->from(['a'=>CommentModel::tableName()])
          // 左链接， where 条件 orderBy 排序 浏览量并且 id，防止重复
        ->join('LEFT JOIN',['b'=> PostModel::tableName()],'a.post_id = b.id')
        ->where('b.status = 1')
        ->orderBy('pv DESC, id DESC')
        ->limit($this->limit)
        ->all();
        
        // $data['title'] = $this->title?: '热门浏览';
        $data['title'] = $this->title;
        $data['body'] = $res?:[];
        // $data['more'] = Url::to(['post/index','sort'=>'hot']);
        
        return $this->render('index',['data'=> $data]);
    }
}