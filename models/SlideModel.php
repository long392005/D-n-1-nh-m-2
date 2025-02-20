<?php
class SlideModel{
    public $conn;
    public function __construct()
    {
        $this->conn = connectDB();
    }
    public function getAllSlides(){
    $stmt= $this->conn->query('SELECT * FROM tb_banner');
    return $stmt->fetchAll();
    }
}