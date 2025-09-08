<?php 

namespace App\Models;
use App\Core\Database;

/**
 * SettingsModel sınıfı, uygulama ayarlarını yönetmek için kullanılır.
 */

class SettingsModel {
    /**
     * @var \PDO Veritabanı bağlantısı
     */
    private $db;

    /**
     * SettingsModel constructor.
     * Veritabanı bağlantısını başlatır.
     */

    public function __construct() {
        $this->db = Database::getInstance();
    }

    /**
     * Tüm ayarları veritabanından getirir.
     *
     * @return array Ayarların anahtar-değer çiftleri olarak döner.
     */

    public function getAllSettings() {
        // Sadece setting_key ve setting_value sütunlarını al
        $stmt =  $this->db->query("SELECT setting_key, setting_value FROM settings");
        //PDO::FETCH_KEY_PAIR ile anahtar-değer çiftleri olarak al
        return $stmt->fetchAll(\PDO::FETCH_KEY_PAIR);
    }

    /*
    * Belirli bir ayarı anahtara göre günceller 
    * @param string $key Ayar anahtarı
    * @param string $value Yeni ayar değeri
    * @return bool Güncelleme işleminin başarılı olup olmadığını belirtir
    */

    public function updateSetting($key, $value) {
        $stmt = $this->db->prepare("UPDATE settings SET setting_value = :value WHERE setting_key = :key");

        return $stmt->execute([
            ':key' => $key,
            ':value' => $value
        ]);
    }
}