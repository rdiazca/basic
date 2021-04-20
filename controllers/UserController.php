<?php

namespace app\controllers;

use Yii;
use app\models\User;
use app\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index'],
                'rules' => [
                   

                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
                        
                        'matchCallback' => function ($rule, $action) {
                        $valid_roles = ['Administrador','Administrador Sistema'];
                            return User::roleInArray($valid_roles);
                    }
                    ],

                    
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
     public function actionHabilitar($id)
    {

        $model = $this->findModel($id);
        if($model->id_estado=='2'){
            $model->id_estado='1';
            $model->save();
        }
        elseif ($model->id_estado=='1') {
            
            $model->id_estado='2';
            var_dump($model->save());
            

                    }

        return $this->redirect(['index']);
        
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();
        $model->id_estado=1; 
        $model->monto = rand(100, 10000);
        
        $asignacion = new \app\models\AuthAssignment();
             
        if ($model->load(Yii::$app->request->post()) && $model->save() ) {
        $asignacion->item_name = "Comprador";
        $asignacion->user_id=$model->id_usuario;
        $model->password = sha1($model->password);
        User::updateAll(['password'=>$model->password], ['id_usuario'=>$model->id_usuario]);
        $asignacion->save();
        return $this->redirect(['site/login']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->password = sha1($model->password);
           User::updateAll(['password'=>$model->password], ['id_usuario'=>$model->id_usuario]);
            return $this->redirect(['view', 'id' => $model->id_usuario]);
        } else {
             $model->password = "";
            return $this->render('update', [
               
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
     public function actionRolToUser(){
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        $user = new User();
        $rol_user=new \app\models\AuthAssignment();
        
        if(isset($_POST['User']) && isset($_POST['AuthItem'])){
            $user->username=$_POST['User']['username'];
            $user->password=$_POST['User']['password'];
            $user->save();
            $rol_user->item_name=$_POST['AuthItem']['name'];
            $rol_user->user_id=$user->id_user;
            $rol_user->save();
        }
        
    }
}
