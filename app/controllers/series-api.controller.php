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

    private function getData() {
        return json_decode($this->data);
    }

    public function getSeries($params = null) {
        if(isset($_GET['order'])&& isset($_GET['sort'])){
            //ORDENAR POR ID
            if($_GET['sort']=="id" ‖ $_GET['sort']=="ID"){ 
                if($_GET['order']=="ASC" ‖ $_GET["order"] == "asc"){
                    $series = $this->model->ordenASCid();
                }elseif ($_GET["order"] == "DESC" ‖ $_GET["order"] == "desc" ) {  
                  $series = $this->model->ordenDESCid();
                }
            }
            //ORDENAR POR GENERO
            elseif($_GET["sort"] == "genero"){
                if($_GET['order']=="ASC")
                    $series = $this->model->ordenASCgenero();
                elseif ($_GET["order"] == "DESC") {
                  $series = $this->model->ordenDESCgenero();
                }
            }
        }
        elseif(isset($_GET['filterByType'])){
            $series = $this->model->ShowByType($_GET['filterByType']);
        }
      else{
         $series = $this->model->getSeries();
      } 
    
    return $this->view->response($series, 200);

}
    public function getSerie($params = null) {
        $id = $params[':ID'];
        $series = $this->model->id($id);
        if ($series)
            $this->view->response($series);
        else 
            $this->view->response("La tarea con el id=$id no existe", 404);
    }

    public function deleteSerie($params = null) {
        $id = $params[':ID'];

        $series = $this->model->id($id);
        if ($series) {
            $this->model-> borrarserieid($id);
            $this->view->response($series);
        } else 
            $this->view->response("La tarea con el id=$id no existe", 404);
    }

    public function insertSerie($params = null) {
        $series = $this->getData();

        if (empty($series->titulo) || empty($series->genero) || empty($series->descripcion)) {
            $this->view->response("Complete los datos", 400);
        } else {
            $id = $this->model->agregoserie($series->titulo, $series->genero, $series->descripcion);
            $series = $this->model->id($id);
            $this->view->response($series, 201);
        }
    
    }
     public function updateSerie($params = null) {
        $id = $params[':ID'];
         $data = $this->getData();
                
         $tarea = $this->model->get($id);
         if ($tarea) {
              $this->model->update($id, $data->prioridad);
              $this->view->response("La tarea fue modificada con exito.", 200);
            } else
             $this->view->response("La tarea con el id={$id} no existe", 404);
            }
        
    }



