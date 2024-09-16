<?php
namespace app\controllers;

use Yii;
use app\models\Client;
use yii\rest\Controller;
use yii\web\Response;
use app\components\JwtAuth;
use app\controllers\BaseController;
use yii\web\NotFoundHttpException;

class ClientController extends BaseController
{
    

    public function actionIndex()
    {
        return Client::find()->all();
    }

    public function actionView($id)
    {
        $model = Client::findOne($id);
        if ($model === null) {
            throw new NotFoundHttpException('O cliente solicitado não foi encontrado.');
        };
        return $model;
    }

    public function actionCreate()
    {
        $client = new Client();
        $client->load(Yii::$app->request->post(), '');

        if ($client->save()) {
            return $client;
        }

        return ['errors' => $client->errors];
    }

    public function actionUpdate($id)
    {
        $client = Client::findOne($id);
        $client->load(Yii::$app->request->post(), '');

        if ($client->save()) {
            return $client;
        }

        return ['errors' => $client->errors];
    }

    public function actionDelete($id)
    {
        $client = Client::findOne($id);

        if ($client && $client->delete()) {
            return ['status' => 'Cliente deletado com sucesso.'];
        }

        return ['status' => 'Erro ao deletar cliente.'];
    }

    public function actionPaginate() {
       
       $request = Yii::$app->request->post(); 
       $pagina = isset($request['pagina']) ? (int)$request['pagina'] : 1; 
       $ordenar = isset($request['ordenar']) ? $request['ordenar'] : 'name'; 
       $filtro = isset($request['filtro']) ? $request['filtro'] : false; 
       $limite = isset($request['limite']) ? $request['limite'] : 10;
       $camposOrdenar = ['name', 'cpf', 'city'];

       $filter = false;
       if( $filtro ){
           $filter = [
            ['like', 'name', $filtro],
            ['cpf' => $filtro]
           ];
       }
       $params = [
        'pagina' => $pagina,
        'ordenar' => $ordenar,
        'filtro' => $filter,
        'limite' => $limite,
        'camposOrdenar' => $camposOrdenar
       ];

       return $this->pagination($params, Client::find());
    }
}
