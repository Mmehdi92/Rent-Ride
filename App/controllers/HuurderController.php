<?php

namespace Controllers;

use Framework\Valadation;
use Models\Huurder;
use Models\Adres;

use Framework\Session;

class HuurderController
{
    public function showRegisterForm()
    {
        if (Session::get('verhuurder')) {
            redirect('/');
            exit;
        }

        loadView(
            '/register/huurder.register',
            [
                'errors' => [],

            ]
        );;
    }

    public function registerHuurder()
    {
        // Ontvang de input van de gebruiker
        $voornaam = $_POST['voornaam'];
        $achternaam = $_POST['achternaam'];
        $email = $_POST['email'];
        $geboortedatum = date('Y-m-d', strtotime($_POST['geboortedatum']));
        $plaats = $_POST['plaats'];
        $straat = $_POST['straat'];
        $postcode = $_POST['postcode'];
        $huisnummer = $_POST['huisnummer'];
        $telefoon = $_POST['telefoon'];
        $wachtwoord = $_POST['wachtwoord'];
        $bevestigWachtwoord = $_POST['bevestigWachtwoord'];
        $rekeningnummer = $_POST['rekeningnummer'];
        $rijbewijs =date('Y-m-d', strtotime($_POST['rijbewijs']));;
        $vaarbewijs = $_POST['vaarbewijs'];

        $errors = [];

        // Valideer de input
        if (!Valadation::email($email)) {
            $errors[] = 'Email is niet geldig';
        }

        if (!Valadation::string($voornaam, 3, 50)) {
            $errors[] = 'Voornaam moet tussen de 3 en 50 karakters zijn';
        }

        if (!Valadation::string($achternaam, 3, 50)) {
            $errors[] = 'Achternaam moet tussen de 3 en 50 karakters zijn';
        }

        if (!Valadation::string($plaats, 3, 50)) {
            $errors[] = 'Plaats moet tussen de 3 en 50 karakters zijn';
        }

        if (!Valadation::string($straat, 3, 50)) {
            $errors[] = 'Straat moet tussen de 3 en 50 karakters zijn';
        }

        if (!Valadation::string($postcode, 6, 6)) {
            $errors[] = 'Postcode moet 6 karakters zijn';
        }

        if (!Valadation::string($huisnummer, 1, 10)) {
            $errors[] = 'Huisnummer moet tussen de 1 en 10 karakters zijn';
        }

        if (!Valadation::string($telefoon, 10, 10)) {
            $errors[] = 'Telefoonnummer moet 10 karakters zijn';
        }

        if (!Valadation::string($rekeningnummer, 18, 18)) {
            $errors[] = 'Rekeningnummer moet 18 karakters zijn';
        }

        if (!Valadation::string($wachtwoord, 8, 50)) {
            $errors[] = 'Wachtwoord moet tussen de 8 en 50 karakters zijn';
        }

        if (!Valadation::match($wachtwoord, $bevestigWachtwoord)) {
            $errors[] = 'Wachtwoorden komen niet overeen';
        }

        // Als er validatiefouten zijn, toon het formulier opnieuw met foutmeldingen
        if (!empty($errors)) {
            loadView(
                '/register/huurder.register',
                [
                    'errors' => $errors,
                    'user' => $user = [
                        'voornaam' => $voornaam,
                        'achternaam' => $achternaam,
                        'email' => $email,
                        'geboortedatum' => $geboortedatum,
                        'plaats' => $plaats,
                        'straat' => $straat,
                        'postcode' => $postcode,
                        'huisnummer' => $huisnummer,
                        'telefoon' => $telefoon,
                        'rekeningnummer' => $rekeningnummer,
                        'rijbewijs' => $rijbewijs,
                        'vaarbewijs' => $vaarbewijs
                    ]
                ]
            );
            exit;
        }

        $newAdres = new Adres(
            $postcode,
            $huisnummer,
            $straat,
            $plaats,
            'Nederland'
        );

        $newHuurder = new Huurder(
            $rekeningnummer,
            $voornaam,
            $achternaam,
            $postcode,
            $huisnummer,
            $email,
            password_hash($wachtwoord, PASSWORD_DEFAULT),
            $telefoon,
            $geboortedatum,
            true,
            $rekeningnummer,
            $rijbewijs,
            $vaarbewijs
        );

        $adres = $newAdres->getAllAdresByPostcode($postcode, $huisnummer);
        $email = $newHuurder->getAllUsersByEmail($email);
        $user = $newHuurder->getAllUsers($rekeningnummer);

        if ($user || $email) {
            $errors[] = 'Gebruiker bestaat al';
            loadView(
                '/register/huurder.register',
                [
                    'errors' => $errors,
                    'user' => [
                        'voornaam' => $voornaam,
                        'achternaam' => $achternaam,
                        'Email' => $email,
                        'geboortedatum' => $geboortedatum,
                        'plaats' => $plaats,
                        'straat' => $straat,
                        'postcode' => $postcode,
                        'huisnummer' => $huisnummer,
                        'telefoon' => $telefoon,
                        'rekeningnummer' => $rekeningnummer,
                        'rijbewijs' => $rijbewijs,
                        'vaarbewijs' => $vaarbewijs
                    ]
                ]
            );
            exit;
        }
        if (!$adres) {
            $newAdres->addAdres();
        }

         $newHuurder->addHuurder();

       
        Session::set('huurder', [
            'id' => $newHuurder->getProperty('Iban'),
            'voornaam' => $newHuurder->getProperty('voorNaam'),
            'achternaam' => $newHuurder->getProperty('achterNaam'),
            'email' => $newHuurder->getProperty('email'),
            'geboortedatum' => $newHuurder->getProperty('geboorteDatum'),

        ]);

        redirect('/');
    }
}


// if (!$user) {
//     $errors['email'] = 'Email of wachtwoord is onjuist';
//     loadView('/login/login', ['errors' => $errors]);
//     exit;
// }