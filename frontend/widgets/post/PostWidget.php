<?php
  /**
   * Created by PhpStorm.
   * User: lulongwen
   * Date: 2019-06-03
   * Time: 21:28
   */
  namespace frontend\widgets\post;

  use Yii;
  use yii\bootstrap\Widget;
  use yii\data\Pagination;

  use common\models\Post;
  use yii\helpers\Url;

  class PostWidget extends Widget {
    public $title = '最新文章';
    public $limit = 6; // 显示条数
    public $more = true; // 是否显示更多
    public $page = true; // 是否分页
    
    
    public function run() {
      // 查询条件, status=1 已发布
      $query = ['=', 'status', 1];
      $page = Yii::$app-> request->get('page', 1);
      $res = Post::getList($query, $page, $this->limit);
      
      $data['title'] = $this-> title;
      $data['body'] = $res['data'] ?: [];
      $data['more'] = Url::to(['post/index']);
      
      // 是否显示分页
      if ($this-> page) {
        $pages = new Pagination([
          'totalCount' => $res['count'],
          'pageSize' => $res['page']
        ]);
        $data['page'] = $pages;
      }

      return $this-> render('index', ['data' => $data]);
    }
  }
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  