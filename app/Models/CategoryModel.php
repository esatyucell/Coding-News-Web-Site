<?php 

namespace App\Models;

use App\Core\Database;

class CategoryModel 
{

    /**
     * @var \PDO Veritabanı bağlantısı
     */

    private $db;
    /**
     * CategoryModel constructor.
     * @param \PDO $db Veritabanı bağlantısı
     */

    public function __construct(){
        $this->db = Database::getInstance()->getConnection();
    }

    /**
     * Aktif Kategorileri alır.
     * @return array kategoriler dizisi 
     */

    public function getActiveCategories() {
        // Categories Tablosoundan aktif kategorileri al 
        $stmt = $this->db->query("SELECT * FROM categories WHERE status = 1 ORDER BY id ASC");
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
//  Bitmedi 

}