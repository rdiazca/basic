<?php

namespace app\controllers;

use Yii;
use app\models\Departamento;
use app\models\DepartamentoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \app\models\Modelo;
use app\models\Reserva;
use app\models\Producto;
use yii\filters\AccessControl;
use app\models\User;

/**
 * DepartamentoController implements the CRUD actions for Departamento model.
 */
class DepartamentoController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index','carrito','create','update','delete','habilitar'],
                'rules' => [
                   

                    [
                        'actions' => ['carrito'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                        $valid_roles = ['Comprador'];
                            return User::roleInArray($valid_roles);
                    }
                    ],
                     [
                        'actions' => ['index','create','update','delete','habilitar'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                        $valid_roles = ['Administrador'];
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
     * Lists all Departamento models.
     * @return mixed
     */
     public function actionProductos($id_departamento)
    {
         $dep= Departamento::find()->where(['id_departamento'=>$id_departamento])->one();
         $nombre=$dep->nombre_departamento;
         $modelos= Modelo::find()->where(['id_departamento'=>$id_departamento])->all();
         $ultimosModelos = Modelo::find()->where(['id_departamento'=>$id_departamento])->orderBy('id_modelo DESC')->all();
        return $this->render('product_list', ['modelos'=>$modelos,'nombre'=>$nombre, 'ultimosModelos'=>$ultimosModelos]);
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
            $model->save();

                    }

        return $this->redirect(['index']);
        
    }
    
    
    
    public function actionIndex()
    {
        $searchModel = new DepartamentoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Departamento model.
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
     * Creates a new Departamento model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
        
   public function actionCarrito($id_modelo)
    {
       $reserva = new Reserva();       
       $prod= Producto::find()->where(['id_modelo'=>$id_modelo])->andWhere(['id_estado'=>1])->one();
       if($prod!=null){
       Producto::updateAll(['id_estado'=>3], ['id_producto'=>$prod->id_producto]);
       $reserva->id_producto=$prod->id_producto;
       $reserva->id_estado=3;
       $reserva->id_usuario= Yii::$app->user->identity->id_usuario;
       $reserva->fecha = date('Y-n-j');

        $reserva->save();
        }
        $m= Modelo::find()->where(['id_modelo'=>$id_modelo])->one();
        return $this->actionProductos($m->id_departamento);
        
        }
    
    public function actionCreate()
    {
        $model = new Departamento();
        $model->id_estado=1;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //para subir el icono del Departamento
            $imgName=$model->id_departamento;
            $model->file=  \yii\web\UploadedFile::getInstance($model, 'file');
            $model->file->saveAs('uploads/depImg/departamento'.$imgName.'.'.$model->file->extension);
            
            //guardarlo en db
            $model->icono='uploads/depImg/departamento'.$imgName.'.'.$model->file->extension;
            $model->save();  
            return $this->redirect(['view', 'id' => $model->id_departamento]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Departamento model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //para subir el icono del Departamento
            $imgName=$model->id_departamento;
            $model->file=  \yii\web\UploadedFile::getInstance($model, 'file');
            $model->file->saveAs('uploads/depImg/departamento'.$imgName.'.'.$model->file->extension);
            
            //guardarlo en db
            $model->icono='uploads/depImg/departamento'.$imgName.'.'.$model->file->extension;
            $model->save(); 
            return $this->redirect(['view', 'id' => $model->id_departamento]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Departamento model.
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
     * Finds the Departamento model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Departamento the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Departamento::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
