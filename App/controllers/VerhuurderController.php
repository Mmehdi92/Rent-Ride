<?php

namespace Controllers;

use DateTime;
use Framework\Valadation;
use Models\Verhuurder;
use Models\Adres;
use Models\Onderneming;

class VerhuurderController
{
    public function showRegisterForm()
    {
        loadView(
            '/register/verhuurder.register',
            [
                'errors' => [],
                
            ]
        );
    }

    public function registerVerhuurder()
    {

        $voornaam = $_POST['voornaam'];
        $achternaam = $_POST['achternaam'];
        $email = $_POST['email'];
        $geboortedatum = date('Y-m-d', strtotime($_POST['geboortedatum']));

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



        $errors = [];

        if (!Valadation::email($email)) {
            $errors[] = 'Email is niet geldig';
        }

        if (!Valadation::string($voornaam, 3, 50)) {
            $errors[] = 'Voornaam moet  tussen de 3 en 50 karakters zijn';
        }

        if (!Valadation::string($achternaam, 3, 50)) {
            $errors[] = 'Achternaam moet  tussen de 3 en 50 karakters zijn';
        }

        if (!Valadation::string($plaats, 3, 50)) {
            $errors[] = 'Plaats moet  tussen de 3 en 50 karakters zijn';
        }

        if (!Valadation::string($straat, 3, 50)) {
            $errors[] = 'Straat moet  tussen de 3 en 50 karakters zijn';
        }

        if (!Valadation::string($postcode, 6, 6)) {
            $errors[] = 'Postcode moet 6 karakters zijn';
        }

        if (!Valadation::string($huisnummer, 1, 10)) {
            $errors[] = 'Huisnummer moet  tussen de 1 en 10 karakters zijn';
        }

        if (!Valadation::string($kvk, 8, 8)) {
            $errors[] = 'KVK moet 8 karakters zijn';
        }

        if (!Valadation::string($ondernemingsnaam, 1, 50)) {
            $errors[] = 'Ondernemingsnaam moet  tussen de 3 en 50 karakters zijn';
        }

        if (!Valadation::string($telefoon, 10, 10)) {
            $errors[] = 'Telefoonnummer moet 10 karakters zijn';
        }

        if (!Valadation::string($rekeningnummer, 18, 18)) {
            $errors[] = 'Rekeningnummer moet 18 karakters zijn';
        }

        if (!Valadation::string($wachtwoord, 1, 50)) {
            $errors[] = 'Wachtwoord moet minimaal 4 karakters zijn';
        }

        if (!Valadation::match($wachtwoord, $bevestigWachtwoord)) {
            $errors[] = 'Wachtwoorden komen niet overeen';
        }


        if (!empty($errors)) {
            loadView(
                '/register/verhuurder.register',
                [
                    'errors' => $errors,
                    'user' =>  [
                        'voornaam' => $voornaam,
                        'achternaam' => $achternaam,
                        'email' => $email,
                        'geboortedatum' => $geboortedatum,
                        'plaats' => $plaats,
                        'straat' => $straat,
                        'postcode' => $postcode,
                        'huisnummer' => $huisnummer,
                        'kvk' => $kvk,
                        'ondernemingsnaam' => $ondernemingsnaam,
                        'telefoon' => $telefoon,
                        'rekeningnummer' => $rekeningnummer,
                        'wachtwoord' => $wachtwoord,
                        'bevestigWachtwoord' => $bevestigWachtwoord
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

        $newVerhuurder = new Verhuurder(
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
            $rekeningnummer
        );

        $newOnderneming = new Onderneming(
            $kvk,
            $ondernemingsnaam,
            $telefoon,
            $postcode,
            $rekeningnummer
        );

        $adres = $newAdres->getAllAdresByPostcode($postcode, $huisnummer);
        $user = $newVerhuurder->getAllUsers($rekeningnummer);
        $email = $newVerhuurder->getAllUsers($email);
        $ondereming = $newOnderneming->getAllOndernemingByKVK($kvk);


        if ($user || $email || $ondereming) { {
                $errors[] = 'Gebruiker en/of Onderneming bestaat al';
                loadView(
                    '/register/verhuurder.register',
                    [
                        'errors' => $errors,
                    ]
                );
            }
        }
        if (!$adres) {
            $newAdres->addAdres();
        }

        $newVerhuurder->addVerhuurder();

        $newOnderneming->addOnderneming();

        redirect('/');
    }
}
