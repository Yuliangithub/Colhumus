<?php

class DashboardModel{

    private $conn;
    private $noticias = "noticias";

    public function __construct($conectar){
        $this->conn = Database::conectar();
    }
    
    public function getNoticiaDestacada(){
        $stmt = $this->conn->prepare("SELECT * FROM " .$this->noticias. " WHERE destacada = 1 LIMIT 1");
        $stmt->execute();
        return $stmt->fetch();
    }

    public function getListaNoticias(){
        $stmt = $this->conn->prepare("SELECT * FROM " .$this->noticias. " ORDER BY fecha_publicacion DESC");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getNoticiaById($id){
        $stmt = $this->conn->prepare("SELECT * FROM " .$this->noticias. " WHERE id =? LIMIT 1");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function searchNoticias($query) {
        $stmt = $this->conn->prepare("SELECT * FROM " . $this->noticias . " WHERE titulo LIKE ? OR cuerpo LIKE ? ORDER BY fecha_publicacion DESC");
        $searchTerm = '%' . $query . '%';
        $stmt->execute([$searchTerm, $searchTerm]);
        return $stmt->fetchAll();
    }
}
?>