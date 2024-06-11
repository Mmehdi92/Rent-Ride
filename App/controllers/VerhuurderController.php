<?php

namespace Controllers;

use Framework\Valadation;
use Models\Verhuurder;

class VerhuurderController
{
    public function showRegisterForm()
    {
        loadView('/register/verhuurder.register');
    }

    public function registerVerhuurder()
    {
        $voornaam = $_POST['voornaam'];
        $achternaam = $_POST['achternaam'];
        $email = $_POST['email'];
        $plaats = $_POST['plaats'];
        $straat = $_POST['straat'];
        $postcode = $_POST['postcode'];
        $huisnummer = $_POST['huisnummer'];
        $kvk = $_POST['kvk'];
        $ondernemingsnaam = $_POST['ondernemingsnaam'];
        $telefoon = $_POST['telefoon'];
        $rekeningnummer = $_POST['rekeningnummer'];
        $wachtwoord = $_POST['wachtwoord'];
        $bevestigWachtwoord = $_POST['bevestigWachtwoord'];

        $erros = [];

        if (!Valadation::email($email)) {
            $errors[] = 'Email is niet geldig';
        }
        

        if(!empty($errors)){
            loadView('/register/verhuurder.register', ['errors' => $errors]);
        }

        echo ('Verhuurder registered!');
    }
}
