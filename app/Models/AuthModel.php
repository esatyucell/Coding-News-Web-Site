<?php 

namespace App\Models;

use App\Core\Database;

/**
 * AuthModel sınıfı, kullanıcı kimlik doğrulama işlemlerini gerçekleştirir.
 */

class AuthModel {
    /**
     *  @var \PDO Veri Tabanı Bağlantı Nesnesi
     */
    private $db;

    /**
     * AuthModel constructor.
     * Veri tabanı bağlantısını başlatır.
     */
    public function __construct() {
        $this->db = Database::getInstance();
    }
}