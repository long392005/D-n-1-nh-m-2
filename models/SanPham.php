
<?php
class ListSanPham
{
    public $conn;

    public function __construct()
    {
        // Giả sử bạn có hàm connectDB() để kết nối CSDL
        $this->conn = connectDB();
    }

    public function getAllSanPham($filters = [], $page = 1, $itemsPerPage = 10)
    {
        try {
            $offset = ($page - 1) * $itemsPerPage;
            $sql = "SELECT san_phams.*, danh_mucs.ten_danh_muc
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

            // Thêm điều kiện sắp xếp
            if (!empty($filters['order']) && in_array(strtolower($filters['order']), ['asc', 'desc'])) {
                $sql .= " ORDER BY san_phams.gia_san_pham " . strtoupper($filters['order']);
            }

            // Thêm điều kiện phân trang
            $sql .= " LIMIT :offset, :itemsPerPage";

            // Chuẩn bị và thực thi câu truy vấn
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
    public function getProductById($id) {
    try {
        $sql = "SELECT san_phams.*, danh_mucs.ten_danh_muc
                FROM san_phams
                INNER JOIN danh_mucs ON san_phams.danh_muc_id = danh_mucs.id
                WHERE san_phams.id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC); // Trả về sản phẩm
    } catch (Throwable $th) {
        error_log($th->getMessage());
        return []; // Nếu có lỗi, trả về false
    }
}
public function getListAnhSanPham($id){
    try{
        $sql= 'SELECT * FROM hinh_anh_san_phams WHERE san_pham_id =:id';
        $stmt= $this->conn->prepare($sql);
        $stmt->execute([':id'=>$id]);
        return $stmt->fetchAll();
    }catch (Exception $e) {
        echo 'Lỗi' . $e->getMessage();

    }
}
public function getBinhLuanFromSanPham($id) {
    try {
        $sql = 'SELECT binh_luans.*, nguoi_dungs.ten
                FROM binh_luans
                INNER JOIN nguoi_dungs ON binh_luans.nguoi_dung_id = nguoi_dungs.id
                WHERE binh_luans.san_pham_id = :id';  // Corrected to use san_pham_id
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetchAll();  // Fetch all reviews for the specified product
    } catch (Exception $e) {
        echo 'Lỗi: ' . $e->getMessage();
    }
}

public function addComment($idProduct, $idUser, $content) {
    // Use prepared statement for secure query execution
    $sql = "INSERT INTO binh_luans (san_pham_id, nguoi_dung_id, noi_dung) VALUES (?, ?, ?)";
    // var_dump($sql); exit();
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([$idProduct, $idUser, $content]);
}
public function restoreProductQuantity($productId, $quantity) {
    try {
        $sql = "UPDATE san_phams SET so_luong = so_luong + :quantity WHERE id = :productId";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':quantity' => $quantity, ':productId' => $productId]);
    } catch (Exception $e) {
        echo "Lỗi: " . $e->getMessage();
    }
}
public function updateSoLuongSP($id ,$so_luong){
    try {
        $sql = "UPDATE san_phams
                SET so_luong = :so_luong
                WHERE  id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id',$id);
        $stmt->bindParam(':so_luong',$so_luong);
        // $stmt->execute([':so_luong' => $so_luong]);
        $stmt->execute();
        return true;
    } catch (Exception $e) {
        echo "Lỗi: " . $e->getMessage();
    }
}
}

