<?php

namespace Controllers;

use Framework\Session;

use Framework\Valadation;
use Framework\Database;
use Models\Verhuurder;
use Models\Huurder;

class AuthController
{
    public function showLogInForm()
    {
        if (Session::get('verhuurder')) {
            redirect('/');
            exit;
        }
        loadView('/login/login');
    }

    public function logout()
    {
        Session::clearALL();
        $params = session_get_cookie_params();
        setcookie('PHPSESSID', '', time() - 86400, $params['path'], $params['domain']);

        redirect('/');
    }

    public function authenticateVerhuurder()
    {

        $email = $_POST['email'];
        $password = $_POST['password'];

        $errors = [];

        if (!Valadation::email($email)) {
            $errors['email'] = 'Geen geldige email';
        }

        if (!Valadation::string($password, 4, 50)) {
            $errors['password'] = 'Wachtwoord moet minimaal 4 karakters zijn';
        }

        if (!empty($errors)) {

            loadView('/login/login', ['errors' => $errors]);
            exit;
        }

    // split the email and check if the domain is rentandride.nl
        $partials = explode('@', $email);
        // inspectAndDie($partials);
        if($partials[1] === 'rentandride.nl'){
          inspectAndDie('gelukt');

        //   logic voor de admin 
        }

        $params = [
            'email' => $email,

        ];
        $db = Database::getInstance();
        $user = $db->query('SELECT * FROM gebruiker 
                    INNER JOIN verhuurder ON gebruiker.Iban = verhuurder.VerhuurderId
                    WHERE gebruiker.email = :email', $params)->fetch();

        if (!$user) {

            $huurder = $db->query(
                'SELECT * FROM gebruiker 
                INNER JOIN huurder ON gebruiker.Iban = huurder.HuurderId
                WHERE gebruiker.email = :email',
                $params
            )->fetch();
            if (!$huurder) {
                $errors['email'] = 'Email of wachtwoord is onjuist';
                loadView('/login/login', ['errors' => $errors]);
                exit;
            }
            if (!password_verify($password, $huurder->Wachtwoord)) {
                $errors['email'] = 'Email of wachtwoord is onjuist';
                loadView('/login/login', ['errors' => $errors]);
                exit;
            }

            $huurder = new Huurder(
                $huurder->Iban,
                $huurder->Voornaam,
                $huurder->Achternaam,
                $huurder->Postcode,
                $huurder->Huisnummer,
                $huurder->Email,
                $huurder->Wachtwoord,
                $huurder->TelefoonNummer,
                $huurder->Geboortedatum,
                $huurder->Actief,
                $huurder->HuurderId,
                $huurder->Rijbewijs,
                $huurder->Vaarbewijs
            );


            Session::set('huurder', [
                'id' => $huurder->getProperty('Iban'),
                'voornaam' => $huurder->getProperty('voorNaam'),
                'achternaam' => $huurder->getProperty('achterNaam'),
                'email' => $huurder->getProperty('email'),
                'geboortedatum' => $huurder->getProperty('geboorteDatum'),

            ]);

            redirect('/');
        }


        if (!password_verify($password, $user->Wachtwoord)) {
            $errors['email'] = 'Email of wachtwoord is onjuist';
            loadView('/login/login', ['errors' => $errors]);
            exit;
        }

        $user = new Verhuurder(
            $user->Iban,
            $user->Voornaam,
            $user->Achternaam,
            $user->Postcode,
            $user->Huisnummer,
            $user->Email,
            $user->Wachtwoord,
            $user->TelefoonNummer,
            $user->Geboortedatum,
            $user->Actief,
            $user->VerhuurderId
        );



        Session::set('verhuurder', [
            'id' => $user->getProperty('Iban'),
            'voornaam' => $user->getProperty('voorNaam'),
            'achternaam' => $user->getProperty('achterNaam'),
            'email' => $user->getProperty('email'),
            'geboortedatum' => $user->getProperty('geboorteDatum'),
            'role' => 'verhuurder'
        ]);


        redirect('/');
    }

    public function showRegisterKeuze()
    {
        //werkt
        loadView('/register/registratie.keuze');
    }
}
