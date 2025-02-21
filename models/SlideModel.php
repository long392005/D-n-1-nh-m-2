<?php

 class SlideModel {
    public $conn;


    public function __construct()
    {
        // Giả sử bạn có hàm connectDB() để kết nối CSDL
        $this->conn = connectDB();
    }

    public function getAllSlides() {
        $stmt = $this->conn->query('SELECT * FROM tb_banner');
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Trả về mảng các slide
    }
}

?>

