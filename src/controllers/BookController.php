<?php
namespace app\controllers;

use Yii;
use app\models\Book;
use yii\rest\Controller;
use yii\web\Response;
use app\components\JwtAuth;
use app\controllers\BaseController;

class BookController extends BaseController
{

    public function actionIndex() {
        
        $pagina = Yii::$app->request->get('pagina');
        $ordenar = Yii::$app->request->get('ordenar');
        $filtro = Yii::$app->request->get('filtro');
        $limite = Yii::$app->request->get('limite');

        return $this->_pagination($pagina, $ordenar, $filtro, $limite);

    }

    public function actionPaginate(){
        $request = Yii::$app->request->post(); 
        $pagina = isset($request['pagina']) ? (int)$request['pagina'] : 1; 
        $ordenar = isset($request['ordenar']) ? $request['ordenar'] : 'title'; 
        $filtro = isset($request['filtro']) ? $request['filtro'] : false; 
        $limite = isset($request['limite']) ? $request['limite'] : 10; 

        return $this->_pagination($pagina, $ordenar, $filtro, $limite);
    }
    
    private function _pagination($pagina, $ordenar, $filtro, $limite) {
       
        $pagina = isset($pagina) ? (int)$pagina : 1; 
        $ordenar = isset($ordenar) ? $ordenar : 'title'; 
        $filtro = isset($filtro) ? $filtro : null; 
        $limite = isset($limite) ? (int)$limite : 10; 
        $camposOrdenar = ['title', 'price'];

        $filter = false;
        if( $filtro ){
            $filter = [
                ['like', 'title', $filtro],
                ['like', 'author', $filtro],
                ['like', 'isbn', $filtro],
            ];
        }

        $params = [
            'pagina' => $pagina,
            'ordenar' => $ordenar,
            'filtro' => $filter,
            'limite' => $limite,
            'camposOrdenar' => $camposOrdenar
        ];

        return $this->pagination($params, Book::find());
        
        
     }
}
