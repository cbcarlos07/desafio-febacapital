<?php
namespace app\controllers;

use Yii;
use app\models\Client;
use yii\rest\Controller;
use yii\web\Response;
use app\components\JwtAuth;

class ClientController extends Controller
{
    public function behaviors()
    {
        return [
            'authenticator' => [
                'class' => JwtAuth::class,
            ],
            'contentNegotiator' => [
                'class' => \yii\filters\ContentNegotiator::class,
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        return Client::find()->all();
    }

    public function actionView($id)
    {
        return Client::findOne($id);
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
       // Obter parâmetros da requisição
       $request = Yii::$app->request->post(); // Usamos post, pois estamos usando PATCH
       $pagina = isset($request['pagina']) ? (int)$request['pagina'] : 1; // Página atual (default: 1)
       $ordenar = isset($request['ordenar']) ? $request['ordenar'] : 'name'; // Campo para ordenar (default: 'name')
       $filtro = isset($request['filtro']) ? $request['filtro'] : ''; // Filtro a ser aplicado

       // Definir a quantidade de registros por página
       $limite = 10; // Você pode ajustar isso conforme necessário
       $offset = ($pagina - 1) * $limite;

       // Criar a consulta
       $query = Client::find();

       // Aplicar filtro se fornecido
       if ($filtro) {
           $query->orFilterWhere(['like', 'name', $filtro])
                 ->orFilterWhere(['cpf' => $filtro]);
       }

       // Contar o total de registros após o filtro
       $totalRegistros = $query->count();

       // Ordenar a consulta
       if (in_array($ordenar, ['name', 'cpf', 'city'])) {
           $query->orderBy([$ordenar => SORT_ASC]); // Ordenar por campo especificado
       }

       // Aplicar limite e offset
       $clientes = $query->limit($limite)->offset($offset)->all();

       // Calcular total de páginas
       $totalPaginas = ceil($totalRegistros / $limite);

       // Retornar resposta
       return [
           'pagina' => $pagina,
           'total' => $totalRegistros,
           'totalPagina' => $totalPaginas,
           'dados' => $clientes,
       ];
    }
}
