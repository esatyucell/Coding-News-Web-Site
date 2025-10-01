<?php 

namespace App\Models;

use App\Core\Database;

/**
 * SearchModel sınıfı, ürün arama işlemlerini gerçekleştirmek 
 * için kullanılır
 */

class SearchModel {
    /**
     * @var \PDO Veritabanı bağlantı nesnesi
     */

    private $db;

    /**
     * SearchModel constructer
     * Veritabanı bağlantısını başlatır
     */


    public function __construct() {
        $this->db = Database::getInstance();
    }

    /**
     * Ürünleri verilen sorguya göre
     * 
     * @param string $query arama sorgusu
     * @return array Arama sonuçları 
     */

    public function searchBlogs($query) {
        $stmt = $this->db->prepare("SELECT * FROM blogposts WHERE title LIKE ? OR short_description LIKE ? OR content LIKE ?");
        $searchQuery = '%' . $query . '%';
        $stmt->execute([$searchQuery, $searchQuery, $searchQuery]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }




}