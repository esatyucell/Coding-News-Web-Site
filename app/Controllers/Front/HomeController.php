<?php

namespace App\Controllers\Front;

use App\Core\BaseController;
use App\Models\SliderModel;
use App\Models\BlogModel;
use App\Controllers\Front\BlogController;


class HomeController extends BaseController
{
    /**
     * @var SliderModel $sliderModel Slider model örneği
     */
    private $sliderModel;
    private $blogModel;

    /** 
     * HomeController constructor.
     * Model örneklerini oluşturur ve üst sınıfın yapıcı metodunu çağırır.
     */
    public function __construct()
    {
        parent::__construct();

        // SliderModel örneğini oluştur
        $this->sliderModel = new SliderModel();
        $this->blogModel = new BlogModel();

    }

    /**
     * Anasayfa verilerini alır ve view'a gönderir.
     */
    

    public function index()
    {
        // SliderModel'i kullanarak aktif slider verilerini al
        $sliders = $this->sliderModel->getActiveSliders();

        

        // BlogModel'i kullanarak öne çıkan blog gönderilerini al
        $products = $this->blogModel->getFeaturedBlogPosts();
        // $totalProductCount = $this->blogModel->getTotalBlogPostCount();

        // Verileri view'a gönder
        $this->render('front/home', [
            'sliders' => $sliders, // Slider verileri
            'products' => $products, // Ürün verileri
            //'totalProductCount' => $totalProductCount // Toplam ürün sayısı
        ]);
    }
}
