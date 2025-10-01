<?php 

namespace App\Controllers\Front;

use App\Core\BaseController;
use App\Models\SearchModel;

class SearchController extends BaseController {
    /**
     * @var SearchModel $searchModel Arama işlemleri için kullanılan model
     */

    protected $searchModel;

    /**
     * SearchController constructor
     * Üst sınıfın yapıcı metodunu çağırır ve SearchModel örneğini oluşturur.
     */

    public function __construct() {
        parent::__construct();
        $this->searchModel = new SearchModel();
    }

    /**
     * Arama sayfasını görünttüler
     * 
     * @return void
     */

    public function index() {
        // Kullanıcının arama sorgusunu alır, eğer sorgu yoksa boş string kullanır
        $query = $_GET['query'] ?? '';

        // Arama modelini kullanarak ürünleri arar
        
        $blogs = $this->searchModel->searchBlogs($query);

        // Arama sonuçlarını ve sorguyu arayüze gönderir.

        $this->render('front/search', ['blogs' => $blogs, 'query' => $query]);
    }



}