<?php
require_once './app/models/series.model.php';
require_once './app/views/api.view.php';

class SeriesApiController {
    private $model;
    private $view;

    private $data;

    public function __construct() {
        $this->model = new SeriesModel();
        $this->view = new ApiView();
        $this->data = file_get_contents("php://input");
    }

    private function Data() {
        return json_decode($this->data);
    }

    public function TraigoSeries($params = null) {
        if(isset($_GET['sort']) && isset($_GET['order'])){
            if(($_GET['sort']=="id") || ($_GET['sort']=="ID")){ 
                if(($_GET['order']=="ASC" ) || ($_GET["order"] == "asc")){
                    $series = $this->model->ordenASCid();
                }
                elseif (($_GET["order"] == "DESC") || ($_GET["order"] == "desc" )) {  
                  $series = $this->model->ordenDESCid();
                }
            }
        }
        else{
         $series = $this->model->series();
        }
         
        return $this->view->response($series, 200);
        

    }
    public function Traigoserie($params = null) {
        $id = $params[':ID'];
        $series = $this->model->id($id);
        if ($series)
            $this->view->response($series);
        else 
            $this->view->response("La serie con el id=$id no existe", 404);
    }

    public function BorroSerie($params = null) {
        $id = $params[':ID'];

        $series = $this->model->id($id);
        if ($series) {
            $this->model-> borrarserieid($id);
            $this->view->response($series);
        } else 
            $this->view->response("La serie con el id=$id no existe", 404);
    }

    public function AgregoSerie($params = null) {
        $series = $this->Data();

        if (empty($series->titulo) || empty($series->genero) || empty($series->descripcion)) {
            $this->view->response("Complete los datos", 400);
        } else {
            $id = $this->model->agregoserie($series->titulo, $series->genero, $series->descripcion);
            $series = $this->model->id($id);
            $this->view->response($series, 201);
        }
    
    }
     public function ActualizoSerie($params = null) {
        $id = $params[':ID'];
        $data = $this->Data();
                
         $series = $this->model->id($id);
         if ($series) {
              $this->model->actualizoserie($data->titulo, $data->genero, $data->descripcion,$id);
              $this->view->response("La serie fue modificada con exito.", 200);
            } else
             $this->view->response("La serie con el id={$id} no existe", 404);
            }
        
    }



