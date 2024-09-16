<?php
namespace app\controllers;

use Yii;

use yii\rest\Controller;
use yii\web\Response;
use app\components\JwtAuth;

class BaseController extends Controller
{
    public function behaviors(){

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

    protected function pagination($params, $query) {

        $pagina = $params['pagina'];
        $ordenar = $params['ordenar'];
        $filtro = $params['filtro'];
        $limite = $params['limite'];
        $camposOrdenar = $params['camposOrdenar'];

        $offset = ($pagina - 1) * $limite;

        
        if ($filtro) {
            foreach ($filtro as $key => $value) {
                $query->orFilterWhere($value);
            }            
        }

        if (in_array($ordenar, $camposOrdenar)) {
            $query->orderBy([$ordenar => SORT_ASC]); 
        }

        $results = $query->limit($limite)->offset($offset)->all();
        $totalRegistros = $query->count();
        $totalPaginas = ceil($totalRegistros / $limite);

        return [
            'pagina' => $pagina,
            'total' => (int)$totalRegistros,
            'totalPagina' => $totalPaginas,
            'dados' => $results,
        ];
        
    }
}