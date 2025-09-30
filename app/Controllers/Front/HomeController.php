<?php

namespace App\Controllers\Front;

use App\Core\BaseController;
use App\Models\SliderModel;


class HomeController extends BaseController
{
    /**
     * @var SliderModel $sliderModel Slider model örneği
     */
    private $sliderModel;

    /** 
     * HomeController constructor.
     * Model örneklerini oluşturur ve üst sınıfın yapıcı metodunu çağırır.
     */
    public function __construct()
    {
        parent::__construct();

        // SliderModel örneğini oluştur
        $this->sliderModel = new SliderModel();

    }

    /**
     * Anasayfa verilerini alır ve view'a gönderir.
     */
    public function index()
    {
        // SliderModel'i kullanarak aktif slider verilerini al
        $sliders = $this->sliderModel->getActiveSliders();



        // Verileri view'a gönder
        $this->render('front/home', [
            'sliders' => $sliders, // Slider verileri
        ]);
    }
}
