<?php

namespace Controllers;
use Framework\Session;

class HomeController
{


    public function index()
    {
      

        $lang = Session::get('langId') ?? 'en';
        $data = require  basePath('/App/locale/'.$lang.'.php');

        loadView('home', [ $data]);
    }
}
