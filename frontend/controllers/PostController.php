<?php

namespace frontend\controllers;

use Yii;
use common\models\Post;
use common\models\PostSearch;
use common\models\Tag;
use common\models\Comment;
use common\models\User;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PostController implements the CRUD actions for Post model.
 */
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
  

  //
  public function actionView($id)
  {
    return $this -> render('view', [
      'model' => $this -> findModel($id),
    ]);
  }
  

  // 创建文章
  /*public function actionCreate()
  {
    $model = new Post();
    
    if ($model -> load(Yii ::$app -> request -> post()) && $model -> save()) {
      return $this -> redirect(['view', 'id' => $model -> id]);
    }
    
    return $this -> render('create', [
      'model' => $model,
    ]);
  }*/
  


  // 修改文章
  /*public function actionUpdate($id)
  {
    $model = $this -> findModel($id);
    
    if ($model -> load(Yii ::$app -> request -> post()) && $model -> save()) {
      return $this -> redirect(['view', 'id' => $model -> id]);
    }
    
    return $this -> render('update', [
      'model' => $model,
    ]);
  }*/
  


  // 删除文章，删除成功，跳转到首页
  /*public function actionDelete($id)
  {
    $this -> findModel($id) -> delete();
    
    return $this -> redirect(['index']);
  }*/
  

  protected function findModel($id)
  {
    if (($model = Post ::findOne($id)) !== null) {
      return $model;
    }
    
    throw new NotFoundHttpException('The requested page does not exist.');
  }
  

  // $model = new Post();
  // $data = $model-> getDetailId($id);
  //
  // //文章 pv 统计，要把 id 字段，数量给带过去
  // $model = new CommentModel();
  // $model-> getCounter(['post_id' => $id],  'pv', 1);
  //
  // // print_r($data); exit();
  // return $this->render('detail', ['data' => $data]);
  
  // 文章详情
  public function actionDetail($id) {
    // 1 准备数据，文章，标签，最新回复的数据
    $model = $this-> findModel($id);
    $tags = Tag::findTags();
    $replyComments = Comment::findReplyComments();

    $user = User::findOne(Yii::$app->user->id);
    // 当前会员的资料的数据
    $comment = new Comment();

    // echo '<pre>';
    // var_dump($user); exit(0);

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
