<?php

namespace App\Controllers\Front;
use App\Core\BaseController;

class HomeController extends BaseController
{
    public function index()
    {
        $title = "Ana Sayfa";
        $content = "Hoş geldiniz!";
        $this->render("front/home", ["title" => $title, "content" => $content]);
    }
}

?>