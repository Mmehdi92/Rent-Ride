<?php

namespace Controllers;

class AboutController
{
    public function showAboutPage()
    {
        loadView('/about/about');
    }
}