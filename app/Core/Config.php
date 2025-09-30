<?php

namespace App\Core;

use Dotenv\Dotenv; 
// Ortam değişkenlerini (.env dosyası) yönetmek için Dotenv kütüphanesini kullanır.

class Config 
{
    /** Uygulama Yapılandırma ayarlarını tutar
     * @var array $config
     */
    private static $config = [];

    /**
     * .env dosyasını yükler ve yapılandırma ayarlarını döndürür
     * @return array
     */

    public static function loadEnv() {
        if (empty(self::$config)) {
            $dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
            $dotenv->load();
            self::$config = [
                'DB_HOST' => $_ENV['DB_HOST'],
                'DB_NAME' => $_ENV['DB_NAME'],
                'DB_USER' => $_ENV['DB_USER'],
                'DB_PASSWORD' => $_ENV['DB_PASSWORD'],
                'DB_CHARSET' => $_ENV['DB_CHARSET']
            ];
        }
        return self::$config;
    }

    /**
     * Belirtilen anahtara göre yapılandırma ayarını döner
     *
     * @param string $key Yapılandırma anahtarı
     * @return mixed|null Yapılandırma değeri veya null
     */
    public static function get($key) {
        $config = self::loadEnv();
        return $config[$key] ?? null;
        // $config = self::loadEnv(); → Ortam değişkenleri yüklenir.
        // $config[$key] ?? null; → $key değeri varsa döndürülür, yoksa null döner.
    }
}