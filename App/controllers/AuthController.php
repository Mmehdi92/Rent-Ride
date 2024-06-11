<?php
namespace Controllers;

use Framework\Valadation;


class AuthController
{
    public function showLogInForm()
    {
        loadView('/login/login');
    }

    


}
