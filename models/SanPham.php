<?php 
class SanPham{
    public $conn;
    public function __construct(){
        $this->conn = connectDB();
    }
    public function getAllSanPham($filters = [], $page = 1, $itemsPerPage = 10){
        try{
            $offset= ($page-1) *$itemsPerPage;
            $sql= "SELECT san_phams .*, danh_mucs.ten_danh_muc
             FROM san_phams
             INNER JOIN danh_mucs ON san_phams.danh_muc_id = danh_mucs.id
             WHERE 1=1";
             if(!empty($filters['search'])){
                $sql .= "AND san_phams.ten_san_pham LIKE :search";
             }
         if(!empty($filters['category'])){
                $sql.= " AND san_phams.danh_muc_id = :category";
             }
             if(!empty($filters['min_price'])){
                $sql.= " AND san_phams.gia_san_pham >= :min_price";
             } 
             if(!empty($filters['max_price'])){
                $sql.= " AND san_phams.gia_san_pham <= :max_price";
             }
             if (!empty($filters['order']) && in_array(strtolower($filters['order']), ['asc', 'desc'])) {
                $sql .= " ORDER BY san_phams.gia_san_pham " . strtoupper($filters['order']);
            }
            $sql .= " LIMIT :offset, :itemsPerPage";
            $stmt = $this->conn->prepare($sql);

            // Bind giá trị tham số
            if (!empty($filters['search'])) {
                $stmt->bindValue(':search', '%' . $filters['search'] . '%', PDO::PARAM_STR);
            }
            if (!empty($filters['category'])) {
                $stmt->bindValue(':category', (int)$filters['category'], PDO::PARAM_INT);
            }
            if (!empty($filters['min_price'])) {
                $stmt->bindValue(':min_price', (int)$filters['min_price'], PDO::PARAM_INT);
            }
            if (!empty($filters['max_price'])) {
                $stmt->bindValue(':max_price', (int)$filters['max_price'], PDO::PARAM_INT);
            }
            $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
            $stmt->bindValue(':itemsPerPage', $itemsPerPage, PDO::PARAM_INT);

            $stmt->execute();

            // Đảm bảo trả về một mảng, kể cả khi không có dữ liệu
            return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
        } catch (Throwable $th) {
            // Ghi log lỗi nếu cần
            error_log($th->getMessage());
            return []; // Trả về mảng rỗng nếu có lỗi
        }
    }
    public function getAllCategories()
    {
        try {
            $sql = "SELECT * FROM danh_mucs";
            $stmt = $this->conn->query($sql);

            // Đảm bảo trả về một mảng, kể cả khi không có dữ liệu
            return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
        } catch (Throwable $th) {
            // Ghi log lỗi nếu cần
            error_log($th->getMessage());
            return []; // Trả về mảng rỗng nếu có lỗi
        }
    }
    public function getTotalProducts($filters = [])
    {
        try {
            $sql = "SELECT COUNT(*) AS total
                    FROM san_phams
                    INNER JOIN danh_mucs ON san_phams.danh_muc_id = danh_mucs.id
                    WHERE 1=1"; // Điều kiện mặc định

            // Thêm điều kiện tìm kiếm
            if (!empty($filters['search'])) {
                $sql .= " AND san_phams.ten_san_pham LIKE :search";
            }

            // Thêm điều kiện danh mục
            if (!empty($filters['category'])) {
                $sql .= " AND san_phams.danh_muc_id = :category";
            }

            // Thêm điều kiện mức giá
            if (!empty($filters['min_price'])) {
                $sql .= " AND san_phams.gia_san_pham >= :min_price";
            }
            if (!empty($filters['max_price'])) {
                $sql .= " AND san_phams.gia_san_pham <= :max_price";
            }

            $stmt = $this->conn->prepare($sql);

            // Bind giá trị tham số
            if (!empty($filters['search'])) {
                $stmt->bindValue(':search', '%' . $filters['search'] . '%', PDO::PARAM_STR);
            }
            if (!empty($filters['category'])) {
                $stmt->bindValue(':category', (int)$filters['category'], PDO::PARAM_INT);
            }
            if (!empty($filters['min_price'])) {
                $stmt->bindValue(':min_price', (int)$filters['min_price'], PDO::PARAM_INT);
            }
            if (!empty($filters['max_price'])) {
                $stmt->bindValue(':max_price', (int)$filters['max_price'], PDO::PARAM_INT);
            }

            $stmt->execute();

            // Đảm bảo trả về số, kể cả khi không có dữ liệu
            return (int)$stmt->fetchColumn();
        } catch (Throwable $th) {
            // Ghi log lỗi nếu cần
            error_log($th->getMessage());
            return 0; // Trả về 0 nếu có lỗi
        }
    }
        }
    


