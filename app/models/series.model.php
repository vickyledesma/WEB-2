<?php

class SeriesModel {

    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;'.'dbname=series;charset=utf8', 'root', '');
    }
    function getseries() {  
        $query = $this->db->prepare("SELECT * FROM series");
        $query->execute();
        $series = $query->fetchAll(PDO::FETCH_OBJ); 
        
        return $series;
    }
    function ordendesc() {  
        $query = $this->db->prepare("SELECT titulo, id, genero, descripcion FROM series ORDER BY id DESC");
        $query->execute();
        $series = $query->fetchAll(PDO::FETCH_OBJ); 
        return $series;
    
    }
    function agregoserie($titulo, $genero, $descripcion) {
        $query = $this->db->prepare("INSERT INTO series (titulo, genero, descripcion) VALUES (?, ?, ?)");
        $query->execute([$titulo, $genero, $descripcion]);

        return $this->db->lastInsertId();
    }
    function id($id) {
        $query = $this->db->prepare('SELECT * FROM series WHERE id =?');
        $query->execute([$id]);
        $id = $query->fetch(PDO::FETCH_OBJ);
        return $id;
    }
    function borrarserieid($id) {
        $query = $this->db->prepare('DELETE FROM series WHERE id = ?');
        $query->execute([$id]);
    }

    function actualizoserie($titulo, $genero, $descripcion,$id) {
        $query = $this->db->prepare("UPDATE series SET  titulo=?, genero=?, descripcion = ? WHERE id=?");
        $query->execute([$titulo,$genero,$descripcion,$id]);
   
    }
    function buscargenero($genre){
        $query = $this->db->prepare("SELECT * FROM series JOIN generos ON series.genero = generos.id AND generos.id = ?");
        $query->execute([$genre]);
        $genre= $query->fetchAll(PDO::FETCH_OBJ);
        return $genre;
    }    
        
    
    public function orderAsc(){
        $query = $this->db->prepare("SELECT * FROM series ORDER BY id ASC");
        $query->execute();
        $series= $query->fetchAll(PDO::FETCH_OBJ);
        return $series;
    }

    public function orderDesc(){
        $query = $this->db->prepare("SELECT * FROM series ORDER BY id DESC");
        $query->execute(); 
        $series= $query->fetchAll(PDO::FETCH_OBJ);
        return $series;
    
}
}
