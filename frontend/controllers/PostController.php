<?php

namespace frontend\controllers;

use Yii;
use common\models\Post;
use common\models\PostStatus;
use common\models\PostSearch;

use common\models\Tag;
use common\models\Comment;
use common\models\User;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


class PostController extends Controller
{
  public $added = 0; // 0代表还没有新回复
  
  public function behaviors()
  {
    return [
      'verbs' => [
        'class' => VerbFilter ::className(),
        // 指定动作
        'actions' => [
          'delete' => ['POST'],
        ],
      ],
    ];
  }
  

  // 列表页
  public function actionIndex()
  {
    // 把标签云数组传递给视图文件
    $tags = Tag::findTags();

    // 获取评论给 列表页渲染
    $comments = Comment::findReplyComments();
    
    $searchModel = new PostSearch();
    $dataProvider = $searchModel -> search(Yii ::$app -> request -> queryParams);
    
    return $this -> render('index', [
      'searchModel' => $searchModel,
      'dataProvider' => $dataProvider,
      'tags' => $tags,
      'comments' => $comments
    ]);
  }


  protected function findModel($id)
  {
    if (($model = Post ::findOne($id)) !== null) {
      return $model;
    }
    
    throw new NotFoundHttpException('页面没有找到', 404);
  }


  public function actionDetail($id) {
    // 文章数据
    $model = new Post();
    $data = $model-> getViewById($id);
    $about = $model-> getAbout($id);

    // 文章 pv 浏览量统计，要把 id 字段，数量给带过去，pv 收藏
    $status = new PostStatus();
    $tag = $status -> upCounter(['postid' => $id],'pv', 1);

    $data['tag'] = $tag;
    $tags = Tag::findTags();

    return $this-> render('detail', [
      'model' => $data,
      'tags' => $tags,
      'prev' => $about['prev'],
      'next' => $about['next']
    ]);
  }



  // 前台只显示，文章详情，带评论功能
  public function actionDetail2($id) {
    // 1 准备数据，文章，标签，最新回复的数据
    $model = $this-> findModel($id);
    $tags = Tag::findTags();

    $replyComments = Comment::findReplyComments();
    $user = User::findOne(Yii::$app->user->id);
    // 当前会员的资料的数据
    $comment = new Comment();

    $comment -> email = $user -> email;
    $comment -> userid = $user-> id;
    
    //2 当提交评论时，处理评论
    if ($comment -> load(Yii::$app->request->post())) {
      $comment -> status = 0; // 新评论默认状态为 pending 未审核
      $comment -> postid = $id;
      if ($comment -> save()) {
        $this-> added = 1;
      }
    }
    
    // 3 传递数据给视图
    return $this -> render('detail', [
      'model' => $model,
      'tags' => $tags,
      'replyComments' => $replyComments,
      'comment' => $comment,
      'added' => $this-> added,
    ]);
  }


}
