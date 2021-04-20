<?php

namespace app\controllers;

use Yii;
use app\models\Producto;
use app\models\ProductoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Modelo;
use app\models\Departamento;
use app\models\User;
use yii\filters\AccessControl;
use app\models\ModeloRelacionado;

/**
 * ProductoController implements the CRUD actions for Producto model.
 */
class ProductoController extends Controller
{
    /**
     * @inheritdoc
     */
     public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index','create','update','delete','habilitar2','habilitar'],
                'rules' => [
                   

                    [
                        'actions' => ['index','habilitar'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                        $valid_roles = ['Administrador'];
                            return User::roleInArray($valid_roles);
                    }
                    ],
                    
                    [
                        'actions' => ['create','update','delete','habilitar2'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                        $valid_roles = ['Administrador','Jefe Departamento'];
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
     * Lists all Producto models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Producto model.
     * @param integer $id
     * @return mixed
     */
    public function actionProducto($id_modelo)
    {
        
        $modelo = Modelo::find()->where(['id_modelo'=>$id_modelo])->one();        
        $relaciones = ModeloRelacionado::find()->where(['id_modelo'=>$id_modelo])->all();
        $modelosRel = array();
        foreach ($relaciones as $rel) {
            $modelosRel[] = Modelo::find()->where(['id_modelo'=>$rel->id_modelo_relacionado])->one();;            
        }
        $ultimosModelos = Modelo::find()->where(['id_departamento'=>$modelo->id_departamento])->orderBy('id_modelo DESC')->all();
        $i = 0;
        return $this->render('producto', ['modelo'=>$modelo, 'i' => $i, 'modelosRel'=>$modelosRel, 'ultimosModelos' => $ultimosModelos]);
    }
    
    
    
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Producto model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Producto();
        $model->id_estado=1;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_producto]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Producto model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_producto]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Producto model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
     public function actionHabilitar($id)
    {

        $model = $this->findModel($id);

       
        if($model->id_estado=='2'){
            $model->id_estado='1';
            $model->save() ;
        }
        elseif ($model->id_estado=='1') {
             $model->id_estado='2';
             $model->save();

                    }

        return $this->redirect(['index']);
        
    }
    
     public function actionHabilitar2($id)
    {

        $model = $this->findModel($id);

       
        if($model->id_estado=='2'){
            $model->id_estado='1';
            $model->save();
        }
        elseif ($model->id_estado=='1') {
             $model->id_estado='2';
            $model->save();

                    }

        return $this->redirect(['modelo/index']);
        
    }

    /**
     * Finds the Producto model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Producto the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Producto::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
