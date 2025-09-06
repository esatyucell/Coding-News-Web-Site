<?php


namespace App\Core; // Namespace Tanımlaması

use PDO;                  // Gerekli Sınıfların Dahil Edilmesi
use PDOException;   


// Database Sınıfının tanımlanması
class Database  
{
    /**
     * Singleton deseni için tek örnek değişkeni
     *
     * @var Database|null
     */
    private static $instance = null;

    /**
     * Veritabanı bağlantısını tutacak değişken
     *
     * @var PDO
     */
    private $connection;

    /**
     * Yapıcı metod, sınıfın dışından çağrılabilir
     */
    public function __construct() {
        /* Bu metot Database sınıfı çağrıldığında çalışır. Yapıcı metodun işlevleri:

            Veritabanı yapılandırmasını (Config::loadEnv()) yükler.
            DSN (Data Source Name) oluşturur.
            PDO kullanarak veritabanı bağlantısını oluşturur.
            Bağlantı hatası oluşursa bir hata mesajı ile sonlandırır.
        */
        try {
            $config = Config::loadEnv(); // Ortam değişkenlerini yükler
            $dsn = "mysql:host={$config['DB_HOST']};dbname={$config['DB_NAME']};charset={$config['DB_CHARSET']}"; // Bu satır MySQL  bağlantısı için DSN oluşturur.
            $this->connection = new PDO($dsn, $config['DB_USER'],
            $config['DB_PASSWORD'], [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Hata modunu istisna olarak ayarlar
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,  // Varsayılan veri çekme modunu ayarlar
                PDO::ATTR_EMULATE_PREPARES => false,
                /* 
                    Bu kod PDO sınıfını kullanarak veritabanına bağlanır ve bağlantı seçeneklerini belirler:

                        Hata modu: PDO::ERRMODE_EXCEPTION (Hata durumunda istisna fırlatır.)
                        Varsayılan veri çekme modu: PDO::FETCH_ASSOC (Sonuçları dizi olarak döndürür.)
                        Hazırlanan ifadeleri emüle etmeyi kapatma: PDO::ATTR_EMULATE_PREPARES => false
                */
            ]);
        } catch (PDOException $e) {
            // Bağlantı hatası durumunda hata mesajı ile sonlandırır
            die("Veritabanı bağlantı hatası: " . $e->getMessage());
        }
    }

    // Singleton Deseni için getInstance Metodu
    public static function getInstance() 
    {
        // Bu metot Database sınıfının yalnızca bir örneğinin oluşturulmasını sağlar. Eğer sınıf zaten başlatılmışsa, mevcut bağlantıyı döndürür.

        if (self::$instance === null) {
            self::$instance = new self();
        }
        // Eğer $instance değişkeni null ise yeni bir Database örneği oluşturulur.
        return self::$instance->connection;
        // Mevcut bağlantı döndürülür.
    }

    // SQL Sorgusunu Çalıştıran Metot
    public function query($query, $params = []) {
        // Bu metot SQL sorgularını çalıştırmak için kullanılır.
        $stmt = $this->connection->prepare($query);
        $stmt->execute($params);
        return $stmt;

        /* $query: Çalıştırılacak SQL sorgusunu alır.
        *  $params: Sorguya gönderilecek parametreleri içerir.
        *  prepare(): Sorguyu hazırlar.
        *  execute(): Sorguyu çalıştırır.
        *  return $stmt;: Sorgu sonucunu döndürür
        */
    }

       /**
     * Veritabanı sorgusu hazırlar
     *
     * @param string $query SQL sorgusu
     * @return \PDOStatement
     */
    public function prepare($query)
    {
        return $this->connection->prepare($query);
    }

    /**
     * Klonlamayı devre dışı bırakır
     */
    private function __clone() {}

    /**
     * Serileştirmeyi devre dışı bırakır
     */
    public function __wakeup() {}
}