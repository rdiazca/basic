<?php

namespace app\controllers;

use Yii;
use app\models\Modelo;
use app\models\ModeloSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\User;
use yii\filters\AccessControl;


/**
 * ModeloController implements the CRUD actions for Modelo model.
 */
class ModeloController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
                   'access' => [
                'class' => AccessControl::className(),
                'only' => ['index','create','update','delete'],
                'rules' => [
                   

                    [
                        'actions' => ['index','create','update','delete'],
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
     * Lists all Modelo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ModeloSearch();
        $idusuario = Yii::$app->user->id;
        $rol = Yii::$app->user->identity->getRol();
        
        if($rol == "Administrador"){
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        }
        else if($rol == "Jefe Departamento"){
//        $departamento = Departamento::find()->where(['id_jefe'=>Yii::$app->user->id])->one();
        $dataProvider = $searchModel->search2($idusuario);      
        }
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Modelo model.
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
     * Creates a new Modelo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Modelo();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $imgName=$model->id_modelo;
            $model->file=  \yii\web\UploadedFile::getInstance($model, 'file');
            $model->file->saveAs('uploads/modeloImg/modelo'.$imgName.'.'.$model->file->extension);
            
            //guardarlo en db
            $model->imagen='uploads/modeloImg/modelo'.$imgName.'.'.$model->file->extension;
            $model->save();
            if($model->id_modeloRel1 != NULL){
               $modeloRel1 = new \app\models\ModeloRelacionado();
               $modeloRel1->id_modelo = $model->id_modelo;
               $modeloRel1->id_modelo_relacionado = $model->id_modeloRel1;
               $modeloRel1->save();
            }
            if($model->id_modeloRel2 != NULL){
               $modeloRel2 = new \app\models\ModeloRelacionado();
               $modeloRel2->id_modelo = $model->id_modelo;
               $modeloRel2->id_modelo_relacionado = $model->id_modeloRel2;
               $modeloRel2->save();
            }
            if($model->id_modeloRel3 != NULL){
               $modeloRel3 = new \app\models\ModeloRelacionado();
               $modeloRel3->id_modelo = $model->id_modelo;
               $modeloRel3->id_modelo_relacionado = $model->id_modeloRel3;
               $modeloRel3->save();
            }
           if($model->id_modeloRel4 != NULL){
               $modeloRel4 = new \app\models\ModeloRelacionado();
               $modeloRel4->id_modelo = $model->id_modelo;
               $modeloRel4->id_modelo_relacionado = $model->id_modeloRel4;
               $modeloRel4->save();
            }
            return $this->redirect(['view', 'id' => $model->id_modelo]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Modelo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            
            $imgName=$model->id_modelo;
            $model->file=  \yii\web\UploadedFile::getInstance($model, 'file');
            $model->file->saveAs('uploads/modeloImg/modelo'.$imgName.'.'.$model->file->extension);
            
            //guardarlo en db
            $model->imagen='uploads/modeloImg/modelo'.$imgName.'.'.$model->file->extension;
            $model->save();
            return $this->redirect(['view', 'id' => $model->id_modelo]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Modelo model.
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
     * Finds the Modelo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Modelo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Modelo::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
