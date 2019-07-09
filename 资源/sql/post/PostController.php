<?php
  // post.sql 文章控制器
  namespace frontend\controllers;
  
  use Yii;
  use common\models\Post;
  use common\models\PostSearch;
  
  use yii\web\Controller;
  use yii\web\NotFoundHttpException;
  use yii\filters\VerbFilter;
  
  use common\models\Tag;
  use common\models\Comment;
  use common\models\User;
  
  /**
   * PostController implements the CRUD actions for Post model.
   */
  class PostController extends Controller {
    // added=0 表示没有新的评论
    public $added = 0;

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
      return [
        'verbs' => [
          'class'   => VerbFilter::className(),
          'actions' => ['delete' => ['POST'],],
        ],
      ];
    }
    
    /**
     * Lists all Post models.
     * @return mixed
     */
    public function actionIndex() {
      return $this->render('index', []);
      
      // 查找标签云
      $tags = Tag::findTagWeights();
      $recentComments = Comment::findRecentComments();
      
      $searchModel = new PostSearch();
      $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
      
      return $this->render('index', [
        'searchModel'    => $searchModel,
        'dataProvider'   => $dataProvider,
        'tags'           => $tags,
        'recentComments' => $recentComments,
      ]);
    }
    
    
    // 创建文章
    public function actionCreate() {
      $model = new Post();
      return $this->render('create', ['model' => $model]);
    }
    
    
    // 修改文章
    public function actionUpdate() {
    
    }
    
    
    // 前台文章详情
    public function actionDetail($id) {
      // 1 准备数据模型
      $model = $this->findModel($id);
      $tags = Tag::findTagWeights();
      $recentComments = Comment::findRecentComments();
      
      // 当前会员
      $user = User::findOne(Yii::$app->user->id);
      // 新建一个评论
      $commentModel = new Comment(); 
      $commentModel->email = $user->emial;
      $commentModel->user_id = $user->id;
      
      // 2 当评论提交时，处理评论
      if ($commentModel->load(Yii::$app->request->post())) {
        $commentModel -> status = 1; // 新评论默认为1 ，pending 待审核
        $commentModel -> post_id = $id;
        
        if ($commentModel -> save()) {
          $this -> added = 1;
        }
      }
      
      
      // 3 传递数据给视图渲染
      return $this->render('detail', [
        'model'          => $model,
        'tags'           => $tags,
        'recentComments' => $recentComments,
        'commentModel'   => $commentModel,
        'added' => $this -> added,
      ]);
    }


    public function actionDelete($id, $status, $author_id) {
      $this->findModel($id, $status, $author_id)->delete();
      
      return $this->redirect(['index']);
    }


    protected function findModel($id) {
      if (($model = Post::findOne($id)) !== null) {
        return $model;
      } else {
        throw new NotFoundHttpException('The requested page does not exist.');
      }
    }
    
    
  }
