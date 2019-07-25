<?php

namespace backend\controllers;

use Yii;
use common\models\Post;
use common\models\PostSearch;
use common\models\Category;
use common\models\Comment;

use backend\models\PostForm;

use yii\web\Controller;
use yii\web\NotFoundHttpException; // 404
use yii\web\ForbiddenHttpException; // 403 异常类

use yii\filters\VerbFilter;
use yii\filters\AccessControl;



class PostController extends Controller
{
  // 行为过滤，比如，不能录不能发布文章
  public function behaviors()
  {
    return [
      'access' => [
        'class' => AccessControl::className(),
        'only' => ['index', 'create', 'upload'],
        'rules' => [
          [
            'actions' => ['index'], // 登录或不登录都可以访问
            'allow' => true,
            'roles' => ['?'], // ? 所有人都可以看到
          ],
          [
            'actions' => ['index', 'view', 'create', 'update', 'delete', 'upload'],
            'allow' => true,
            'roles' => ['@'],
          ],
        ],
      ],

      'verbs' => [
        'class' => VerbFilter ::className(),
        'actions' => [
          'delete' => ['POST'],
          // '*', ['get', 'post'], // 所有方法 get post 都能访问
          // 'create' => ['get', 'post'],
        ],
      ],
    ];
  }


  // actions 等同于 actionUpload
  public function actions()
  {
    return [
      'upload' => [
        // 这里扩展地址别写错
        'class' => 'common\widgets\file_upload\UploadAction',
        'config' => [
          'imagePathFormat' => "/images/{yyyy}{mm}{dd}/{time}{rand:6}",
        ]
      ],
  
      'ueditor'=>[
        'class' => 'common\widgets\ueditor\UeditorAction',
        'config'=>[
          //上传图片配置, 图片访问路径前缀
          'imageUrlPrefix' => "",
          //  上传保存路径,可以自定义保存路径和文件名格式
          'imagePathFormat' => "/image/{yyyy}{mm}{dd}/{time}{rand:6}",
        ]
      ]
    ];
  }

  
  public function actionIndex()
  {
    // 查询所有文章
    // $model = Post::find()->asArray()-> all();

    $searchModel = new PostSearch();
    $dataProvider = $searchModel -> search(Yii ::$app -> request -> queryParams);
    
    return $this -> render('index', [
      'searchModel' => $searchModel,
      'dataProvider' => $dataProvider,
    ]);
  }


  // 查看文章
  public function actionView($id) {

    // $model = new Post();
    // $data = $model-> getViewById($id);
    // echo '<pre>';
    // var_dump($id, $data); exit();

    $model = $this-> findModel($id);
    return $this -> render('view', ['model' => $model ]);
  }


  // 创建文章
  public function actionCreate() {
    // 权限检查
    if (!Yii::$app-> user-> can('createPost')) {
      throw new ForbiddenHttpException('您没有该操作的权限，请联系管理员');
    }

    $model = new PostForm();
    // 定义场景
    $model-> setScenario(PostForm::SCENARIO_CREATE);

    if ($model-> load(Yii::$app-> request-> post()) && $model-> validate()) {
      if (!$model-> create()) {
        return Yii::$app-> session-> setFlash('warning', $model-> _lastError);
      }

      // 创建成功跳转到预览
      return $this-> redirect(['post/view', 'id' => $model-> id]);
    }

    // 获取所有的分类
    $cate = Category::getAll();
    return $this->render('create', ['model' => $model, 'cate' => $cate]);
  }

  
  // 修改文章
  public function actionUpdate($id)
  {
    if (!Yii::$app-> user-> can('updatePost')) {
      throw new ForbiddenHttpException('您没有该操作的权限，请联系管理员');
    }

    $model = $this -> findModel($id);
    // 更新时，把更新时间设置为当前时间，当执行 save时，保存的就是当前时间
    // 业务逻辑尽量避免放在控制器中间，应该放在模型文件中 Model
    // $model-> updated_at = time();

    if ($model -> load(Yii ::$app -> request -> post()) && $model -> save()) {
      // echo '<pre>';
      // var_dump($model); exit();
      return $this -> redirect(['view', 'id' => $model -> id]);
    }


    return $this -> render('update', [
      'model' => $model,
    ]);
  }


  // 删除文章
  public function actionDelete($id)
  {
    if (!Yii::$app-> user-> can('deletePost')) {
      throw new ForbiddenHttpException('您没有该操作的权限，请联系管理员');
    }
    
    $this -> findModel($id) -> delete();
    return $this -> redirect(['index']);
  }
  
  /**
   * Finds the Post model based on its primary key value.
   * If the model is not found, a 404 HTTP exception will be thrown.
   * @param integer $id
   * @return Post the loaded model
   * @throws NotFoundHttpException if the model cannot be found
   */
  protected function findModel($id)
  {
    if (($model = Post ::findOne($id)) !== null) {
      return $model;
    }
    
    throw new NotFoundHttpException('请求的页面不存在', 404);
  }
}
