<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\RegistroUser;
use app\models\User;
use \app\models\Reserva;
use \app\models\Producto;
use mPDF;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
           
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout','registrar','carrito','mejores'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['registrar'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                        $valid_roles = ['Administrador Sistema'];
                            return User::roleInArray($valid_roles);
                    }
                    ],
                            
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
                        'actions' => ['mejores'],
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
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
   
     public function actionSendBroadcastEmail() // esta action envia el correo
    {
        $model = new ContactForm();
        $users = User::findAll(['enabled' => 1]);
        if ($model->load(Yii::$app->request->post()) && $model->sendBroadcastEmail($users)) {
            Yii::$app->session->setFlash('contactFormSubmitted');
            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }
    
 public function actionIndex() 
    { 
        $cant=array();
        $cincoMayores=array();
        $cincoMasVendidos=array();
        $cantDesc=array();
        $vendido;
        $aux=0;
        $cantAux;
        $masVendidos=array();
        $vendidos=\app\models\Producto::find()->where(['id_estado'=>'4'])->all();
        for ($i=0; $i <count($vendidos) ; $i++) {     
        $vendido=$vendidos[$i];
        
        
        
      if (!in_array($vendido->id_modelo, $masVendidos)) {
            $cantAux=0; 
        
            for ($j=$i; $j < count($vendidos); $j++) { 
                if ($vendido->id_modelo==$vendidos[$j]->id_modelo) {
                $cantAux=$cantAux+1;
            }               
            }
            array_push($cant, $cantAux);
            array_push($masVendidos, $vendido->id_modelo); 
          }        
        }

        for ($d=0; $d < count($cant); $d++) { 
            array_push($cantDesc, $cant[$d]);            
        }
        rsort ($cantDesc);

        for($a=0;$a<count($cantDesc)&&$aux <5;$a++){
        array_push($cincoMayores , $cantDesc[$a]);
        $aux++;
        }


         for($b=0;$b<count($cincoMayores);$b++){
           $insertado=false;
            for($c=0; $c <count ($cant) &&!$insertado; $c++){
                if($cincoMayores[$b]==$cant[$c]){
                if(!in_array($masVendidos[$c], $cincoMasVendidos)){ 

          array_push($cincoMasVendidos , $masVendidos[$c]);
          $insertado=true;
         }
             
       }}}
       
       $ultimosModelos = \app\models\Modelo::find()->orderBy('id_modelo DESC')->all();


        return $this->render('index',['cincoMasVendidos'=>$cincoMasVendidos, 'ultimosModelos'=>$ultimosModelos]);
    }



    /**
     * Login action.
     *
     * @return Response|string
     */ 
    public function actionCarrito()
    {
         $userActivo= Yii::$app->user;
        
        return $this->render('carrito',
                [
                    'user'=>$userActivo
                    ]);
    }
    
     public function actionEliminar($id_producto)
    {
         
         Reserva::deleteAll(['id_producto'=>$id_producto]);
         Producto::updateAll(['id_estado'=>1],['id_producto'=>$id_producto]);
         $userActivo= Yii::$app->user;
        
        return $this->render('carrito',
                [
                    'user'=>$userActivo
                    ]);
    }
    
    
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
            
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }
   public function actionRegistrar()
    {
        $model = new RegistroUser();
        
        
        if ($model->load(Yii::$app->request->post())) {
           
                
            if ($user = $model->registrar()) {               
                    return $this->goHome();                
            }
        }
        return $this->render('registrar', [
            'model' => $model, 
        ]);
    }
    
        public function actionReservar($total)
    {
            $content = $this->renderPartial('factura');
         
        $yii2mpdf = new mPDF();
        $yii2mpdf->WriteHTML($content);
        $yii2mpdf->Output();
        return $this->renderPartial('yii2mpdf');
    }
    /**
     * Logout action.
     *
     * @return Response
     */
    
        public function actionMejores() 
    {  $mejoresUsuarios=array();
       $cantCompras=array();
       $compra;
       $cantAuxUser;
       $cincoMayoresCompras=array();
       $auxUser=0;
       $cincoMejoresUsuarios=array();
       $cantDescUser=array();

       $compras=\app\models\Reserva::find()->where(['id_estado'=>'4'])->all();


        for ($i=0; $i <count($compras) ; $i++) {     
        $compra=$compras[$i];
        
        
        
      if (!in_array($compra->id_usuario, $mejoresUsuarios)) {
            $cantAuxUser=0; 
        
            for ($j=$i; $j < count($compras); $j++) { 
                if ($compra->id_usuario==$compras[$j]->id_usuario) {
                $cantAuxUser=$cantAuxUser+1;
            }               
            }
            array_push($cantCompras, $cantAuxUser);
            array_push($mejoresUsuarios, $compra->id_usuario); 
          }        
        }

        for ($d=0; $d < count($cantCompras); $d++) { 
            array_push($cantDescUser, $cantCompras[$d]);            
        }
        rsort ($cantDescUser);

        for($a=0;$a<count($cantDescUser)&&$auxUser <5;$a++){
        array_push($cincoMayoresCompras , $cantDescUser[$a]);
        $auxUser++;
        }


         for($b=0;$b<count($cincoMayoresCompras);$b++){
           $insertadoUser=false;
            for($c=0; $c <count ($cantCompras) &&!$insertadoUser; $c++){
                if($cincoMayoresCompras[$b]==$cantCompras[$c]){
                if(!in_array($mejoresUsuarios[$c], $cincoMejoresUsuarios)){ 

          array_push($cincoMejoresUsuarios , $mejoresUsuarios[$c]);
          $insertadoUser=true;
         }
             
       }}}


        return $this->render('mejores',['cincoMejoresUsuarios'=> $cincoMejoresUsuarios,'cincoMayoresCompras'=>$cincoMayoresCompras]);
    }
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }
    
   

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
