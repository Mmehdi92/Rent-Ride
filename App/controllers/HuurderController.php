<?php

namespace Controllers;

class HuurderController
{
    public function showRegisterForm()
    {
        loadView('/register/huurder.register');
    }
}